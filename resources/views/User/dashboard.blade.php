@extends('layouts.users')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
      <br>
      <br>
      <br>
      @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard [Plan : {{ $current_plan }}]</h1>
          </div>

          <p>Hi <b> {{ Auth::user()->name }} </b>, Good to see you again. </p>
          <hr>
          <div class="col-md-12">
            <h4>Your Transcription Jobs : </h4>
            <table class="table table-hover">
              <thead>
                <tr>
                  {{-- <th scope="col">Job ID</th> --}}
                  <th scope="col">Trans ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Email</th>
                  <th scope="col">Job Status</th>
                  {{-- <th scope="col">Paid</th> --}}
                  {{-- <th scope="col">Sound File</th> --}}
                  <th scope="col">See result</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($transcribejob as $trans)
                  <tr>
                    {{-- <th scope="row">{{ $trans->id }}</th> --}}
                    <td>{{ $trans->transactionid }}</td>
                    <td>{{ $trans->firstname }}</td>
                    <td>{{ $trans->email }}</td>
                    <td>{{ $trans->status }}</td>
                    {{-- @if ($trans->billingsuccessful == 1)
                      <td>Paid</td>
                    @else
                      <td>No</td>
                    @endif --}}
                    {{-- <td>
                      <a href="{{ url('/storage/soundfiles/'.$trans->soundfilename) }}">Download File</a>
                    </td> --}}

                    <td>
                      <a href="{!! route('user.trans.details',$trans->id ) !!}" class="btn btn-info">View</a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td class="text-center" colspan="8">No records found!</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </main>
@endsection
