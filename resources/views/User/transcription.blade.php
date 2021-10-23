@extends('layouts.users')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <br>
      <br>
      <br>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
          </div>

          <p>Hi <b> {{ Auth::user()->name }} </b>, Good to see you again. </p>
          <hr>

          <div class="card">
            <div class="card-header">
              Transcription Details
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"> <b>Name : </b> {{ $trans->firstname }}</li>
              <li class="list-group-item"> <b>Email : </b> {{ $trans->email }}</li>
              <li class="list-group-item"> <b>Job ID : </b> {{ $trans->transactionid }}</li>
              {{-- <li class="list-group-item"> <b>Transcription Type : </b> {{ $trans->transcriptiontype }}</li> --}}
              <li class="list-group-item"> <b>Job Status : </b> {{ $trans->status }}</li>
              <li class="list-group-item"> <b>Sound File : <a href="{{ url('/storage/soundfiles/'.$trans->soundfilename) }}">Download File</a></li>
                @if (!empty($transResult))
                  <li class="list-group-item"> <b>Text Convert : {{ $transResult->transcriptiontext }}</li>
                  <li class="list-group-item"> <b>Total Word : {{ $transResult->wordcount }}</li>
                @endif

            </ul>
          </div>

        </main>
@endsection
