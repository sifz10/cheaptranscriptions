@extends('layouts.frontend')

@section('content')
  
  <div class="py-5 bg-light">
    <div class="container">

      
      <div class="row">
          <a name="pricce"/>
      		<div class="col-md-12 order-md-1 text-center">
      			 <h4 class="mb-3">Human Transcription</h4>
      			 <p>A user has requested that this transcription be reviewed</p>
      			 <p>{{ $message }}</p>
      		 </div>
      </div>
      
	  <div class="row">
	      <div class="col-md-12 order-md-1">
	      	<form class="updatetranscription" id="updatetranscription" action="@if ($environment == 'local') {{url('updatetranscription') }} @else  {{secure_url('updatetranscription') }} @endif" method="POST" enctype="multipart/form-data" >
		        {{ csrf_field() }}
		        <input type="hidden" id="transcribejobid" name="transcribejobid" value="{{$transcribejobid}}">  
		        <textarea name="transcription" form="updatetranscription"  style="width:100%" rows=20 >{!!$transcribetext!!}</textarea>
		        
		        <button type="submit" class="btn btn-primary btn-lg btn-block uploadbtn">Save</button>
		    </form>
	      </div> 
	   </div>
    	<div class="row">
    		 <div class="col-md-12 order-md-1">
    		 	&nbsp;
    		 </div>
    	</div>
    
    	<div class="row">
	      <div class="col-md-12 order-md-1">
	      	<p>
      		<audio preload="auto" controls>
      			<source src="{{url('/storage/soundfiles/'.$soundfile)}}" type="audio/mpeg">
				
			</audio>
			</p>
			<p>
      			<a href="{{url('/storage/soundfiles/'.$soundfile)}}">Download File</a>
        	<p>
      	  </div> 
	   </div>
      
    </div>
  </div>
<!-- Start of the Sales tracker code (place after LiveChat tracking code) -->
<script type="text/javascript">
  
</script>
<!-- End of the Sales tracker code -->
  
  
  
@endsection