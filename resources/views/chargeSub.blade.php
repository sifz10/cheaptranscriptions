
@extends('layouts.frontend')

@section('content')


  <div class="contentpart">
    	<div class="container">

      <div class="con-top">
      <div class="row">
          <a name="price"/>
      		<div class="col-md-12 order-md-1 text-center">
      			 <h4 class="mb-3">Pay and Go!</h4>
      			 	Enter in your credit card details below and let the our Happy Robots go to work.
      			 	You will be charged ${{ $plan->cost }} USD. And you will be a subscriber.</p>

      		 </div>
      </div>
      </div>
      @if ($errors->any())
          <div class="alert alert-danger">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
          </div>
      @endif
      <div class="row">
      		<div class="col-md-3 ">
      			&nbsp;
      		</div>
      		<div class="col-md-6 order-md-1">
      			 <form class="needs-validation" action="{!! route('paymentProccess') !!}" method="POST" novalidate>
              	 {{ csrf_field() }}
			       <input type="hidden" name="plan_id" value="{{ $plan->id }}">

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
        					<button class="btn btn-primary btn-lg btn-block" type="submit">Pay (${{ $plan->cost }} USD)</button>
        				</div>
        			</div>
        		</div>
			      </form>
      		</div>
      		<div class="col-md-3 ">
      			&nbsp;
      		</div>
      </div>

    </div>
  </div>
@endsection
