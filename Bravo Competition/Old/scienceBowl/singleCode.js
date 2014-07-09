// JavaScript Document

$(document).ready(function () {
    $('#hiddenForm').hide();

    //Game Timer
    var secs = 1;
    var mins = 6;
    var timeElapsed = -1;
    var timerOn = true;
    var gameOver = false;
    var t;
    var questionCount = 0;
    //Stats
    var correct = 0;
    var wrong = 0;
    var rightIndicator = "CORRECT";
    //Question
    var category = "";
    var question = "";
    var difficulty = "";
    var choices = [];
    var answer;
    var questionID;
    var pastQuestions = [];
    var letters = ["W", "X", "Y", "Z"];
    var ids = ["#0", "#1", "#2", "#3"];

    $('#nextQuestion').attr("disabled", "disabled"); //start with nextQ button off
    $("#continue").attr("disabled", "disabled"); //start with Continue button off

    var catArray = [];
    var typeArray = []
    var qArray = [];
    var ratArray = [];
    var diffArray = [];
    var wArray = []
    var xArray = [];
    var yArray = [];
    var zArray = [];
    var answerArray = [];
    var idArray = [];
    var answeredCorrect = [];
    var answeredWrong = [];
    var userAnswers = [];

    var questionTimes = [];
    var questionStart;

    readAllQuestions();
    writeTimer();

    //TIMER
    function writeTimer() {
        //stop if no time on clock
        if (secs == 0 && mins == 0) {
            //End_Game();
            $("#timer").html("Game Over");
            timerOn = false;
            gameOver = true;
            alert("Round Over: Time up. \nLoading the Game Summary.");
            endGame();
        }
        else {
            timeElapsed++;
            if (secs == 0) {
                mins -= 1;
                secs = 59;
            }
            else {
                secs -= 1;
            }
            secsToWrite = secs;
            if (secs < 10) {
                secsToWrite = "0" + secs;
            }
            $("#timer").html("Time:  " + mins + ":" + secsToWrite);
            t = setTimeout(writeTimer, 1000);
        }
    }

    $('#pauseMessage').css('visibility', 'hidden'); //start with pauseMessage hidden

    $("#pause").click(function () {
        $("#pause").attr("disabled", "disabled");
        $('#pauseMessage').css('visibility', 'visible');
        $("#submitAnswer").attr("disabled", "disabled");
        $("#choices input[name^=answer]:radio").attr('disabled', true);
        $("#continue").removeAttr("disabled");
        pauseTimer();
    });

    $("#continue").click(function () {
        $("#continue").attr("disabled", "disabled");
        $('#pauseMessage').css('visibility', 'hidden');
        $("#pause").removeAttr("disabled");
        $("#submitAnswer").removeAttr("disabled");
        $("#choices input[name^=answer]:radio").attr('disabled', false);
        resumeTimer();
    });

    function pauseTimer() {
        if (timerOn) {
            clearTimeout(t);
            timerOn = false;
        }
    }
    function resumeTimer() {
        if (!timerOn) {
            t = setTimeout(writeTimer, 1000);
            timerOn = true;
        }
    }

    function startQuestion() {
        questionStart = timeElapsed;
    }

    function endQuestion() {
        questionEnd = timeElapsed;
        var timeForThisQuestion = questionEnd - questionStart;
        questionTimes.push(timeForThisQuestion);
    }

    function computeAveTime() {
        //compute average response time
        var averageTime = 0;
        for (var i = 0; i < questionTimes.length; i++) {
            averageTime += questionTimes[i];
        }
        return Math.round(10.0 * averageTime / questionTimes.length) / 10;
    }

    //gets all the matching questions from the DB (up to 100 questions, see php file)
    function readAllQuestions() {
        $.ajax({
            type: "POST",
            url: "sbQuestions.php",
            //dataType:"json",
            success: function (msg) {
                var allQs = msg.split("<QUESTION>"); //split by question
                for (var i = 0; i < allQs.length; i++) {  //split by question item
                    var oneQuestion = allQs[i].split("<QUESTION_ITEM>");
                    catArray[i] = oneQuestion[0];
                    typeArray[i] = oneQuestion[1];
                    diffArray[i] = oneQuestion[2];
                    ratArray[i] = oneQuestion[3];
                    qArray[i] = oneQuestion[4];
                    var choicesSplit = oneQuestion[5].split("<ANSWER>");
                    wArray[i] = choicesSplit[0];
                    xArray[i] = choicesSplit[1];
                    yArray[i] = choicesSplit[2];
                    zArray[i] = choicesSplit[3];
                    answerArray[i] = oneQuestion[6];
                    idArray = oneQuestion[7];

                }
                newQuestion(); // show the first question				
            }
        });
    }

    //gets new Question+choices+answer
    function newQuestion() {
        if (questionCount >= qArray.length) {
            alert("Round Over: There are no more questions available for your categories. \nLoading the Game Summary.");
            endGame();
        }
        category = catArray[questionCount];
        rationale = ratArray[questionCount];
        type = typeArray[questionCount];
        difficulty = diffArray[questionCount];
        question = qArray[questionCount];
        choices[0] = wArray[questionCount];
        choices[1] = xArray[questionCount];
        choices[2] = yArray[questionCount];
        choices[3] = zArray[questionCount];
        answer = answerArray[questionCount];
        questionID = idArray[questionCount];

        questionCount++;
        displayQuestion();
    }


    function displayQuestion() {
        //display category
        document.getElementById("category").innerHTML = "Category: " + category;
        //display question
        $('#questionHeader').html("Question " + questionCount + ":");
        $('#questionDifficulty').html("Difficulty: " + difficulty);
        $('#questionType').html("Type: " + type);
        $('#questionText').html(question);


        //display choices
        var listChoices = "";
        for (var i = 0; i < choices.length; i++) {
            $(ids[i]).html("<input type='radio' name='answer' value='" + i + "'/> " + letters[i] + ": " + choices[i]);
        }
        //start question timer
        startQuestion();
    }

    //upon submit, reads player's response + checks if correct
    $('#submitAnswer').click(function () {
        submitAnswer();
    });

    function submitAnswer() {
        //stop question timer
        endQuestion();

        //check that an answer if selected
        var answered = $("input[name=answer]:checked").length;
        if (answered == 1) {
            answered = $("input[name=answer]:checked");
            answerNum = answered.val().toString();
            userAnswers.push(choices[answerNum]);

            //check if answer is right; do scoring
            switch (answer) {
                case '0':
                    if (answered.val() == "0") {
                        answerCorrect('0');
                    } else {
                        answerWrong(answered.val(), '0');
                    }
                    break;
                case '1':
                    if (answered.val() == "1") {
                        answerCorrect('1');
                    } else {
                        answerWrong(answered.val(), '1');
                    }
                    break;
                case '2':
                    if (answered.val() == "2") {
                        answerCorrect('2');
                    } else {
                        answerWrong(answered.val(), '2');
                    }
                    break;
                case '3':
                    if (answered.val() == "3") {
                        answerCorrect('3');
                    } else {
                        answerWrong(answered.val(), '3');
                    }
                    break;
                default:
                    answerWrong(answered.val(), '');
            }

        } else {
            return false;
        }
    }

    //STATS
    function answerCorrect(userAns) {
        correct += 1;
        $("#correct").html("Correct: " + correct);
        displayAnswer(userAns, rightIndicator);
        answeredCorrect.push(questionCount - 1); /*record correctly answered Q*/
    }

    function answerWrong(userAns, correctAns) {
        wrong += 1;
        $("#wrong").html("Wrong: " + wrong);
        displayAnswer(userAns, correctAns);
        answeredWrong.push(questionCount - 1); /*record incorrectly answered Q*/
    }

    function displayAnswer(userAns, correctAns) {
        //change display
        if (correctAns == rightIndicator) {//answer was right
            $('#' + userAns).addClass("correct");
        }
        else { //answer was wrong
            $('#' + userAns).addClass("incorrect");
            $('#' + correctAns).addClass("correct");
        }

        //disable submit, enable next Question
        $('#submitAnswer').attr("disabled", "disabled");
        $('#nextQuestion').removeAttr("disabled");

    }

    $('#nextQuestion').click(function () {
        showNextQuestion();
    });

    function showNextQuestion() {
        newQuestion();
        $('#nextQuestion').attr("disabled", "disabled"); //disable self

        $('#submitAnswer').removeAttr("disabled"); //enable submit button, remove color
        for (id in ids) {
            $(ids[id]).removeClass("correct");
            $(ids[id]).removeClass("incorrect");
        }
    }


    $("#endGame").click(function () {
        endGame();
    });


    function endGame() {
        //convert arrays to comma-delimited strings
        var c = catArray.join('XITEMX');
        var r = ratArray.join('XITEMX');
        var d = diffArray.join('XITEMX');
        var q = qArray.join('XITEMX');
        var w = wArray.join('XITEMX');
        var x = xArray.join('XITEMX');
        var y = yArray.join('XITEMX');
        var z = zArray.join('XITEMX');
        var answer = answerArray.join('XITEMX');
        var correct = answeredCorrect.join('XITEMX');
        var wrong = answeredWrong.join('XITEMX');
        var userAns = userAnswers.join('XITEMX');

        var averageTime = computeAveTime();

        //put array data into form
        $('#catArray').val(c);
        $('#ratArray').val(r);
        $('#diffArray').val(d);
        $('#qArray').val(q);
        $('#wArray').val(w);
        $('#xArray').val(x);
        $('#yArray').val(y);
        $('#zArray').val(z);
        $('#answerArray').val(answer);
        $('#answeredCorrect').val(correct);
        $('#answeredWrong').val(wrong);
        $('#userAnswers').val(userAns);
        $('#timeElapsed').val(timeElapsed);
        $('#aveTimePerQuestion').val(averageTime);

        //submit form
        $('#submitForm').click();

    }

    //allows using enter button to submit and move on
    $(document).keyup(function (e) {
        if (e.keyCode == 13) {
            if ($('#nextQuestion').attr("disabled") == true) {
                submitAnswer();
            }
            else {
                showNextQuestion();
            }
        } else if (e.keyCode == 87) {
            $('input[value="0"]').attr('checked', 'checked');
        } else if (e.keyCode == 88) {
            $('input[value="1"]').attr('checked', 'checked');
        } else if (e.keyCode == 89) {
            $('input[value="2"]').attr('checked', 'checked');
        } else if (e.keyCode == 90) {
            $('input[value="3"]').attr('checked', 'checked');
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