@extends('layouts.admin')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
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

		 <div id="myChart" style="width: 900px; height: 380px"></div>


          <h2>Transcription Jobs</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Job ID</th>
                  <th>Date/Time</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>Job Status</th>
                  <th>Cost</th>
                  <th>Paid</th>
                  <th>Trans ID</th>
                  <th>Review Password</th>
                  <th>Sound File</th>
               <th>Commands</th> 
		</tr>
              </thead>
              <tbody>
              	@foreach($jobs as $job)
                <tr>
		@if ($job->transcriptiontype =='human')
			<tr bgcolor="#b2dffd">
		@else
			<tr>
		@endif
                  <td>{{$job->id}}</td>
                   <td>{{$job->created_at}}</td>
                  <td>{{$job->firstname}}</td>
                  <td>{{$job->lastname}}</td>
                  <td>{{$job->email}}</td>
                  <td>{{$job->status}}</td>
                  <td>{{$job->total_amount}}</td>
                  <td> @if($job->billingsuccessful == 1) YES @else NO @endif</td>
                  <td><a href="/transcribestatus/{{$job->transactionid}}" target="review">{{$job->transactionid}}</a></td>
                  <td><a href="/reviewtranscription/{{$job->transactionid}}" target="review">{{$job->reviewpassword}}</td>
                  <td><a href="{{url('/storage/soundfiles/'.$job->soundfilename)}}" target="soundfile">Download File</a></td>
<td><a href="/fail/{{$job->transactionid}}" target="fail">FAIL</td>                

</tr>
               @endforeach
              </tbody>
            </table>
          </div>
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


	 function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Jobs'],
          @foreach($jobsbydate  as $jbd)
          
          ['{{$jbd->date}}', {{$jbd->sales}},   {{$jbd->jobs}}],
          
          @endforeach
         
        ]);

        var options = {
          title: 'Cheaptranscription Sales',
          curveType: 'function',
          legend: { position: 'bottom' }
        };


    
     	var chart = new google.visualization.LineChart(document.getElementById('myChart'));

		chart.draw(data, options);
      }
    </script>
          
          
        </main>
@endsection
