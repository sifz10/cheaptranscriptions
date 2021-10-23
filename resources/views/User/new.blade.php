@extends('layouts.users')

@section('content')
  @php
  $environment = 'local';
  if(App::environment('production')) {
    $environment = 'production';
    \URL::forceScheme('https');

  }
  @endphp
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
            Start New Transcription
            </div>
            <div class="card-body">
              <div class="col-md-12">
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
                                <input type="text" class="form-control mb-3" value="" name="firstName" placeholder="First Name">
                            </div>
                            <div class="inputholder">
                                <input type="text" class="form-control mb-3" value="" name="lastName" placeholder="Last Name">
                            </div>
                            <div class="inputholder">
                                <input type="text" class="form-control mb-3" value="" name="email" placeholder="Email">
                            </div>
                            <div class="inputholder">
                                <input type="text" class="form-control mb-3" value="" name="coupon" placeholder="Coupon Code (Optional)">
                            </div>
                            <div class="inputholder">

                            <select class="form-control mb-3" id="language" name="language">
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

                            <select class="form-control mb-3" id="speakers" name="speakers">
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
                                    <input type="checkbox" value="Yes" class="mr-3" name="humanreview">I would like a human to review my transcription.
                                </label>
                            </div>
                            <div class="submitbtn">
                                <input id="starttranscription" class="btn btn-success" type="submit" value="Start!" name="" disabled>
                            </div>
                            </form>
              </div>
            </div>
          </div>

        </main>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://use.fontawesome.com/373a347df2.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="/js/jquery.validate.min.js"></script>
        <script src="/vendor/blueimp-file-upload/js/vendor/jquery.ui.widget.js"></script>
        <script src="/vendor/blueimp-file-upload/js/jquery.iframe-transport.js"></script>
        <script src="/vendor/blueimp-file-upload/js/jquery.fileupload.js"></script>
        <script src="/js/custom.js"></script>




        @if(empty($landing))

        <script src="/js/display.js"></script>
        <script src="/js/audio-control.js"></script>




        <script>
            $( document ).ready(function() {
                displayTranscript();
            });
        </script>
        @endif
        </body>
        </html>





        	<script>
        	$(document).ready(function(){

        		$('#uploadform').validate();

        		function scrollToAnchor(aid){

        		}

        		$(".scrolldown").click(function() {
           			var aTag = $("a[name='startupload']");
            		$('html,body').animate({scrollTop: aTag.offset().top},'slow');
        		});



        		$('#inputGroupFile01').on('change',function(){
                        //get the file name
                        var fileName = $(this).val().replace("C:\\fakepath\\", "");

                        //replace the "Choose a file" label
                        $(this).next('.custom-file-label').html(fileName);
                    })

        		$('#uploadform select[name="language"]').change(function () {
                if ($('#uploadform select[name="language"] option:selected').val() == 'en-US') {
                    $('#humanreviewoption').show();
                } else {
                    $('#humanreviewoption').hide();
                }
            });



        	});
        	</script>


@endsection
