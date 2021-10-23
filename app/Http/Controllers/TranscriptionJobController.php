<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;

use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;

use App\Transcribejobs;
use App\Prices;
use App\Transcriptiontext;

use Mail;
use App\Mail\TranscriptionComplete;
use App\Mail\CelebrateEmail;
use App\Mail\Receipt;
use App\Mail\NewUpload;
use App\Mail\NewUserForSales;
use Auth;


class TranscriptionJobController extends Controller
{
    public function newtranscription(Request $request){

    	$filename = $request->input('savedfilename');
    	$filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
	                $filetype=strtolower($filetype);

		$environment = env('APP_ENV');

    	$filePath  = Storage::disk('soundfiles')->getDriver()->getAdapter()->getPathPrefix();

		$message = "";
		$cost = 0.00;

		//how long is this file
		$playtime_seconds = 0;

		if($filetype == "mp3" || $filetype == "wav" || $filetype == "mp4" || $filetype == "mpga" || $filetype == "m4a"){
			$getID3 = new \getID3;
			$getID3file = $getID3->analyze($filePath.$filename);
		}else{
			$transcribejob = new Transcribejobs();
			$message = "We were not able to determine the type of file you uploaded. The file may be too short or in an unregonized format. Please <a href=\"javascript:history.back()\">go back</a> and try again.";
			return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid,
							  'message' => $message, 'ccmessage'=>"", 'environment' => $environment)
						);
		}



		$minutes = 1;
		#dd($getID3file);
		$playtime_seconds = $getID3file['playtime_seconds'];
		if ($playtime_seconds > 0){
			$minutes = $playtime_seconds / 60;
		}else{
			$minutes = 1;
		}

		if ($minutes < 1){
			$transcribejob = new Transcribejobs();
			$message =  "We were not able to process the supplied file. The file may be too short or in an unregonized format. The minimum size is one minute. Please <a href=\"javascript:history.back()\">go back</a> and try again.";

			return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => $message, 'ccmessage'=>"", 'environment' => $environment));

		}

		$coupon = strtoupper($request->input('coupon'));
		$language = $request->input('language');
		$speakers = $request->input('speakers');
		if ($speakers == ""){
			$speakers = 10;
		}


		//Get the price
		if (($request->input('humanreview')) && ($request->input('humanreview') == "Yes")){
			$transcriptiontype = 'human';
			$language = "en-US";

			$price = Prices::where('mintime', '<=', $minutes)
						   ->where('maxtime', '>=', $minutes)
					 	   ->where('transcriptiontype', '=', 'human')
					 	   ->first();
		}else{
			$transcriptiontype = 'ai';
			$price = Prices::where('mintime', '<=', $minutes)
						   ->where('maxtime', '>=', $minutes)
					 	   ->where('transcriptiontype', '=', 'ai')
					 	   ->first();
		}

		// $discount = 0;
    //
		// $cost = number_format(($price->amount * $minutes), 2);
		// if ($coupon == "50OFF") {
    //
		// 	 $cost = number_format((($price->amount * $minutes)*.5), 2);
    //
		// }
		// if ($coupon == "10OFF") {
    //
		// 	$cost = number_format((($price->amount * $minutes)*.9), 2);
    //
		// }



		// if ($cost < .50){
		// 	$cost = .50;
		// }
    //
		// //for testing
		// if ($coupon == "ROOT") {
    //
    //
    //                     $cost = 0;
    //             }
		//create the uniq transaction id
		$transactionid = base64_encode($request->input('first_name')." ".$request->input('last_name')." ".uniqid());


        $transcribejob = new Transcribejobs();
		$firstname=$request->input('first_name');
		$lastname=$request->input('last_name');
		if ($firstname == ""){ $firstname= Auth::user()->name ;}
		if ($lastname == ""){ $lastname="Customer";}
		$transcribejob->firstname = $firstname;

		$transcribejob->lastname = $lastname;
		$transcribejob->email = $request->input('email');
		$transcribejob->soundfilename = $filename;
		$transcribejob->status = "starting";
		// $transcribejob->total_amount = $cost;
		$transcribejob->transactionid  = $transactionid;
		$transcribejob->language = $language;
		$transcribejob->speakers = $speakers;



		//These all need default
		$transcribejob->accuracy = "";
		$transcribejob->comments = "";
		$transcribejob->billingsuccessful = 0;
		$transcribejob->striptxid = "";
		$transcribejob->transcriptiontype = $transcriptiontype;

		$transcribejob->save();


		Mail::to("sales@cheaptranscription.io")->send(new NewUserForSales($transcribejob));

		$debug_billing = env('BILLING_DEBUG');

    return redirect('/user-dashboard')->with('success', 'Transcription us under proccess!');

		// if ($debug_billing==true)
		// {
		// 	return redirect('transcribestatus/'.$transactionid);
    //
		// }
		// else {
    //     return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => $message,
		// 													'ccmessage'=>"", 'environment' => $environment, 'transcriptiontype' => $transcriptiontype ));
		// }
	}


	 public function processpayment(Request $request)
     {
         $environment = env('APP_ENV');

         $transcribejob = Transcribejobs::where('transactionid', '=', $request->transcribejobid)->first();
         //used if we need to go back because of error
         $message = "";
         $cost = $transcribejob->total_amount;

         //Stripe stuff
         $stripe = new Stripe(env('STRIPE_SECRET'));

         if ($cost != 0) {
             try {
                 $token = $stripe->tokens()->create([
                     'card' => [
                         'number' => $request->get('cardnumber'),
                         'exp_month' => $request->get('ccExpiryMonth'),
                         'exp_year' => $request->get('ccExpiryYear'),
                         'cvc' => $request->get('cvv'),
                     ],
                 ]);

                 if (!isset($token['id'])) {
                     //Some stripe error
                     $ccmessage = "We were not able to process your payment sorry.";
                     return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => "", 'ccmessage' => $ccmessage, 'environment' => $environment, 'transcriptiontype' => $transcribejob->transcriptiontype));

                 }

                 $charge = $stripe->charges()->create([
                     'card' => $token['id'],
                     'currency' => 'USD',
                     'amount' => $transcribejob->total_amount,
                     'description' => 'Transcription Service',
                     'capture' => 'true',
                     'statement_descriptor' => "cheaptranscription.io",
                 ]);

                 if ($charge['status'] == 'succeeded') {
                     //For now get update the transcribejob as paid
                     $transcribejob->billingsuccessful = 1;
                     $transcribejob->save();
                     return redirect('transcribestatus/' . $request->transcribejobid);
                 } else {
                     $ccmessage = "We were not able to process your payment sorry.";
                     return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => "", 'ccmessage' => $ccmessage, 'environment' => $environment, 'transcriptiontype' => $transcribejob->transcriptiontype));
                 }


             } catch (Exception $e) {
                 $ccmessage = $e->getMessage();
                 return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => "", 'ccmessage' => $ccmessage, 'environment' => $environment, 'transcriptiontype' => $transcribejob->transcriptiontype));
             } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                 $ccmessage = $e->getMessage();
                 return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => "", 'ccmessage' => $ccmessage, 'environment' => $environment, 'transcriptiontype' => $transcribejob->transcriptiontype));
             } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                 $ccmessage = $e->getMessage();
                 return view('totalprice', array('totalprice' => $cost, 'transcribejobid' => $transcribejob->transactionid, 'message' => "", 'ccmessage' => $ccmessage, 'environment' => $environment, 'transcriptiontype' => $transcribejob->transcriptiontype));
             }


         }
        else
        {

            $transcribejob->billingsuccessful = 1;
            $transcribejob->save();
            return redirect('transcribestatus/' . $request->transcribejobid);
        }

     }

	public function transcribestatus($transcribejobid){

		$environment = env('APP_ENV');



		$transcribejob = Transcribejobs::where('transactionid', '=', $transcribejobid)->first();


		$status = "";
		$message = "";
		if(!$transcribejob){
			$message = "Sorry we can't find this transcription.";
			$status = "starting";
		}else if (($transcribejob->status == "starting")||($transcribejob->status == "inprogress")){
			$message = "Your transcription job is processing. We will send you an email when it's complete or you can bookmark this page and come back later.";
			$status = $transcribejob->status;
		}else if ($transcribejob->status == "complete"){
			$message = "Yay! Your transcription job is complete!";
			$status = $transcribejob->status;
		}



		$transcribetext = "";
		$jsonfile = "";
		if ($status == "complete"){
			$transcriptiontext = Transcriptiontext::where('transcribejobsid', '=', $transcribejob->id)->first();
			$jsonfile = $transcriptiontext->jsonfile;
			$transcribetext =  $transcriptiontext->transcriptiontext;

		}

		if ((strlen($transcribetext)<10)&&($status == "complete")){
			//Something bad happened reload the json object data
				$completePath = Storage::disk('temps')->getDriver()->getAdapter()->getPathPrefix();
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
				$transcriptiontext->transcriptiontext = $content;
				$transcriptiontext->save();
				$transcribetext = $content;

		}


		$soundfile = $transcribejob->soundfilename;

		$transcriptiontype = $transcribejob->transcriptiontype;



		return view('transcribestatus', array(
												'message' => $message,
												'transcribejobid' => $transcribejobid,
												'transcribejobstatus' => $status,
												'transcribetext' => $transcribetext,
												'soundfile' => $soundfile,
												'jsonfile' => $jsonfile,
											    	'transcriptiontype' => $transcriptiontype)

											  );


	}


	public function reviewtranscription(Request $request, $transcribejobid){

		$environment = env('APP_ENV');

		$isok = $request->session()->get('canedittranscription');

		if (!$isok){
			return redirect('/reviewpassword/'.$transcribejobid);
		}


		$message = "";

		$transcribejob = Transcribejobs::where('transactionid', '=', $transcribejobid)->first();

		if (!$transcribejob){
			$message = "Sorry we can't find this transcription.";
		}

		$soundfile = '';
		if ($transcribejob->status == "readyforhuma"){
			$transcriptiontext = Transcriptiontext::where('transcribejobsid', '=', $transcribejob->id)->first();
			$transcribetext =  $transcriptiontext->transcriptiontext;

			$transcribetext = str_replace('<p>', '', $transcribetext);
			$transcribetext = str_replace('</p>', PHP_EOL.PHP_EOL, $transcribetext);

			$soundfile = $transcribejob->soundfilename;

			return view('reviewtranscription', array(
												'message' => $message,
												'transcribejobid' => $transcribejobid,
												'transcribetext' => $transcribetext,
												'soundfile' => $soundfile,
												'environment' => $environment
												)
											  );

		}else{
			$message = "This is not ready for review";
			return view('reviewtranscription', array(
												'message' => $message,
												'transcribejobid' => $transcribejobid,
												'transcribetext' => "",
												'soundfile' => "",
												'environment' => $environment
												)
											  );
		}




	}

	public function updatetranscription(Request $request){

		$isok = $request->session()->get('canedittranscription');
		if (!$isok){
			return redirect('/reviewpassword/'.$request->transcribejobid);
		}

		if(strlen($request->transcription)<10){
			return redirect('/reviewtranscription/'.$request->transcribejobid);
		}


		$environment = config('app.environment');
		$transcribejob = Transcribejobs::where('transactionid', '=', $request->transcribejobid)->first();
		$transcriptiontext_db = Transcriptiontext::where('transcribejobsid', '=', $transcribejob->id)->first();

		$transcribetext = "<p>". $request->transcription;
		$transcribetext = str_replace(PHP_EOL, '</p><p>', $transcribetext);
		$transcriptiontext_db->transcriptiontext = $transcribetext;
		$transcriptiontext_db->save();

		$transcribejob->status = "complete";
		Mail::to($transcribejob->email)->send(new TranscriptionComplete($transcribejob));
		Mail::to($transcribejob->email)->send(new Receipt($transcribejob));
		Mail::to('tprinty@gmail.com')->send(new CelebrateEmail($transcribejob, $transcriptiontext_db));
		Mail::to('john@bigwidelogic.com')->send(new CelebrateEmail($transcribejob, $transcriptiontext_db));
		$transcribejob->save();

		$request->session()->forget('canedittranscription');


		return redirect('/');

	}

	public function reviewpassword($transcribejobid){
		$environment = env('APP_ENV');
		return view('reviewpassword', array('transcribejobid' => $transcribejobid, 'environment' => $environment));
	}

	public function checktranscriptionpassword(Request $request){
		$transcribejob = Transcribejobs::where('transactionid', '=', $request->transcribejobid)->first();

		if ($transcribejob->reviewpassword = $request->reviewpassword){
			$request->session()->put('canedittranscription', 'yes');
			return redirect('/reviewtranscription/'.$request->transcribejobid);

		}else{
			return redirect('/reviewpassword/'.$transcribejobid);
		}


	}



}
