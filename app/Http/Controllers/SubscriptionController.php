<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use Ap\User;
use App\Subscription;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;


use Config;

use App\Transcribejobs;
use App\Prices;
use App\Transcriptiontext;

use Mail;
use App\Mail\TranscriptionComplete;
use App\Mail\CelebrateEmail;
use App\Mail\Receipt;
use App\Mail\NewUpload;
use App\Mail\NewUserForSales;

class SubscriptionController extends Controller
{
  protected $stripe;

     public function __construct()
     {
        $stripe = new Stripe(env('STRIPE_SECRET'));
     }

     public function createPlan()
     {
         return view('admin.Plans.create');
     }

     public function storePlan(Request $request)
     {
         // dd($request->all());
         $data = $request->except('_token');
         $stripe = new Stripe(env('STRIPE_SECRET'));

         $data['slug'] = strtolower($data['name']);
         $price = $data['cost'] *100;

         if ($request->description == "monthly") {
           $plan = $stripe->plans()->create([
             'id'                   => $data['name'],
             'name'                 => $data['name'],
             'amount'               => $data['cost'],
             'currency'             => 'USD',
             'interval'             => 'month',
             'statement_descriptor' => 'Monthly Subscription.',
           ]);
         }else if($request->description == "yearly"){
           $plan = $stripe->plans()->create([
             'id'                   => $data['name'],
             'name'                 => $data['name'],
             'amount'               => $data['cost'],
             'currency'             => 'USD',
             'interval'             => 'year',
             'statement_descriptor' => 'Yearly Subscription.',
           ]);
         }else {
           return redirect('admin/plans')->with('danger', 'error occared!');
         }


         $data['stripe_plan'] = $plan['id'];
         Plan::create($data);

         return redirect('admin/plans')->with('success', 'New subscription package has been created!');
     }

     public function editPlan(Request $request)
     {
       $plan = DB::table('plans')->where('id', $request->id)->first();
       return view('admin.Plans.edit',compact('plan'));
     }

     public function pausePlan(Request $request)
     {
         $stripe_plan_id = DB::table('plans')->where('id', $request->id)->value('name');
         Plan::where('id', $request->id)->update([
          'status' => 0,
        ]);
        return back()->with('success', 'Subscription package has been paused!');
     }
     public function activePlan(Request $request)
     {
         $stripe_plan_id = DB::table('plans')->where('id', $request->id)->value('name');
         Plan::where('id', $request->id)->update([
          'status' => 1,
        ]);
        return back()->with('success', 'Subscription package has been active!');
     }

     public function subscribePackage(Request $request)
     {
       $stripe = new Stripe(env('STRIPE_SECRET'));
       $plans = DB::table('plans')->where('status', 1)->get();
       return view('subscription',compact('plans'));
     }

     public function gettingPaid(Request $request){
       $environment = env('APP_ENV');
       $plan = DB::table('plans')->where('id', $request->id)->first();
       return view('chargeSub', compact([
         'environment' => 'environment',
         'plan' => 'plan',
       ]));
    }

    public function paymentProccess(Request $request)
    {
      $validatedData = $request->validate([
        'cardnumber' => 'required',
        'cvv' => 'required',
        'ccExpiryMonth' => 'required',
        'ccExpiryYear' => 'required',
      ]);

      $plan = DB::table('plans')->where('id', $request->plan_id)->first();

      $stripe_customer_id = Auth::user()->stripe_customer_id;
      $stripe = new Stripe(env('STRIPE_SECRET'));

      $token = $stripe->tokens()->create([
          'card' => [
              'number' => $request->get('cardnumber'),
              'exp_month' => $request->get('ccExpiryMonth'),
              'exp_year' => $request->get('ccExpiryYear'),
              'cvc' => $request->get('cvv'),
          ],
      ]);

      if (!isset($token['id'])) {
        return back()->with('danger', 'Your token is not matching. Please try again.');
      }
      $card = $stripe->cards()->create($stripe_customer_id, $token['id']);

      // $charge = $stripe->charges()->create([
      //     'card' => $token['id'],
      //     'currency' => 'USD',
      //     'amount' => $plan->cost,
      //     'description' => 'Transcription Subscription',
      //     'capture' => 'true',
      //     'statement_descriptor' => "cheaptranscription.io",
      // ]);

      $subscription = $stripe->subscriptions()->create($stripe_customer_id , [
       'plan' => $plan->name,
     ]);

     DB::table('users')->where('id', Auth::id())->update([
       'is_subscribe' => 'Yes',
       'stripe_subscribe_id' => $subscription['id'],
     ]);

      if (!empty($subscription['id'])) {
        return redirect('/user-dashboard')->with('success', '<b>Congratulations! </b> Your subscription successed. Now you are a part of our customer.');
      } else {
        return back()->with('danger', 'We are sorry to say. We can not proccess your payment.');
      }
    }
}
