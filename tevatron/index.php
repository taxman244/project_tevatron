<!DOCTYPE html>
<html>
	<head>
		<title>Project Tevatron | Home</title>
		<meta charset="UTF-8">
		<meta name="description" content="Modern learning for a modern classroom, through exicting methods for you students.">
		<meta name="keywords" content="Tevatron,Project Tevatron,Modern Learning, Byte, Bit">
		<meta name="author" content="Priority Coding">
		
		<link rel="stylesheet" id="index" type="text/css" href="CSS/index.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="CSS/inputs.css">
		<link rel="stylesheet" id="navfoot" type="text/css" href="CSS/navfoot.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/parallax.min.js"></script>
		<script type="text/javascript">

			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#index").attr("href", "CSS/index.css");
			    $("#inputs").attr("href", "CSS/inputs.css");
			    $("#navfoot").attr("href", "CSS/navfoot.css");
			  } else if (width < 1920) {
			    $("#index").attr("href", "CSS/index-2.css");
			    $("#inputs").attr("href", "CSS/inputs-2.css");
			    $("#navfoot").attr("href", "CSS/navfoot-2.css");
			  } else {
			     $("#index").attr("href", "CSS/index.css"); 
			     $("#inputs").attr("href", "CSS/inputs.css");
			     $("#navfoot").attr("href", "CSS/navfoot.css");
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
		<?php
			include 'includes/navbar.php';
		?>
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
		<?php
			include 'includes/footer.php';
		?>
	</body>
</html>