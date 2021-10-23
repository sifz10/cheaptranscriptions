<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;

use Mail;
use App\Mail\userinvite;
use App\User;
use Cartalyst\Stripe\Stripe;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function UserDashboard()
    {
      $stripe = new Stripe(env('STRIPE_SECRET'));
      $subscription = $stripe->subscriptions()->find(Auth::user()->stripe_customer_id, Auth::user()->stripe_subscribe_id);

      // echo $subscription['plan']['id'];

      $current_plan = $subscription['plan']['id'];
      // die();
      if (!empty(Auth::user()->invited_by)) {
        $invited_by = DB::table('users')->where('id', Auth::user()->invited_by)->value('email');
        $transcribejob = DB::table('transcribejobs')->where('email', $invited_by)->get();
      }else {
        $transcribejob = DB::table('transcribejobs')->where('email', Auth::user()->email)->get();
      }
      return view('User.dashboard', compact('transcribejob','current_plan'));
    }

    public function seeTransDetails(Request $request)
    {
      $trans = DB::table('transcribejobs')->where('id', $request->id)->first();
      $transResult = DB::table('transcriptiontexts')->where('transcribejobsid', $trans->id)->first();
      return view('User.transcription',compact('trans', 'transResult'));
    }

    public function invitedUser(Request $request)
    {
      $users = DB::table('users')->where('invited_by', Auth::id())->get();
      return view('User.invitedUser',compact('users'));
    }

    public function invitedUserPost(Request $request)
    {
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
      ]);

        $user = $request->all();

        Mail::to($request->email)->send(new userinvite($user));
        $stripe = new Stripe(env('STRIPE_SECRET'));

        $customer = $stripe->customers()->create([
          'email' => $request['email'],
          'name' => $request['name'],
          'description' => 'This is a user of cheaptransactions.',
        ]);

        DB::table('users')->insert([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
          'invited_by' => Auth::id(),
          'stripe_customer_id' => $customer['id'],
          'is_subscribe' => 'Yes',
        ]);

        return back()->with('success', 'System has been sent an invitation to the user mail.');
    }

    public function DeleteUser(Request $request)
    {
      DB::table('users')->where('id', $request->id)->delete();
      return back()->with('danger', 'User delete!');
    }

    public function startNewTranscriptions(Request $request)
    {
      return view('User.new');
    }
}
