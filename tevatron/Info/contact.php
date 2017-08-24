<!DOCTYPE html>
<html>
	<head>

		<title>Contact Us | Project Tevatron</title>
		<meta charset="UTF-8">
		<meta name="description" content="Have a complaint or concern with us that you would like to adress, post it here.">
		<meta name="keywords" content="Tevatron,Project Tevatron,Modern Learning, Byte, Bit">
		<meta name="author" content="Priority Coding">

		<link rel="stylesheet" id="navfoot" type="text/css" href="../CSS/navfoot.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="../CSS/inputs.css">
		<link rel="stylesheet" id="login" type="text/css" href="../CSS/login.css">
		<link rel="stylesheet" id="info" type="text/css" href="CSS/info.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">

			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#navfoot").attr("href", "../CSS/navfoot.css");
			    $("#inputs").attr("href", "../CSS/inputs.css");
			    $("#login").attr("href", "../CSS/login.css");
			  } else if (width < 1920) {
			    $("#navfoot").attr("href", "../CSS/navfoot-2.css");
			    $("#inputs").attr("href", "../CSS/inputs-2.css");
			    $("#login").attr("href", "../CSS/login.css");
			  } else {
			     $("#navfoot").attr("href", "../CSS/navfoot.css"); 
			     $("#inputs").attr("href", "../CSS/inputs.css");
			     $("#login").attr("href", "../CSS/login.css");
			  }
			}

			$(function() {
			  adjustStyle($(this).width());
			  $(window).resize(function() {
			    adjustStyle($(this).width());
			  });
			});
		</script>
	</head>
	<body style="background-image: url('../img/waterfall.jpg'); background-size: cover;overflow-x: hidden;">
		<?php
			include '../includes/navbar.php'
		?>
		<div class="container" style="background: transparent;height: 94vh;">
			<center>
			<?php 
				if($errorHad == true) {
					echo '<div class="error-box">';
						echo '<h4>' . $error . '</h4>';
					echo '</div>';
				} 
			?>
				<div style="width: 25vw;padding-top: 25vh;max-width: 500px;min-width: 250px;">
					<h1 class='title'>Contact Us</h1>
					<form name="message" method="post" style="">
						<input type="text" name="name" class="top-input" placeholder="Name">
						<input type="phone" name="phone" class="middle-input" placeholder="Phone">
						<input type="email" name="email" class="bottom-input" placeholder="Email">
						<textarea rows="6" class="single-input" style="margin-top: 10px;width: 80%;height: 50px;" placeholder="Give a description of your need."></textarea>
						<input type="submit" name="login" action='post' class="btn-primary" value="Submit">
					</form>
					<p class="foot">Having issues?</p>
				</div>
			</center>
		</div>
		<?php
			$style = 'margin-top: 15px;';
			include '../includes/footer.php'
		?>
	</body>
</html>