
@extends('layouts.frontend',['landing' => TRUE])

@section('content')
<body>
    <div class="menuSlide">
        <div class="rightMenu">
            <a href="javascript:void(0)" class="closeSlide">X</a>

            <div class="siteMenu">
            <div class="floatinglogo">
                	<a href="/"><img src="img/logo_small.png" alt=""></a>
                </div>
                <ul>
                	<li><a href="/">Home</a></li>
                  <li>
                  	<a href="/how-it-works">How it works</a>
                  </li>
									<li>
                  	<a href="mailto:team@cheaptranscription.io">Contact Us</a>
                  </li>
									@if (empty(Auth::user()))
										<li>
											<a href="/login">login</a>
										</li>
										<li>
											<a href="/register">Register</a>
										</li>
									@elseif (Auth::user()->role == "Admin")
										<li>
											<a href="/admin">Admin dashboard</a>
										</li>
									@elseif (Auth::user()->role == "clients")
										<li>
											<a href="/user-dashboard">Dashbboard</a>
										</li>
									@endif

                </ul>
			</div>
        </div>
    </div>

    <div class="header-banner" style="background:url(img/banner.png) no-repeat center center">
        <div class="container">
            <div class="header">
            <div class="logo">
                <a href="/"><img src="img/logo_small.png" alt=""></a>
            </div>
            <div class="hamberger">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>

        <div class="bannercontent">
            <div class="bannerform-container">
                <h3>Start Your Transcription</h3>
                <div class="bannerform">
				<form class="uploadform" id="uploadform" action="@if ($environment == 'local') {{url('newtranscription') }} @else  {{secure_url('newtranscription')}} @endif" method="POST" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <input type="hidden" id="savedfilename" name="savedfilename" value="">


                    <div class="inputholder">
                        <div class="upFile">
                            <span class='label label-info' id="upload-file-info">Choose File</span>
                            <label class="selecter" for="my-file-selector">
                            <input id="my-file-selector" type="file" multiple="multiple" name="soundfile" data-url="@if($environment == 'local'){{url('upload') }}@else{{secure_url('upload')}}@endif" style="display:none"
                            onchange="$('#upload-file-info').html(
                            (this.files.length > 1) ? this.files.length + ' files' : this.files[0].name)">
                            <span class="browsebtn"><img src="img/plus-icon.png" alt="">Browse</span>
                            </label>
                        </div>
                    </div>
                    <div class="inputholder">
                    	<ul id="file-upload-list" class="list-unstyled"></ul>
                    </div>
                    <div class="inputholder">
                        <input type="text" value="" name="firstName" placeholder="First Name">
                    </div>
										<div class="inputholder">
                        <input type="text" value="" name="lastName" placeholder="Last Name">
                    </div>
                    <div class="inputholder">
                        <input type="text" value="" name="email" placeholder="Email">
                    </div>
                    <div class="inputholder">
                        <input type="text" value="" name="coupon" placeholder="Coupon Code (Optional)">
                    </div>
										<div class="inputholder">

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
				<div class="inputholder">

                    <select class="form-control" id="speakers" name="speakers">
						    <option value="">Select Number Of Speakers</option>
						    <option value="2">1</option>
						    <option value="2">2</option>
						    <option value="3">3</option>
						    <option value="4">4</option>
						    <option value="5">5</option>
						    <option value="6">6</option>
						    <option value="7">7</option>
						    <option value="8">8</option>
						    <option value="9">9</option>
						    <option value="10">10</option>
						 	<option value="11">More Than 10</option>



						  </select>
							</div>


										<div class="checkbox">
                        <label>
                            <input type="checkbox" value="Yes" name="humanreview">
                            <p>I would like a human to review my transcription.</p>
                        </label>
                    </div>
                    <div class="submitbtn">
                        <input id="starttranscription" type="submit" value="Start!" name="" disabled>
                    </div>
                    </form>
                </div>
          </div>

            <div class="content-in">
<h2>We instantly turn speech into text for 10 cents a minute.</h2>
</div>
        </div>
        </div>
        </div>
    <div class="contentpart">
    	<div class="container">
        	<div class="con-top">
        	<p><a href="https://cheaptranscription.io/">CheapTranscription.io</a> offers the cheapest and fastest transcription on the Internet. How do we do it? With a combination of machine learning and human proofreaders, <strong>we are able to turn an audio file into text</strong> in a few minutes instead of a few hours for way less than the other guys. If you need it fast, <strong>trust CheapTranscription.io.</strong></p>
<p>There are other services out there that use automatic transcription but they are too complicated and too pricey after their free trial periods. We built CheapTranscription to serve podcasters, writers, journalists, and anyone else who needs a solid, usable transcription in minutes.
           </p>
            </div>
            <div class="threeblocks">
            	<div class="blocks">
                	<img src="img/icon-1.png" alt="">
                    <h4>Super fast transcription</h4>
                    <p>We often return text in less than five minutes. Upload your audio and give us a minute. Our Happy Robots are waiting.</p>
                </div>
                <div class="blocks">
                	<img src="img/icon-2.png" alt="">
                    <h4>Super cheap transcription</h4>
                    <p>Pay pennies per minute. We charge 10 cents per minute for automatic transcription and 85 cents per minute for human-assisted transcription. Our minimum bill is 50 cents.</p>
                </div>
                <div class="blocks">
                	<img src="img/icon-3.png" alt="">
                    <h4>Be Happy</h4>
                    <p> if you're not happy we'll refund your purchase. <a href="mailto:team@cheaptranscription.io">Email our team for more info.</A></p>
                </div>
            </div>

            <a href="how-it-works" class="btn">How It Works</a>
<p><p>
<iframe width="560" height="315" src="https://www.youtube.com/embed/aTa9mOut45k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
</div>


@endsection
