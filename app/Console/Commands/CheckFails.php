<?php


namespace App\Console\Commands;
use DateTime;

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
use App\Mail\Error;

class CheckFails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checkfails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for processing jobs that take too long';

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

$transcribejobs = Transcribejobs::where('status', '=', 'inprogress')
                                                           ->where('billingsuccessful', '=', 1)
                                                           ->get();

foreach($transcribejobs as $transcribejob)
{

$created=$transcribejob->created_at;
$date1 = new DateTime("now");
$difference = $date1->diff($created);
#var_dump($difference);
if ($difference->i > 15 )
	{

Mail::to('tprinty@gmail.com,john@bigwidelogic.com')->send(new Error());
}


        //
    }
}

}
