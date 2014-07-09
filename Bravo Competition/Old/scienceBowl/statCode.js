// JavaScript Document

$(document).ready(function() {	
	var correctEmpty = false; //arrays will always have one element
	var wrongEmpty = false; // but if they are really empty, they will have element[0]===""
	var correctP2Empty = false;
	var wrongP2Empty = false;
	//detect if arrays are empty
	if (correct.length==1 && correct[0]===""){
		correctEmpty=true;
	}
	
	if (wrong.length==1 && wrong[0]===""){
		wrongEmpty=true;
	}
	
	//change strings to integers
	if (!correctEmpty){
		for (var m=0; m<correct.length; m++){
			correct[m] = parseInt(correct[m]);
		}
	} else{
		correct = new Array();
	}	
	if (!wrongEmpty){
		for (var m=0; m<wrong.length; m++){
			wrong[m] = parseInt(wrong[m]);
		}
	} else{
		wrong = new Array();
	}
	if(playerCount=="multi") {
		if (correctP2.length==1 && correctP2[0]===""){
			correctP2Empty=true;
		}
		if (wrongP2.length==1 && wrongP2[0]===""){
			wrongP2Empty=true;
		}
		if (!correctP2Empty){
			for (var m=0; m<correctP2.length; m++){
				correctP2[m] = parseInt(correctP2[m]);
			}
		} else{
			correctP2 = new Array();
		}	
		if (!wrongP2Empty){
			for (var m=0; m<wrongP2.length; m++){
				wrongP2[m] = parseInt(wrongP2[m]);
			}
		} else{
			wrongP2 = new Array();
		}
	}
	if(playerCount=='multi') {
		displayMultiStats();
	} else {
		displayStats();
	}
	writeQuestions();
	$('.rateImg').live('click',function() {
		var currImg = $(this).attr('src');
		var currRow = $(this).parent();
		var op = "";
		currImg = currImg.substring(currImg.lastIndexOf('/')+1,currImg.length);
		if(currImg=="iconThumbsup.png") {
			op="voteup";
		} else if(currImg=="iconThumbsdown.png") {
			op="votedown";
		}
		var dataString = 'Question='+ $(this).attr('rel')+'&op=' + op;
		$.ajax({
			type: "POST",
			url: "vote.php",
			data: dataString,
			cache: false,
			success: function(msg) {
				// TO-DO:  SWAP IMAGES IN CURRENT ROW TO DISABLED STATUS
				$(currRow).html("Vote Received!");
			}
		});
	});
	//print out left column game statistics
	function displayStats(){
		$('#elapsed').html(secondsToMinutes(timeElapsed));
		$('#numQs').html(correct.length+wrong.length);
		if (correct[0]==="" && correct.length==1){
			$('#numCorrect').html("0");
		} else{
			$('#numCorrect').html(correct.length);
		}
		if (wrong[0]==="" && wrong.length==1){
			$('#numWrong').html("0");
		} else{
			$('#numWrong').html(wrong.length);
		}
		$('#aveRespT').html(aveResponseTime + " secs");
	}
	function displayMultiStats(){
		$('#elapsed').html(secondsToMinutes(timeElapsed));
		$('#elapsedP2').html(secondsToMinutes(timeElapsed));
		$('#numQs').html(correct.length+wrong.length);
		$('#numQsP2').html(correctP2.length+wrongP2.length);
		if (correct[0]==="" && correct.length==1){
			$('#numCorrect').html("0");
		} else{
			$('#numCorrect').html(correct.length);
		}
		if (correctP2[0]==="" && correctP2.length==1){
			$('#numCorrectP2').html("0");
		} else{
			$('#numCorrectP2').html(correctP2.length);
		}
		if (wrong[0]==="" && wrong.length==1){
			$('#numWrong').html("0");
		} else{
			$('#numWrong').html(wrong.length);
		}
		if (wrongP2[0]==="" && wrongP2.length==1){
			$('#numWrongP2').html("0");
		} else{
			$('#numWrongP2').html(wrongP2.length);
		}
		$('#aveRespT').html(aveResponseTime + " secs");
		$('#aveRespTP2').html(chkRespVal(aveResponseTimeP2 + " secs"));
	}
	function chkRespVal(val) {
		if(val=="NaN secs") {
			return('N/A');
		} else {
			return val;
		}
	}
	//returns a string: minutes/secs of gameplay
	function secondsToMinutes(secs){
		secs = parseInt(secs);
		var mins = Math.floor(secs / 60);
		secs = secs % 60;
		if (secs < 10){
			return mins + ":0"+ secs;
		} else {
			return mins + ":"+ secs;
		}
	}
	
	function writeQuestions() {
		for (var j=0; j<q.length; j++){
			var tableString;
			var ans;
			var userResponse;
			var checkInWrong = true;
			if (!correctEmpty){
				for (var i=0; i<correct.length; i++){
					if (correct[i]==j){
						ans = getAnswer(answer[j], j);
						userResponse = userAns[j];
						tableString = "<tr><td class='icon'><img src='pics/checkmark.png' alt='Correct'/></td><td>" + c[j] + " / " + d[j] + "</td> <td>"+q[j]+"</td><td><div style='float:right;margin-left:10px;'><a href='javascript:void(0)' title='" + r[j].replace(/\\/g, '') + "'><img src='pics/info.png' border='0' align='absmiddle' /></a></div>"+ans+"</td><td/><td nowrap='nowrap'><img class='rateImg' src='pics/iconThumbsup.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "+'/> <img class='rateImg' src='pics/iconThumbsdown.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "-'/></td></tr>";	
						$('#questionTable').append(tableString);
						checkInWrong= false;
						break;
					}
				}
			}
			if (!wrongEmpty && checkInWrong){
				for(var i=0; i<wrong.length; i++) {
					if (wrong[i]==j){
						ans = getAnswer(answer[j], j);
						userResponse = userAns[j];
						tableString = "<tr><td class='icon'><img src='pics/Xmark.png' alt='Wrong'/></td><td>" + c[j] + " / " + d[j] + "</td><td>"+q[j]+"</td><td><div style='float:right;margin-left:10px;'><a href='javascript:void(0)' title='" + r[j].replace(/\\/g, '') + "'><img src='pics/info.png' border='0' align='absmiddle' /></a></div>"+ans+"</td><td>"+userResponse+"</td><td nowrap='nowrap'><img class='rateImg' src='pics/iconThumbsup.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "+'/> <img class='rateImg' src='pics/iconThumbsdown.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "-'/></td></tr>";
						$('#questionTable').append(tableString);
					}
				}
			}
			checkInWrong = true;
		}
		if(playerCount=="multi") {
			for (var j=0; j<q.length; j++) {
				var tableString;
				var ans;
				var userResponse;
				var checkInWrong = true;
				if (!correctP2Empty){
					for (var i=0; i<correctP2.length; i++){
						if (correctP2[i]==j){
							ans = getAnswer(answerP2[j], j);
							tableString = "<tr><td class='icon'><img src='pics/checkmark.png' alt='Correct'/></td><td>" + c[j] + " / " + d[j] + "</td> <td>"+q[j]+"</td><td><div style='float:right;margin-left:10px;'><a href='javascript:void(0)' title='" + r[j].replace(/\\/g, '')  + "'><img src='pics/info.png' border='0' align='absmiddle' /></a></div>"+ans+"</td><td/><td nowrap='nowrap'><img class='rateImg' src='pics/iconThumbsup.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "+'/> <img class='rateImg' src='pics/iconThumbsdown.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "-'/></td></tr>";	
							$('#questionTable').append(tableString);
							checkInWrong= false;
							break;
						}
					}
				}
				if (!wrongP2Empty && checkInWrong){
					for(var i=0; i<wrongP2.length; i++) {
						if (wrongP2[i]==j){
							ans = getAnswer(answerP2[j], j);
							//alert("Item " + j + " = " + userAnsP2[j+userAns.length] + ", and " + ans);
							userResponse = userAns[j];
							tableString = "<tr><td class='icon'><img src='pics/Xmark.png' alt='Wrong'/></td><td>" + c[j] + " / " + d[j] + "</td><td>"+q[j]+"</td><td><div style='float:right;margin-left:10px;'><a href='javascript:void(0)' title='" + r[j].replace(/\\/g, '')  + "'><img src='pics/info.png' border='0' align='absmiddle' /></a></div>"+ans+"</td><td>" + userAnsP2[j] + "</td><td nowrap='nowrap'><img class='rateImg' src='pics/iconThumbsup.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "+'/> <img class='rateImg' src='pics/iconThumbsdown.png' border='0' align='absmiddle' rel='" + q[j] + "' id='" + j + "-'/></td></tr>";
							$('#questionTable').append(tableString);
						}
					}
				
				checkInWrong = true;
				}
			}
		}
		//format the div containing the table
		$('#questionBox').height($('#questionTable').height()+20);
	}

	function getAnswer(ans, index){
		var fullAnswer;
		switch (ans){
			case '0':
				fullAnswer = w[index];
				break;
			case '1':
				fullAnswer = x[index];
				break;
			case '2':
				fullAnswer = y[index];
				break;
			case '3':
				fullAnswer = z[index];
				break;
			default:
				fullAnswer = "answer missing";
		}
		return fullAnswer;
	}
	
	$("#newGameBut").click(function(){
		location.href="index.php";
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