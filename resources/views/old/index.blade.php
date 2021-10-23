
@extends('layouts.frontend')

@section('content')
  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">
      	<A HREF="http://cheaptranscription.io"><img class="img-fluid logoclass" src="img/logo_new.png"></A></h1>
      <p class="lead">Super Fast Transcription For 10 Cents a Minute. ($0.50 minimum)</p>
<p class="lead">Or 85 Cents Per Minute For Human-Edited Transcriptions</p>
      <p class="lead text-muted text-left">CheapTranscription.io offers the cheapest and fastest transcription on the Internet. How do we do it? With a combination of machine learning and human proofreaders, we are able to turn an audio file into text in a few minutes instead of a few hours for way less than the other guys. If you need it fast, trust CheapTranscription.io.
<p>Remember: our robots get better over time so there may be some odd artifacts caused by noisy audio. We will do our best to fix this for you but some words might get garbled. Please be patient while we train our bots! </p>
      <p>
        <a href="#" class="scrolldown btn btn-primary my-2">Upload Your file</a>
        <a class="btn btn-secondary my-2 " href="/how-it-works">How It Works</a>
      </p>
    </div>
  </section>

  <div class="py-5 bg-light">
    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
       <img src="/img/time.png" width=100% height=255>     
	<div class="card-body">
              
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                 <p class="card-text">Super fast transcription - sometimes we can return text in less than five minutes.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
       <img src="/img/cheap.png" width=100% height=255>            
<div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <p class="card-text">Super cheap transcription - pay pennies per minute.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4 shadow-sm">
       <img src="/img/happy.png" width=100% height=255>            
<div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                   <p class="card-text">Be happy - if you're not happy we'll refund your purchase. Email <A HREF="mailto:team@cheaptranscription.io">our team</A> for more info.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="row">
            <a name="startupload"/>
      		<div class="col-md-12 order-md- text-center">
      			 <h4>Start Your Transcription</h4>
      		 </div>
      		
      </div>
      <div class="row">
      		<div class="col-md-3 order-md-1">
      			 <div class="loader" style="display:none">Loading...</div>
      		</div>	 
      		<div class="col-md-6 order-md-1">
      			 <form class="uploadform" id="uploadform" action="@if ($environment == 'local') {{url('newtranscription') }} @else  {{secure_url('newtranscription') }} @endif" method="POST" enctype="multipart/form-data" >
              		{{ csrf_field() }}
			        <div class="row">
				       <div class="mb-3">

					         <input type="file" name="soundfile" class="custom-file-input form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
		           			<label class="custom-file-label form-control " for="inputGroupFile01">Choose file</label>		        				        			 		        		

		           		</div>
	        		</div>	
			        
			        <div class="row">
			          <div class="col-md-6 mb-3">
			            <label for="firstName">First name</label>
			            <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
			          </div>
			          <div class="col-md-6 mb-3">
			            <label for="lastName">Last name</label>
			            <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
			            <div class="invalid-feedback">
			              Valid last name is required.
			            </div>
			          </div>
			        </div>
			       
				    <div class="mb-3">
				          <label for="email">Email <span class="text-muted">(we will let you know when it is done)</span></label>
				          <input type="email" class="form-control" name="email" id="email" placeholder="you@aregreat.com" required email>
	        		</div>
	        		
	        		<div class="mb-3">
	        			<label for="sel1">Language</label>
						  <select class="form-control" id="language" name="language">
						    <option value="en-US">US English</option>
						    <option value="es-US">US Spanish</option>
						    <option value="en-GB">British English</option>
						    <option value="en-AU">Australian English</option>
						    <option value="fr-FR">French</option>
						    <option value="fr-CA">Canadian French</option>
						    <option value="it-IT">Italian</option>
						    <option value="pt-BR">Brazilian Portuguese</option>
						  </select>
					</div>
	        		
	        		
	        		
        			<div class="mb-3">
                   		<label for="coupon">Coupon Code <span class="text-muted">(optional)</span></label>
                        <input type="coupon" class="form-control" name="coupon" id="coupon" placeholder="" coupon>
                   </div>
                   <div class="form-check" id="humanreviewoption">
    					<input type="checkbox" class="form-check-input" id="humanreview" name="humanreview" value="1">
    					<label class="form-check-label" for="humanreview">I would like a human to review my transcription for 85 cents per minute.</label>
  				   </div>        			 
        			
        			
        			<hr class="mb-4">
        			<button type="submit" class="btn btn-primary btn-lg btn-block uploadbtn">Upload</button>
			      </form>      			 
      		</div>
      		<div class="col-md-3 order-md-1">
      			&nbsp;
      		</div>	
      </div>
      
    </div>
  </div>
@endsection
