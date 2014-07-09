// JavaScript Document
var isVisible = false;

$(document).ready(function(){
	var BLB_LOGO_WIDTH = 337;
	$('div.categories').hide(); //start with category choices hidden
	positionLogo();
	
	$(window).resize(function(){
		positionLogo();
	});
	
	function positionLogo(){
		//position BLB_logo
		$('#BLB').css('top',$('#rightCol').offset().top - 40);
		
		var BLB_width = $('#BLB').width();
		if (BLB_width==0) {
			BLB_width=BLB_LOGO_WIDTH; //fix this for first page load
		}
		var marginSpace = ($('#rightCol').width() - BLB_width)/2;
		if (marginSpace >=0) {
			$('#BLB').css('left',$('#rightCol').offset().left + marginSpace);
		}
		else $('#BLB').css('left',$('#rightCol').offset().left + 10);
	}
	
	$('#toggleOpts').click(function() { //make categories appear or disappear
		$('div.categories').toggle("slow");
		if (isVisible==false){
			isVisible=true;
			$('#toggleOpts').html("(Show less)");
		} else {
			isVisible=false;
			$('#toggleOpts').html("Choose Game Topic Areas");
		}	
	});
	
	var displayingRules = false;
	$('#displayRules').click(function() {
		Show_Popup();
		displayingRules = true;
	});
	function Show_Popup() {
		$('#popup').fadeIn('fast');
		$('#window').fadeIn('fast');
	}
	$('#closePopup').click(function(e) {
		e.preventDefault();
		Close_Popup();
	});
	function Close_Popup() {
		$('#popup').fadeOut('fast');
		$('#window').fadeOut('fast');
	}
	$('#popup').click(function(){
		if (displayingRules) {
			Close_Popup();
		}
	});
	
	$("#chooseAll").click(function(){
		$('input:checkbox').each( function() {
     		this.checked = "checked";
		});
		return false;
	});
	
	$("#chooseNone").click(function(){
		$('input:checkbox').each( function() {
     		this.checked = "";
		});
		return false;
	});
	
	$('#start').click(function(){
		//count # of checked checkboxes
		var numChecked = $("input[name=category[]]:checked").length;
		//don't go on if no categories checked
		if (numChecked==0){
			alert('Please choose at least one category.');
			return false;
		} 
	});
});

//Google Analytics
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22864126-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();