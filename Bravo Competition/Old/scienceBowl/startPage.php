<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><script type="text/javascript">window.NREUM||(NREUM={}),__nr_require=function(t,n,e){function r(e){if(!n[e]){var o=n[e]={exports:{}};t[e][0].call(o.exports,function(n){var o=t[e][1][n];return r(o?o:n)},o,o.exports)}return n[e].exports}if("function"==typeof __nr_require)return __nr_require;for(var o=0;o<e.length;o++)r(e[o]);return r}({D5DuLP:[function(t,n){function e(t,n){var e=r[t];return e?e.apply(this,n):(o[t]||(o[t]=[]),void o[t].push(n))}var r={},o={};n.exports=e,e.queues=o,e.handlers=r},{}],handle:[function(t,n){n.exports=t("D5DuLP")},{}],G9z0Bl:[function(t,n){function e(){var t=l.info=NREUM.info;if(t&&t.agent&&t.licenseKey&&t.applicationID&&p&&p.body){l.proto="https"===f.split(":")[0]||t.sslForHttp?"https://":"http://",i("mark",["onload",a()]);var n=p.createElement("script");n.src=l.proto+t.agent,p.body.appendChild(n)}}function r(){"complete"===p.readyState&&o()}function o(){i("mark",["domContent",a()])}function a(){return(new Date).getTime()}var i=t("handle"),u=window,p=u.document,s="addEventListener",c="attachEvent",f=(""+location).split("?")[0],l=n.exports={offset:a(),origin:f,features:[]};p[s]?(p[s]("DOMContentLoaded",o,!1),u[s]("load",e,!1)):(p[c]("onreadystatechange",r),u[c]("onload",e)),i("mark",["firstbyte",a()])},{handle:"D5DuLP"}],loader:[function(t,n){n.exports=t("G9z0Bl")},{}]},{},["G9z0Bl"]);</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Science Bowl Quiz Game</title>
<link rel="shortcut icon" href="pics/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="../default.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="mainCode.js"></script>

</head>

<body>
<?php 
 include "../_Layout.php";
 ?>
<div id="content">
<div class="wrapper">

<!--popup for Rules-->
<div id="window">
    <a href="#" id="closePopup">[close]</a>
    <div id="popup_content">
        <div id="sp_rules">
        <h3 style="text-decoration:underline">Rules: </h3>
			<h3>Single-Player Mode</h3>
			<p>The single-player mode allows you to quiz yourself. </p>
			<table>
			<tr>
					<td class="title">Single-Player Controls: </td>
					<td>Use your mouse to select your answer choice, or buzz in with the key that corresponds to your answer choice (W, X, Y, or Z). 
					<p>Then, click on the on-screen buttons to submit your answer and move on to the next question, or hit the the "enter" key on your keyboard to submit a response, and then hit "enter" again to move on to the next question.</td>
			 </tr>
			 </table>
			<table>
			  <tr>
					<td class="title">Choose Game Topics: </td>
					<td>Click on the "Choose Game Topics" text on the main "Play" page to select the subject matter for the round of play. Note that the questions in the OSQ are limited--if you select too few subjects, the round may be cut short. </td>
				</tr>
				<tr>
					<td class="title">Time limit: </td>
					<td>6 minutes per game. The timer starts counting as soon as the next page loads, and does not pause between questions. You can, however, manually pause to take a break.</td>
				</tr>
				<tr>
					<td class="title">Question format: </td>
					<td>Multiple choice.</td>
				</tr>
				<tr>
					<td class="title">Feedback: </td>
					<td><span class="green">Correct answers</span> will be <span class="green">large, green and bold</span>; <span class="red">incorrect answers</span> will be marked <span class="red">red</span>.</td>
				</tr>
				<tr>
					<td class="title">Ending the game: </td>
					<td>The match will end after 6 minutes have passed, or after you've exhausted our question database. You can also end a match at any time by hitting the "End Game" button in the bottom right.  Clicking on one of the tabs or navigating to a new window at the top of the page will also end a match, but you will not receive game statistics.</td>
				</tr>
			</table>
			<br/>
			<table>
				<tr>
					<td class="title">Time limit: </td>
					<td>6 minutes per game. The timer starts counting as soon as the next page loads, and does not pause between questions. </td>
				</tr>
				<tr>
					<td class="title">Question format: </td>
					<td>Multiple choice.</td>
				</tr>
				<tr>
					<td class="title">Ending the game: </td>
					<td>The match will end after 6 minutes have passed, or after you've exhausted our question database. Clicking on one of the tabs or navigating to a new window at the top of the page will end a match, but you will not receive game statistics.</td>
				</tr>
			</table>
			<br/>
        </div>
        <div id="mp_rules">
        </div>
    </div>
</div>

<!--main div-->


<form id="chooseGame" action="sbQuestions.php" method="post">
    <div id="gameplay">
        <h3>&nbsp;&nbsp;Select Gameplay</h3>
        <div class="choiceList" hidden>
            <input type="radio" name="playerNum" value="single" checked="checked"/> Single-player
        </div>
        <input id="toggleOpts" class="button2" type="button" value="Choose Game Topics" />
        <input id="displayRules" class="button2" type="button" value="Display Rules"/>
        <input id="start" class="button" type="submit" value="Start Game" />
        For best results, use Mozilla Firefox, Google Chrome, or Safari.
    </div>

    <div id="rightCol">
        <div class="categories">
            <h4 class="toggleVisible">Question Categories</h4>
            <div class="choiceList">
            <input class="toggleVisible" type="checkbox" name="category[]" value="biology" checked="checked" /> <b>Biology</b>
            <select class="toggleVisible" name="difficulty[]">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Insane">Insane</option>
            </select><br>
            <input class="toggleVisible" type="checkbox" name="category[]" value="chemistry" checked="checked"/> <b>Chemistry</b> 
            <select class="toggleVisible" name="difficulty[]">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Insane">Insane</option>
            </select><br>
            <input class="toggleVisible" type="checkbox" name="category[]" value="geology" checked="checked"/> <b>Earth & Space</b>
            <select class="toggleVisible" name="difficulty[]">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Insane">Insane</option>
            </select><br>
            <input class="toggleVisible" type="checkbox" name="category[]" value="math" checked="checked"/> <b>Math</b> 
            <select class="toggleVisible" name="difficulty[]">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Insane">Insane</option>
            </select><br>
            <input class="toggleVisible" type="checkbox" name="category[]" value="physics" checked="checked"/> <b>Physics</b>
            <select class="toggleVisible" name="difficulty[]">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Insane">Insane</option>
            </select><br>
            <input class="toggleVisible" type="checkbox" name="category[]" value="energy" checked="checked"/> <b>Energy</b>
            <select class="toggleVisible" name="difficulty[]">
                    <option value="Easy">Easy</option>
                    <option value="Medium">Medium</option>
                    <option value="Hard">Hard</option>
                    <option value="Insane">Insane</option>
            </select><br>
          </div>
          <!--<button id="chooseAll" type="button">Select All</button>
          <button id="chooseNone" type="button">Deselect All</button>-->
          <br/><b> Press "Start Game"<br/>
          when done.</b>
          <br/>
        </div>
    </div>    
</form>
<!--end Main div--></div>
<div id="popup"></div>
<!--<div id="footer">For best results, use Mozilla Firefox, Google Chrome, or Safari.</div>-->
<!--end Wrapper div--></div>
    </div>

<script type="text/javascript">window.NREUM||(NREUM={});NREUM.info={"beacon":"beacon-4.newrelic.com","licenseKey":"649679160d","applicationID":"2596276","transactionName":"bgMBZxRXC0VXVEAKVldJNkEPGQxYUlJMTUlRFg==","queueTime":0,"applicationTime":0,"ttGuid":"","agentToken":"","userAttributes":"","errorBeacon":"bam.nr-data.net","agent":"js-agent.newrelic.com\/nr-411.min.js"}</script></body>
</html>
