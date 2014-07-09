<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><script type="text/javascript">window.NREUM||(NREUM={}),__nr_require=function(t,n,e){function r(e){if(!n[e]){var o=n[e]={exports:{}};t[e][0].call(o.exports,function(n){var o=t[e][1][n];return r(o?o:n)},o,o.exports)}return n[e].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<e.length;o++)r(e[o]);return r}({D5DuLP:[function(t,n){function e(t,n){var e=r[t];return e?e.apply(this,n):(o[t]||(o[t]=[]),void o[t].push(n))}var r={},o={};n.exports=e,e.queues=o,e.handlers=r},{}],handle:[function(t,n){n.exports=t("D5DuLP")},{}],G9z0Bl:[function(t,n){function e(){var t=l.info=NREUM.info;if(t&&t.agent&&t.licenseKey&&t.applicationID&&p&&p.body){l.proto="https"===f.split(":")[0]||t.sslForHttp?"https://":"http://",i("mark",["onload",a()]);var n=p.createElement("script");n.src=l.proto+t.agent,p.body.appendChild(n)}}function r(){"complete"===p.readyState&&o()}function o(){i("mark",["domContent",a()])}function a(){return(new Date).getTime()}var i=t("handle"),u=window,p=u.document,s="addEventListener",c="attachEvent",f=(""+location).split("?")[0],l=n.exports={offset:a(),origin:f,features:[]};p[s]?(p[s]("DOMContentLoaded",o,!1),u[s]("load",e,!1)):(p[c]("onreadystatechange",r),u[c]("onload",e)),i("mark",["firstbyte",a()])},{handle:"D5DuLP"}],loader:[function(t,n){n.exports=t("G9z0Bl")},{}]},{},["G9z0Bl"]);</script>
<link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Single-player Game</title>
<link rel="stylesheet" type="text/css" href="../default.css"/>
<link rel="stylesheet" type="text/css" href="single.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="singleCode.js"></script>

</head>

<body>
<?php include "../_Layout.php";?>
<div id="content">
<div class="wrapper">
	
    <h1 id="title">Single Player Game</h1>
    

</div>
<div id="gamespace"><!--new--><div id="column1">

 	<div id="col_top">
        <h4 id="category" style="margin-top:4px;margin-bottom:4px;"> Category:</h4>
        <h4 id="questionType" style="margin-top:4px;margin-bottom:4px;"> Type:</h4>
        <h4 id="questionDifficulty" style="margin-top:4px;margin-bottom:4px;">Difficulty: </h4>
        </div>
        <div id="col_bot">
     	<h3 id="questionHeader" style="margin-top:20px;margin-bottom:4px;">Question: </h3><p id="questionText" style="color:#000;font-size:16px;font-weight:bold;"></p>
        <h3>Choices:</h3>
        <div style="color:#000;font-size:16px;font-weight:bold;">
        <ul id="choices">
       	  <li id='0'> <input type='radio' name='answer' value='0'/></li>
            <li id='1'> <input type='radio' name='answer' value='1'/></li>
            <li id='2'> <input type='radio' name='answer' value='2' /></li>
            <li id='3'> <input type='radio' name='answer' value='3'/></li>
        </ul></div><br/>
        <button type="button" id="submitAnswer" class="submitBut" value="Submit">Enter/Return</button>
        <button type="button" id="nextQuestion" class="submitBut" value="Next Question">Next Question</button>
</div>
<!--End Column1 --> 
</div>
<div id="column2">
	<h3 id="timer">Time 6:00</h3>
    <button type="button" id="pause" class="gameControls">Pause</button>
    <button type="button" id="continue" class="gameControls">Continue</button>
    <button type="button" id="endGame" class="gameControls">End Game</button>
    <br/>
    <h3 class="stats" style="color:black">Stats</h3>
    <h4 id="correct" style="color:black" class="stats">Correct: </h4>
    <h4 id="wrong" style="color:black" class="stats">Wrong: </h4>
    <h4 id="pauseMessage">Game Paused</h4><!--End Column2--></div>

<!--<div id="footer">
	 <button type="button" id="endGame" class="gameControls">End Game</button>
</div>-->

<form action="endGame.php" method="post" name="vars" id="hiddenForm">
    <input type="text" name="catArray" id="catArray" />
    <input type="text" name="ratArray" id="ratArray" />
    <input type="text" name="diffArray" id="diffArray" />
	<input type="text" name="qArray" id="qArray" />
    <input type="text" name="wArray" id="wArray" />
    <input type="text" name="xArray" id="xArray"/>
    <input type="text" name="yArray" id="yArray"/>
    <input type="text" name="zArray" id="zArray"/>
    <input type="text" name="answerArray" id="answerArray"/>
    <input type="text" name="idArray" id="idArray"/>
    <input type="text" name="answeredCorrect" id="answeredCorrect"/>
    <input type="text" name="answeredWrong" id="answeredWrong" />
    <input type="text" name="userAnswers" id="userAnswers" />
    <input type="text" name="timeElapsed" id="timeElapsed" />
    <input type="text" name="aveTimePerQuestion" id="aveTimePerQuestion" />
	<input type="submit" id="submitForm"/>
</form>
</div>
</div>
</main><!--new-->
<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"beacon-4.newrelic.com","licenseKey":"649679160d","applicationID":"2596276","transactionName":"bgMBZxRXC0VXVEAKVldJNkEPGRZfWFBYBklVBxpWFBgVXkY=","queueTime":0,"applicationTime":0,"ttGuid":"","agentToken":"","userAttributes":"","errorBeacon":"bam.nr-data.net","agent":"js-agent.newrelic.com\/nr-411.min.js"}</script></body>
</html>
