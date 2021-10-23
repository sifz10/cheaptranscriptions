
@extends('layouts.frontend')

@section('content')
  <div class="contentpart">
    	<div class="container">
        <div class="row">
          @forelse ($plans as $plan)
            <div class="col-md-4 m-auto">
              <div class="card text-center" style="background: #ffffff;  border-radius: 10px; padding:2px; box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.5 ); margin-bottom: 1rem">
                <div class="card-header">
                  {{ $plan->name }}
                </div>
                <div class="card-body">
                  <h2>${{ $plan->cost }} / <sub>{{ $plan->description }}</sub> </h2>
                  <p class="card-text">Subscription allows you to run unlimited transcription and allow you to access all trasaction lifetime.</p>
                  <a href="{!! route('gettingPaid', $plan->id) !!}" class="btn btn-primary">Pay Now</a>
                </div>
              </div>
            </div>
          @empty
            <div class="col-md-4 m-auto">
              <div class="card text-center" style="background: #ffffff;  border-radius: 10px; padding:2px; box-shadow: 1px 1px 9px -1px rgba(0,0,0,0.5 ); margin-bottom: 1rem">
                <div class="card-header">
                  No Packages Found
                </div>
                <div class="card-body">
                  <h2>No Packages Found</h2>
                  <p class="card-text">Subscription allows you to run unlimited transcription and allow you to access all trasaction lifetime.</p>
                  <a href="#" class="btn btn-primary" disabled>Pay Now</a>
                </div>
              </div>
            </div>
          @endforelse
        </div>
    </div>
  </div>
@endsection
