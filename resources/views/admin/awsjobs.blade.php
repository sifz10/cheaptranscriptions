@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-secondary"></button>
                <button class="btn btn-sm btn-outline-secondary"></button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
              </button>
            </div>
          </div>


          <h2>AWS Job QUEUE (last 100)</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Job Name</th>
                  <th>Start Date/Time</th>
                  <th>Completed Date/Time</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
              	@foreach($results['TranscriptionJobSummaries'] as $job)
                <tr>
                  <td>{{$job['TranscriptionJobName']}}</td>
                  <td>{{$job['CreationTime']}}</td>
                  <td>@isset($job['CompletionTime']) {{$job['CompletionTime']}} @endisset</td>
                  <td>{{$job['TranscriptionJobStatus']}}</td>
                  
                </tr>
               @endforeach
              </tbody>
            </table>
          </div>
  
          
        </main>
@endsection
