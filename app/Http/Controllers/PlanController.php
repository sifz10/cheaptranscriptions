<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Image;
use App\Plan;

class PlanController extends Controller
{
  public function index()
  {
    $plans = Plan::all();
    return view('admin.Plans.plan', compact('plans'));
  }
}
