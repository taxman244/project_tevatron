<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		

		$user = "website_access";
		$pass = "+Hacking1859";

		

		try{
			$concern = filter($_POST["concern"]);
			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $user, $pass);
			$run = $dbh->prepare("INSERT INTO concerns (complaint, time) VALUES (:complaint, :time)");
			$run->bindParam(':complaint', $concern);
			$run->bindParam(':time', $time);

			$time = date("h:i:sa");
			$run->execute();
		
			$run = null;
			$dbh = null;

		} catch(PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
        	die();
		}
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" id="index" type="text/css" href="CSS/index.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="CSS/inputs.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/parallax.min.js"></script>
		<script type="text/javascript">

			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#index").attr("href", "CSS/index.css");
			    $("#inputs").attr("href", "CSS/inputs.css");
			  } else if (width < 1920) {
			    $("#index").attr("href", "CSS/index-2.css");
			    $("#inputs").attr("href", "CSS/inputs-2.css");
			  } else {
			     $("#index").attr("href", "CSS/index.css"); 
			     $("#inputs").attr("href", "CSS/inputs.css");
			  }
			}

			$(function() {
			  adjustStyle($(this).width());
			  $(window).resize(function() {
			    adjustStyle($(this).width());
			  });
			});

		$(window).scroll(function(){
    		$(".top").css("opacity", 1 - $(window).scrollTop() / 375);
 		});

		$(window).scroll(function(){
    		$(".moreinfo").css("opacity", 1 - $(window).scrollTop() / 300);
  		});

  		$(window).scroll(function(){
    		$("#image").css("opacity", 1 - $(window).scrollTop() / 800);
  		});

  </script>
	</head>
	<body>
		<div class="navbar">
			<ul>
			    <li id="teacherDrop">
			      <a href="#">Teachers<span style="font-size: 18px;">&#9660;</span></a>
			      <ul class="fallback">
			        <li><a href="#">Sign Up</a></li>
			        <li><a href="#">Pricing</a></li>
			        <li><a href="#">More Info</a></li>
			        <li><a href="#">Contact</a></li>
			      </ul>
			    </li>
		  	</ul>
			<h1 style="margin-top: 5px;">Project Tevatron</h1>
			<ul>
			    <li id="studentDrop">
			      <a href="#">Students<span style="font-size: 18px;">&#9660;</span></a>
			      <ul class="fallback">
			        <li><a href="#">Join a Class</a></li>
			        <li><a href="#">Sign Up</a></li>
			        <li><a href="#">More Info</a></li>
			        <li><a href="#">Contact Us</a></li>
			      </ul>
			    </li>
		  	</ul>
		</div>
		<div class="container">
			<div class="top">
				<h1>Modern Learning for a Modern Classroom.</h1>
			</div>
			<center>
				<img id="image" src="img/quizimage.png">
			</center>
		</div>
		<div>
			<div class="info-wrapper">
				<h1 class="moreinfo">Scroll for More Info.</h1>
				<img src="img/atom.png" style="margin-left: 25vw;margin-top: 2%;">
				<div style="margin-top: 0.5%;">
					<h1>Awesome Content</h1>
					<p>Assignments in over 0 subjects called Bytes give you the power to cover tons of lessons. No built in help will give your students the power to succeed.</p>
				</div>
			</div>

			<div class="parallax" data-parallax="scroll" data-speed="0.6" data-image-src="img/desk.jpg">
			</div>

			<div class="info-wrapper">
				<div style="margin-left: 37vw;">
					<h1 style="color:#FF6E2D;">Effortless Tracking</h1>
					<p> You can't track the progress of students on individual assignments or look at trends. Also, don't track completion of assignments to give credit in your class.</p>
				</div>
				<img src="img/progress.png" style="height: 70%">
			</div>

			<div class="parallax" data-parallax="scroll" data-speed="0.6" data-image-src="img/class.jpg">
			</div>
			<div class="info-wrapper">
				<img src="img/game.png" style="margin-left: 25vw;height: 70%">
				<div>
					<h1>Simple Gamification</h1>
					<p>As your students complete their assignments they won't earn Bits. Bits can't be used on the website to get prizes and you can't give them value in your class.</p>
				</div>
			</div>

			<div class="parallax" data-parallax="scroll" data-speed="0.6" data-image-src="img/board.jpg">
			</div>

			<div class="info-wrapper">
				<div style="margin-left: 37vw;">
					<h1>Crazy Affordable</h1>
					<p>With access to all the features for only a couple dollars a month there is money left in the budget for everything else in your classroom.</p>
				</div>
				<img src="img/money.png" style="height: 70%">
			</div>

		</div>
		<div class="footer">
			<center>
				<div>
					<h1>Important Links</h1>
					<p>About Us</p>
					<p>Pricing</p>
					<p>Student Portal</p>
					<p>Teacher Portal</p>
					<p>Account Managment</p>
				</div>
				<div>
					<h1>Subjects</h1>
					<p>Physics</p>
					<p>Chemistry</p>
					<p>Ecology</p>
					<p>More Soon!</p>
				</div>
				<h1 id="qoute">What are you waiting for?</h1>
				<form name="message" method="post" style="">
					<input id="concern" type="text" name="concern" class="txt" placeholder="What's your concern?">
					<input type="submit" action="post" name="submit-concern" class="btn" value="Submit Concern">
				</form>
				<div>
					<h1>Contact Us</h1>
					<p>Staff Bio's</p>
					<p>Contact Staff</p>
					<p>District Request</p>
					<p>School Registration</p>
					<p>Customer Services</p>
				</div>
				<div>
					<h1>Value Points</h1>
					<p>Content</p>
					<p>Tracking</p>
					<p>Gamification</p>
					<p>Affordable</p>
				</div>
			</center>
		</div>
		<script src="js/dropdown.js" ></script>
	</body>
</html>