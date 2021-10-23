
@extends('layouts.frontend')

@section('content')
  

  <div class="contentpart">
    	<div class="container">


	@if (strlen($message) > 2)
	<div class="row">
          <a name="price"/>
      		<div class="col-md-12 order-md-1 text-center">
      			 <h4 class="mb-3">Pay and Go!</h4>
      			 <p>{!! $message !!}</p>
      		 </div>
     </div>
	 @else
	
      <div class="con-top">
      <div class="row">
          <a name="price"/>
      		<div class="col-md-12 order-md-1 text-center">
      			 <h4 class="mb-3">Pay and Go!</h4>
      			 <p>Your total price for this transcription is ${{ number_format($totalprice,2)}} ($0.50 is the minimum).  
      			 	 @if($transcriptiontype == 'human')
      			 	You have selected that your transcription be reviewed by a human.
      			 	@endif
      			 	Enter in your credit card details below and let the our Happy Robots go to work. 
      			 	We will send you an email to get the text of the transcription when we are done. </p>
      			 	
      			 	@if (strlen($ccmessage) > 2)
      			 	<div class="alert alert-danger" role="alert">
 						{!! $ccmessage !!}
					</div>
      			 	 @endif

      		 </div>
      </div>
      </div>
      <div class="row">
      		<div class="col-md-3 ">
      			&nbsp;
      		</div>	 
      		<div class="col-md-6 order-md-1">
      			 <form class="needs-validation" action="@if ($environment == 'local') {{url('processpayment') }} @else  {{secure_url('processpayment') }} @endif" method="POST" novalidate>
              	 {{ csrf_field() }}
			     <input type="hidden" id="transcribejobid" name="transcribejobid" value="{{$transcribejobid}}">   
			        
			        <div class="row">
			          <div class="col-md-12 mb-6">
			            <label for="cardnumber">Card Number</label>
			            <input type="text" class="form-control" name="cardnumber" id="cardnumber" placeholder="" value="" required>
			            <div class="invalid-feedback">
			              Card Number is Required
			            </div>
			          </div>
			          <div class="col-md-12 mb-6">
			            <label for="CVV">CVV</label>
			            <input type="text" class="form-control" id="CVV" name="cvv" placeholder="" value="" required>
			            <div class="invalid-feedback">
			              CVV is required.
			            </div>
			          </div>
			          
			          
			        
					    <div class="col-md-12">
					          <label for="expiration">Expiration</label>
					          <div class="row">
						          <div class="col-md-6">
						          	<input type="ccExpiryMonth" class="form-control" name="ccExpiryMonth" id="ccExpiryMonth" placeholder="MM">
						          </div>
						          	
						           <div class="col-md-6">
						           	<input type="ccExpiryYear" class="form-control" name="ccExpiryYear" id="ccExpiryYear" placeholder="YYYY">
						          </div>
					          </row>
					          <div class="invalid-feedback">
					           Month and Year of the expiration date.
					          </div>
		        			</div>
        				</div>
        			
        			
        				<div class="col-md-12 mb-6">
        					<button class="btn btn-primary btn-lg btn-block" type="submit">Pay!</button>
        				</div>
        			</div>
        		</div>
			      </form>      			 
      		</div>
      		<div class="col-md-3 ">
      			&nbsp;
      		</div>	
      </div>
      @endif
      
    </div>
  </div>
@endsection

