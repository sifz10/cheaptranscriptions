
@extends('layouts.frontend')

@section('content')
<script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <div class="article-clean">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-8 offset-lg-1 offset-xl-2">
                    <div class="intro">
                        <h1 class="text-center">How It Works</h1>
                    </div>
                    <div class="text">
                        <p><A HREF="http://CheapTranscription.io">CheapTranscription.io</A> uses machine learning to "listen" to your recordings and create automatic transcriptions. Audio transcription is traditionally resource intensive but thanks to new methods and systems we are able to turn any
                            audio file into text in a few seconds. We are spending money on technology instead of flashy websites and interfaces. Audio in, text out.</p>
                        <p></p>
                        <h2>Who runs it?</h2>
                        <p><A href="http://bigwidelogic.com">John Biggs</A> and <A HREF="https://www.edisonave.com">Tom Printy</A> run <A HREF="http://CheapTranscription.io">CheapTranscription.io</A>. They met at Watterson High School and spent years writing and programming. John is a journalist and Tom is a developer.</p>
                        <h2>Do you use humans?</h2>
                        <p>Yes, we do. We offer two types of transcription: fast, inexpensive robotic transcription and a human augmented version that will send your text to a human for checking. Automatic transcription takes a few minutes while human transcription can take up to ten hours.</p>
                        <h2>Why is it so cheap?</h2>
                        <p>Our lowest pricing tier depends entirely on machine learning for transcription. That way we can reduce the price to the absolute minimum. This also means that you may have some garbled text in your output but we strive to fix that with every order.&nbsp;</p>
                        <h2>I'm very angry/pleased. How can I contact you?</h2>
                        <p>Drop us a line at <A HREF="mailto:team@cheaptranscription.io">team@cheaptranscription.io</A>!</p>
                        <h2>Will robots take over the world?</h2>
                        <p>We hope not. That said, beleive that transcription is a function that is ripe for disruption. We're excited to build something that helps change it.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<hr>
<div class="row">
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

   

@endsection
