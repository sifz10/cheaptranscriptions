@extends('layouts.frontend')

@section('content')
  
  <div class="py-5 bg-light">
    <div class="container">

      
      <div class="row">
          <a name="pricce"/>
      		<div class="col-md-12 order-md-1 text-center">
      			 <h4 class="mb-3">Human Transcription</h4>
      			 <p>Enter in provided password to edit the transcription.</p>
      			
      		 </div>
      </div>
      
	  <div class="row">
	      <div class="col-md-6 order-md-1">
	      	<form class="updatetranscription" id="updatetranscription" action="@if ($environment == 'local') {{url('checktranscriptionpassword') }} @else  {{secure_url('checktranscriptionpassword') }} @endif" method="POST" enctype="multipart/form-data" >
		        {{ csrf_field() }}
		        <input type="hidden" id="transcribejobid" name="transcribejobid" value="{{$transcribejobid}}">  
		  		<div class="row">
			  		<div class="col-md-12 mb-3">
				            <label for="lastName">Password</label>
				            <input type="text" class="form-control" name="reviewpassword" id="reviewpassword" placeholder="" value="" required>
				            <div class="invalid-feedback">
				              Valid password is required.
				            </div>
				    </div>
				</div>
		        <div class="row">
		        	<div class="col-md-12 mb-3">
		        		<button type="submit" class="btn btn-primary btn-lg btn-block uploadbtn">Submit</button>
		        	</div>
		        </div>
		    </form>
	      </div> 
	   </div>
    	
      
    </div>
  </div>
<!-- Start of the Sales tracker code (place after LiveChat tracking code) -->
<script type="text/javascript">
  
</script>
<!-- End of the Sales tracker code -->
  
  
  
@endsection