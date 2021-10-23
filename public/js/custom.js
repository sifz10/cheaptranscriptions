//$(window).on('load', function() { // makes sure the whole site is loaded 
//  //$('#status').fadeOut(); // will first fade out the loading animation 
//  $('#preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website. 
//  $('body').delay(350).css({'overflow-x':'hidden'});
//  //$('body').addClass('loaded');
//})

//var BASE_URL = "home.html";

$( document ).ready(function() {	
	// menu bar
	$(".hamberger").click(function(){
	  $(".menuSlide").addClass("onMenu");
	  $(".rightMenu").addClass("slideON");
	  //$(".effectText li").addClass("Effectsli");
	});
	
	$(".closeSlide").click(function(){
	  $(".menuSlide").removeClass("onMenu");
	  $(".rightMenu").removeClass("slideON");
	});
	
	
	
});


$(function(){
	//equalheight jquery start
	$(window).bind("load", function() {
		equalHeight($(".threeblocks .blocks h4"));
		equalHeight($(".threeblocks .blocks p"));
	});	
	
	$(window).resize(function() {	
	equalHeight($(".threeblocks .blocks h4"));
	equalHeight($(".threeblocks .blocks p"));
});
});	


function equalHeight(group) {
	 var tallest = 0;
	 group.each(function() {
	 var thisHeight = jQuery(this).height();
	 if(thisHeight > tallest) {
	 tallest = thisHeight;
	 }
	 });
	 group.height(tallest);
}


var onImgLoad = function(selector, callback){
    $(selector).each(function(){
        if (this.complete || /*for IE 10-*/ $(this).height() > 0) {
            callback.apply(this);
        }
        else {
            $(this).on('load', function(){
                callback.apply(this);
            });
        }
    });
};

var $ = window.$; // use the global jQuery instance

var $uploadList = $("#file-upload-list");
var $fileUpload = $('#my-file-selector');
if ($uploadList.length > 0 && $fileUpload.length > 0) {
    var idSequence = 0;

    // A quick way setup - url is taken from the html tag
    $fileUpload.fileupload({
        maxChunkSize: 10000000,
        method: "POST",
        // Not supported
        sequentialUploads: false,
        formData: function (form) {
            // Append token to the request - required for web routes
            return [{name: '_token', value: $('input[name=_token]').val()}];
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $("#" + data.theId).text('Uploading ' + progress + '%');
        },
        add: function (e, data) {
            data._progress.theId = 'id_' + idSequence;
            idSequence++;
            $uploadList.append($('<li id="' + data.theId + '"></li>').text('Uploading'));
            data.submit();
        },
        done: function (e, data) {
            console.log(data, e);
            $uploadList.append($('<li></li>').text('Uploaded: Complete!'));
            $('#savedfilename').val(data.result.name);
             $("#starttranscription").attr("disabled",false);
            
        }
    });
}

