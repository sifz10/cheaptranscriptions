
@extends('layouts.frontend')

@section('content')
  

  <div class="contentpart">
    	<div class="container">


			
			 	<div class="row">
		          
		      		<div class="col-md-12 order-md-1 text-center">
		      			 <h3 class="mb-3">Transcription Status</h3>
		      			 <p>{{$message}}</p>
		      		 </div>
		      	</div>
			
		        	 
		      
		      
		      @if ($transcribejobstatus == 'complete')
		      <div class="row transcription">
		      		<div class="col-md-3 order-md-1">
		      			<p>Here is the text of your transcription.
		      			<br>
		      			@if ($transcriptiontype == 'ai')
		      			Here is what the colors mean:<br />
		      			<span class="l90">Red</span> We are less than 90 percent sure what was said.<br />	
		      			<span class="l95">Orange</span> We are greater than 90 percent what was said but not 100% confident.</span>	
		      			</p>
		      			<p><a href="#" class="copy-btn" onClick="CopyToClipboard('content')">Copy to clipboard</a></p>
		      			@endif

		      			<p><A HREF="/word/{{$transcribejobid}}">Download as Word File</A></p>
						<!-- audio control section -->
					    <p>Listen to the Audio</p>
					    <div class="audio-box">
					      <audio id="audio" controls>
					      <source src="{{url('/storage/soundfiles/'.$soundfile)}}" type="audio/mpeg">
					    	Your browser does not support the audio element.
					    </audio>
						</div>
		      		</div>	 
		      		<div class="col-md-6 order-md-1">
		      			
		      				 <div id="content" contenteditable="true">
		      				 	@if ($transcriptiontype == 'ai')
								<input type="hidden" id="user-filename" value="{{url('/storage/temps/'.$jsonfile)}}">	
								<div class="speaker">
		    					
		    						</div>
		    					@else
		    					<div class="scrollbox"> 
			    					{!! $transcribetext !!}
			    				</div>
		    					@endif
		    				</div>
		    			
		      		</div>
		      		<div class="col-md-3 order-md-1">
		      			&nbsp;
		      		</div>	
		      </div>
		     
		      @endif
		      
		</div>
	</div>     
   
<script>(function(t,e,s,o){var n,a,c;t.SMCX=t.SMCX||[],e.getElementById(o)||(n=e.getElementsByTagName(s),a=n[n.length-1],c=e.createElement(s),c.type="text/javascript",c.async=!0,c.id=o,c.src=["https:"===location.protocol?"https://":"http://","widget.surveymonkey.com/collect/website/js/tRaiETqnLgj758hTBazgd_2BdtygwRClb30FX5uodb5CN776gGNFczyec5pZY_2BJRLF.js"].join(""),a.parentNode.insertBefore(c,a))})(window,document,"script","smcx-sdk");</script> 
<!-- Start of the Sales tracker code (place after LiveChat tracking code) -->
<script type="text/javascript">
  var LC_API = LC_API || {on_after_load: function(){}};
  (function(cb){
    LC_API.on_after_load = function(){
      cb();try { 
      	LC_API.trigger_sales_tracker('dH8tuzjMkbCotvixJn1mj9XO3Vhu2lrH');
			} catch (error) {
				if (window.console){ console.log('LiveChat sales tracker error:', error); }
			}
    };
  })(LC_API.on_after_load);
</script>

 

<!-- End of the Sales tracker code -->

<!-- Event snippet for Website sale conversion page -->
<script>
  gtag(‘event’, ‘conversion’, {
      ‘send_to’: ‘AW-1015967670/d_w4CLje2OYBELbfueQD’,
      ‘transaction_id’: ‘’
  });
</script>


@endsection
