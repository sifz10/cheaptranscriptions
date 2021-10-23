<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Transcribejobs;
use App\Prices;
use App\Transcriptiontext;

use Aws\Laravel\AwsFacade;

use DB;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
      }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

		$jobs = Transcribejobs::orderBy('created_at','desc')
		->get();


		$jobsbydate = DB::table('transcribejobs')
             ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as jobs'))
             ->groupBy(DB::raw('Date(created_at)'))
             ->orderBy(DB::raw('Date(created_at)'),'desc')
	      ->get();

        if (Auth::user()->role == "Admin") {
          return view('admin.index', array("jobs" => $jobs, "jobsbydate" => $jobsbydate));
        }else {
          return redirect('/user-dashboard');
        }
    }
    public function failit($transid)
    {
    $transcribejob = Transcribejobs::where('transactionid', '=', $transid)->first();
    $transcribejob->status='failed';
    $transcribejob->save();

    return redirect('admin');

}
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function awsjobs()
    {

		$awstranscribe = \AWS::createClient('transcribe');


		$result = $awstranscribe->listTranscriptionJobs(['MaxResults' => 100]);



        return view('admin.awsjobs', array("results" => $result));
    }



}
