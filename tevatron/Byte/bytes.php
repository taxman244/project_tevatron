<?php
function filter($string) {

  htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

$sql_user = "tevatron_access";
$sql_pass = "+Hacking1859";

$user = filter($_COOKIE["user"]);
$user_type = filter($_COOKIE["user_type"]);

$byte_id = $_SERVER['QUERY_STRING'];
try{
  $dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
  $run = $dbh->prepare('SELECT * FROM bytes WHERE byte_id = :byte_id');
  $run->bindParam(':byte_id', $byte_id);
  $run->execute();

  $return = $run->fetchALL(PDO::FETCH_ASSOC);


  $quesions = array();
  $answers = array();
  $why = array();
  $type = array();

  foreach($return as $row){
  array_push($quesions, $row['question']);
  array_push($answers, $row['answer_cor'], $row['answer_1'], $row['answer_2'], $row['answer_3']);
  array_push($why, $row['why_1'], $row['why_2'], $row['why_3'], $row['why_4']);
  array_push($type, $row['question_type']);

  }
}catch(PDOException $e){
  $errorHad = true;
  $error = "Seems we could not reach our servers! Please contact an admin.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$score = $_POST["score"];
	$byte_id2 = $_POST["id"];

	try{


		$sql_user = "tevatron_access";
		$sql_pass = "+Hacking1859";

		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('SELECT * FROM users WHERE session = :session');
		$run->bindParam(':session', $_COOKIE["session"]);
		$run->execute();

		$return = $run->fetchALL(PDO::FETCH_ASSOC);
		$user_id = $return[0]['user_id'];
		$byte_id3 = $byte_id2 . '_score';

		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('UPDATE scores SET ' . $byte_id3 . ' = ' . $score . ' WHERE user_id = ' . $user_id);
		
		$run->execute();


	}catch(PDOException $e){
  	 $errorHad = true;
 	 $error = "Seems we could not reach our servers! Please contact an admin.";
 	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" id="byte" type="text/css" href="CSS/byte.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="CSS/inputs.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">
			
			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#byte").attr("href", "CSS/byte.css");
			    $("#inputs").attr("href", "CSS/inputs.css");
			  } else if (width < 1920) {
			    $("#byte").attr("href", "CSS/byte-2.css");
			    $("#inputs").attr("href", "CSS/inputs-2.css");
			  } else {
			     $("#byte").attr("href", "CSS/byte.css"); 
			     $("#inputs").attr("href", "CSS/inputs.css");
			  }
			}

			$(function() {
			  adjustStyle($(this).width());
			  $(window).resize(function() {
			    adjustStyle($(this).width());
			  });
			});
      
      var number = 0;

      var questions = 
        <?php 
        echo json_encode($quesions);
        ?>
      ;

      var correctAnswer = [0,0,0,0,0,0,0,0,0,0];

      var answers = 
        <?php
        echo json_encode($answers);
        ?>
      ;

      var why =
        <?php
        echo json_encode($why);
        ?>
      ;

      var questionType = <?php
        echo json_encode($type, JSON_NUMERIC_CHECK);
        ?>;

      var amount = 10-1;

      var byteId = <?php echo $byte_id; ?>;

      var answerConfiguration = [];
      var questionConfiguration = [];
      var questionAnswered = true;
      var correct = 0;
      var incorrect = 0;

      function createAnswerConfiguration() {
				var configuration = Math.floor(Math.random() * 7);
				var output = [];

				switch (configuration) {
					case 0:
						output = [0,1,2,3];
						break;
					case 1:
						output = [1,2,3,0];
						break;
					case 2:
						output = [2,3,0,1];
						break;
					case 3:
						output = [3,0,1,2];
						break;
					case 4:
						output = [3,2,1,0];
						break;
					case 5:
						output = [2,1,0,3];
						break;
					case 6:
						output = [1,0,3,2];
						break;
					case 7:
						output = [0,3,2,1];
						break;
				}
				
				return output;

			}

			function createQuestionConfiguration() {
				var configuration = Math.floor(Math.random() * 10);
				var output = [];

				switch (configuration) {
					case 0:
						output = [0,1,2,3,4,5,6,7,8,9,10];
						break;
					case 1:
						output = [7,5,3,1,9,8,0,2,6,4,10];
						break;
					case 2:
						output = [2,5,8,1,4,7,3,6,9,0,10];
						break;
					case 3:
						output = [6,5,4,9,8,7,3,2,1,0,10];
						break;
					case 4:
						output = [0,2,4,6,8,1,3,5,7,9,10];
						break;
					case 5:
						output = [4,8,6,2,7,9,1,3,5,0,10];
						break;
					case 6:
						output = [8,5,2,0,1,3,4,6,7,9,10];
						break;
					case 7:
						output = [7,8,4,5,1,2,9,3,0,6,10];
						break;
					case 8:
						output = [9,8,7,6,5,4,3,2,1,0,10];
						break;
					case 9:
						output = [0,9,1,8,2,7,3,6,4,5,10];
						break;
				}
				return output;
			}

			function checkAnswer(buttonClicked, index) {
				if(questionAnswered === false) {
					if (correctAnswer[questionConfiguration[index]] === answerConfiguration[buttonClicked]) {
						if(buttonClicked === 0) {
							$('#answer1Div').css('background-color', '#2AD022');
							$('#answer1Div').css('box-shadow', '0px 6px 0px #0BB802');
							$('#answer1Div').css('border','solid 2px rgba(116,228,110,0.8)');
						}
						if(buttonClicked === 1) {
							$('#answer2Div').css('background-color', '#2AD022');
							$('#answer2Div').css('box-shadow', '0px 6px 0px #0BB802');
							$('#answer2Div').css('border','solid 2px rgba(116,228,110,0.8)');
						}
						if(buttonClicked === 2) {
							$('#answer3Div').css('background-color', '#2AD022');
							$('#answer3Div').css('box-shadow', '0px 6px 0px #0BB802');
							$('#answer3Div').css('border','solid 2px rgba(116,228,110,0.8)');
						}
						if(buttonClicked === 3) {
							$('#answer4Div').css('background-color', '#2AD022');
							$('#answer4Div').css('box-shadow', '0px 6px 0px #0BB802');
							$('#answer4Div').css('border','solid 2px rgba(116,228,110,0.8)');
						}
						correct++;
						console.log('Correct Answer!');
						questionAnswered = true;
					} else {
						if(buttonClicked === 0) {
							$('#answer1Div').css('background-color', '#FD5055');
							$('#answer1Div').css('box-shadow', '0px 6px 0px #FD292E');
							$('#answer1Div').css('border','solid 2px rgba(254,122,126,0.8)');
						}
						if(buttonClicked === 1) {
							$('#answer2Div').css('background-color', '#FD5055');
							$('#answer2Div').css('box-shadow', '0px 6px 0px #FD292E');
							$('#answer2Div').css('border','solid 2px rgba(254,122,126,0.8)');
						}
						if(buttonClicked === 2) {
							$('#answer3Div').css('background-color', '#FD5055');
							$('#answer3Div').css('box-shadow', '0px 6px 0px #FD292E');
							$('#answer3Div').css('border','solid 2px rgba(254,122,126,0.8)');
						}
						if(buttonClicked === 3) {
							$('#answer4Div').css('background-color', '#FD5055');
							$('#answer4Div').css('box-shadow', '0px 6px 0px #FD292E');
							$('#answer4Div').css('border','solid 2px rgba(254,122,126,0.8)');
						}
						incorrect++;
						console.log('Incorrect Answer!');
						questionAnswered = true;
					}
					var add = questionConfiguration[number] * 4;

					if(buttonClicked === 0) {
						$('#why1').text(why[answerConfiguration[0]+add]);
						$('#why1').css('display', 'block');
					}
					if(buttonClicked === 1) {
						$('#why2').text(why[answerConfiguration[1]+add]);
						$('#why2').css('display', 'block');
					}
					if(buttonClicked === 2) {
						$('#why3').text(why[answerConfiguration[2]+add]);
						$('#why3').css('display', 'block');
					}
					if(buttonClicked === 3) {
						$('#why4').text(why[answerConfiguration[3]+add]);
						$('#why4').css('display', 'block');
					}
				} else {
					alert('You already answered the question!');
				}
			}

			function populateForm(index) {
				if(questionAnswered === true){

					$('#why1').css('display','none');
					$('#why2').css('display','none');
					$('#why3').css('display','none');
					$('#why4').css('display','none');
					$('#question').text(questions[index]);

					if (questionType[questionConfiguration[number]] === 0) {
						answerConfiguration = createAnswerConfiguration();
						questionAnswered = false;
						var add = index * 4;
						$('#check').css('display','none');
						$('.reason-wrapper').css('display', 'block');
						$('.single-input').css('display','none');
						$('#answer1Div').css('display','block');
						$('#answer2Div').css('display','block');
						$('#answer3Div').css('display','block');
						$('#answer4Div').css('display','block');
						$('#answer1').text(answers[answerConfiguration[0]+add]);
						$('#answer2').text(answers[answerConfiguration[1]+add]);
						$('#answer3').text(answers[answerConfiguration[2]+add]);
						$('#answer4').text(answers[answerConfiguration[3]+add]);
						$('.next').css('margin-top', '30px');
						$('.next').css('margin-left', '18vw');
					} else if(questionType[questionConfiguration[number]] === 1) {
						questionAnswered = false;
						$('.reason-wrapper').css('display', 'none');
						$('#check').css('display','block');
						$('.single-input').css('display','block');
						$('#answer1Div').css('display','none');
						$('#answer2Div').css('display','none');
						$('#answer3Div').css('display','none');
						$('#answer4Div').css('display','none');
						$('.next').css('margin-top', '150px');
						$('.next').css('margin-left', '0px');
					}
				} else {
					alert('Please answer the question!');
				}
			}
				
			function getAnswer(buttonClicked) {
				checkAnswer(buttonClicked, number);
			}

			function checkInputAnswer() {
				var userValue = $('#inputValue').val();
				if (userValue == correctAnswer[questionConfiguration[number]]) {
					$('.check').css('background-color', '#2AD022');
					$('.check').css('box-shadow', '0px 6px 0px #0BB802');
					$('.check').css('border','solid 2px rgba(116,228,110,0.8)');
					correct++;
				} else {
					$('.check').css('background-color', '#FD5055');
					$('.check').css('box-shadow', '0px 6px 0px #FD292E');
					$('.check').css('border','solid 2px rgba(254,122,126,0.8)');
					incorrect--;
				}
				questionAnswered = true;
			}

			function getResults() {
				return (correct/(incorrect+correct))*100;
			}

			function displayResults() {
				var percentage = getResults();
				$('.answer').css('display','none');
				$('.reason-wrapper').css('display','none');
				$('.next').css('display', 'none');
				$('#question').css('margin-top','30vh');
				$('#question').text('You scored a ' + percentage + '%!');
				$('.yellow').css('display', 'block');
				$('#score').val(percentage);
				$('#id').val(byteId);
				$('#message').submit();
			}

			function nextQuestion() {
				if (number === amount) {
					displayResults();
				}else {
					number++;
					$('#answer1Div').css('background-color', '#20B87F');
					$('#answer1Div').css('box-shadow', '0px 6px 0px #00A969');
					$('#answer1Div').css('border','solid 2px rgba(65,198,148,0.8)');
					$('#answer2Div').css('background-color', '#20B87F');
					$('#answer2Div').css('box-shadow', '0px 6px 0px #00A969');
					$('#answer2Div').css('border','solid 2px rgba(65,198,148,0.8)');
					$('#answer3Div').css('background-color', '#20B87F');
					$('#answer3Div').css('box-shadow', '0px 6px 0px #00A969');
					$('#answer3Div').css('border','solid 2px rgba(65,198,148,0.8)');
					$('#answer4Div').css('background-color', '#20B87F');
					$('#answer4Div').css('box-shadow', '0px 6px 0px #00A969');
					$('#answer4Div').css('border','solid 2px rgba(65,198,148,0.8)');
					populateForm(questionConfiguration[number]);
				}
			}

			function startByte() {
				questionConfiguration = createQuestionConfiguration();
				$('.reason-wrapper').css('display','block');
				$('.answer').css('display','block');
				$('.next').css('display', 'block');
				$('.start').css('display', 'none');
				$('#question').css('margin-top','0px');
				populateForm(questionConfiguration[number]);
			}

		</script>
	</head>
	<body>
		<nav>
			<h2 style="float: left;margin-top: 10px;">< Linear Physics</h2>
			<ul>
			    <li id="dropDown">
			      <a href="#">Student123 <span style="font-size: 18px;">&#9660;</span></a>
			      <ul class="fallback" style="margin-left: 5px;">
			        <li><a href="#">Assignments</a></li>
			        <li><a href="#">Classes</a></li>
			        <li><a href="#">Restart Byte</a></li>
			        <li><a href="#">Account</a></li>
			        <li><a href="#">Logout</a></li>
			      </ul>
			    </li>
		  	</ul>
		</nav>
		<div class="container">
			<div style="width: 100vw;height: 50px;"></div>
			<center>
				<h1 id="question" style="margin-top: 30vh;">Scalars and Vectors 1</h1>
					<div class="reason-wrapper">
						<h2 id='why1'>Velocity has both a magnitude and direction!</h2>
					</div>

				<div class="answer" id="answer1Div" onclick="getAnswer(0)"><h2 id="answer1"></h2></div>

					<div class="reason-wrapper">
						<h2 id='why2'>Velocity has both a magnitude and direction!</h2>
					</div>

				<div class="answer" id="answer2Div" onclick="getAnswer(1)"><h2 id="answer2"></h2></div>

					<div class="reason-wrapper">
						<h2 id='why3'>Velocity has both a magnitude and direction!</h2>
					</div>

				<div class="answer" id="answer3Div" onclick="getAnswer(2)"><h2 id="answer3"></h2></div>

					<div class="reason-wrapper">
						<h2 id='why4'>Velocity has both a magnitude and direction!</h2>
					</div>

				<div class="answer" id="answer4Div" onclick="getAnswer(3)"><h2 id="answer4"></h2></div>

				<div style="width: 650px;">
					<input type="text" id="inputValue" class="single-input" placeholder="Answer Here" style="float: left;width: 400px;margin-top: 5px;padding-top: 20px;padding-bottom: 20px;margin-left: 25px;display: none;">
					<div class="check" id="check" onclick="checkInputAnswer()" style=""><h2>Check</h2></div>
				</div>
				
				<div class="next" onclick="nextQuestion()"><h2>Next Question</h2></div>
				<div class="start" onclick="startByte()"><h2>Start Byte</h2></div>
				<div class="yellow" onclick=""><h2>View Analysis</h2></div>
			</center>
		</div>
		<form name="message" method="post" id="message" style="display: none;">
			<input type="text" name="score" id="score">
			<input type="text" name="id" id="id">
		</form>
		<script src="../js/dropdown.js"></script>
	</body>
</html>