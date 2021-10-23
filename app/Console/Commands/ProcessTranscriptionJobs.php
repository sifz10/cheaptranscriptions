<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

use Aws\Laravel\AwsFacade;


use App\Transcribejobs;
use App\Transcriptiontext;

use App\Mail\TranscriptionComplete;
use App\Mail\CelebrateEmail;
use App\Mail\HumanReview;
use App\Mail\Receipt;



class ProcessTranscriptionJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'processtranscriptionjobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process the transcription jobs that are "starting" and payment complete';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$filePath  = Storage::disk('soundfiles')->getDriver()->getAdapter()->getPathPrefix();
		$completePath = Storage::disk('temps')->getDriver()->getAdapter()->getPathPrefix();
		
		$awstranscribe = \AWS::createClient('transcribe');
		
    	//Get list of jobs ready to go
    	$transcribejobs = Transcribejobs::where('status', '=', 'starting')
    				    			   ->where('billingsuccessful', '=', 1)
    				    			   ->get();
		
		foreach ($transcribejobs as $transcribejob){
		

		
			//Extension
			$extension = \File::extension($filePath.$transcribejob->soundfilename);
			
			
			//transcribe the file
			if ($extension == "m4a"){
				$command = "ffmpeg -hide_banner -loglevel panic -i ". $filePath.$transcribejob->soundfilename ." -acodec libmp3lame -ab 128k ". $filePath.$transcribejob->soundfilename.".mp3";
				$return = exec($command);
				$transcribejob->soundfilename = $transcribejob->soundfilename.".mp3";
				$extension = "mp3";
			}
			
			
		
		
        	//Copy the file from local storage to S3 bucket	
        	$result = Storage::disk('s3')->put('soundfiles/'.$transcribejob->soundfilename, fopen($filePath.$transcribejob->soundfilename, 'r+'));
			
			
			
        	//Submit any new jobs to AWS Transcribe
        	$result = $awstranscribe->StartTranscriptionJob([
  					'LanguageCode' => $transcribejob->language, // REQUIRED
  					'Media' => [ 
    					'MediaFileUri' => 'https://s3.amazonaws.com/tstranscribe/soundfiles/'.$transcribejob->soundfilename, 
  					 ],
  					 'MediaFormat' => $extension, // REQUIRED
  					 'OutputBucketName' => "tstranscribe",
  					 'Settings' => [
  							#  'ChannelIdentification' => true || false,
    						'MaxSpeakerLabels' => $transcribejob->speakers,
  							'ShowSpeakerLabels' => true,
    				  ],
  					  'TranscriptionJobName' => str_replace(' ', '', $transcribejob->soundfilename), 
  					]);
        	$transcribejob->status = "inprogress";
			$transcribejob->save();
        
		}

		//now get status of jobs
		$transcribejobs = Transcribejobs::where('status', '=', 'inprogress')
    				    			   ->where('billingsuccessful', '=', 1)
    				    			   ->get();

		foreach ($transcribejobs as $transcribejob){
			print "Looking for ". $transcribejob->soundfilename ."\n<br />";
			$result = $awstranscribe->getTranscriptionJob([
    													   'TranscriptionJobName' => $transcribejob->soundfilename, 
														  ]);
														  
														  
			if ($result['TranscriptionJob']['TranscriptionJobStatus'] == "COMPLETED"){
				//copy the file locally	
				Storage::disk('temps')->put($transcribejob->soundfilename.'.json', Storage::disk('s3')->get($transcribejob->soundfilename.'.json'));
				
				$jsonfilename = $transcribejob->soundfilename.'.json';
				$transcription_download = file_get_contents($completePath.$transcribejob->soundfilename.'.json');
				$data = json_decode($transcription_download);
				$text = $data->results->transcripts[0]->transcript;
				
				// Load up speaker labels.
				$labels = $data->results->speaker_labels->segments;
				$speaker_start_times = [];
				foreach ($labels as $label) {
				  foreach ($label->items as $item) {
				    $speaker_start_times[number_format($item->start_time, 3)] = $label->speaker_label;
				  }
				}
				
				// Now we iterate through items and build the transcript
				$items = $data->results->items;
				$lines = [];
				$line = '';
				$time = 0;
				$speaker = NULL;
				foreach ($items as $item) {
				  $content = $item->alternatives[0]->content;
				  if (property_exists($item, 'start_time')) {
				    $current_speaker = $speaker_start_times[number_format($item->start_time, 3)];
				  }
				  elseif ($item->type == 'punctuation') {
				    $line .= $content;
				  }
				  if ($current_speaker != $speaker) {
				    if ($speaker) {
				      $lines[] = [
				        'speaker' => $speaker,
				        'line' => $line,
				        'time' => $time,
				      ];
				    }
				    $line = $content;
				    $speaker = $current_speaker;
				    $time = number_format($item->start_time, 3, '.', '');
				  }
				  elseif ($item->type != 'punctuation') {
				    $line .= ' ' . $content;
				  }
				}
				// Record the last line since there was no speaker change.
				$lines[] = [
				  'speaker' => $speaker,
				  'line' => $line,
				  'time' => $time,
				];
				
				$content = "";
				foreach ($lines as $line_data) {
  					//$content .= '[' . gmdate('H:i:s', $line_data['time']) . '] ' . $line_data['speaker'] . ': ' . $line_data['line'];
  					$content .= '<p>'.$line_data['speaker'] . ': ' . $line_data['line']. '</p>';
				}
				
				$content = str_replace('spk_', "Speaker ",$content);
				
				
				$transcriptionntext = new Transcriptiontext();
				$transcriptionntext->transcribejobsid = $transcribejob->id;
				$transcriptionntext->transcriptiontext = $content;
				$transcriptionntext->wordcount = str_word_count($text);
				$transcriptionntext->jsonfile = $jsonfilename;
				$transcriptionntext->save();
				
				
				
				if ($transcribejob->transcriptiontype == 'ai'){
					$transcribejob->status = "complete";
					print "Sending email to ". $transcribejob->email;
					Mail::to($transcribejob->email)->send(new TranscriptionComplete($transcribejob));
					Mail::to('tprinty@gmail.com')->send(new CelebrateEmail($transcribejob, $transcriptionntext));
					Mail::to('john@bigwidelogic.com')->send(new CelebrateEmail($transcribejob, $transcriptionntext));
					Mail::to($transcribejob->email)->send(new Receipt($transcribejob));
					
				}else{
					$transcribejob->status = "readyforhuma";
					
					//create a random password
					$transcribejob->reviewpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
					Mail::to('asaboo@tech-synergy.com')->send(new HumanReview($transcribejob, $transcriptionntext));
					
					 Mail::to('tsimail@tech-synergy.com')->send(new HumanReview($transcribejob, $transcriptionntext));
					Mail::to('tprinty@gmail.com')->send(new HumanReview($transcribejob, $transcriptionntext));
					Mail::to('john@bigwidelogic.com')->send(new HumanReview($transcribejob, $transcriptionntext));
				}
				
				
				$transcribejob->save();
				
				
			}
			
		}
        
    }
}
