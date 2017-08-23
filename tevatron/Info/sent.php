<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" id="index" type="text/css" href="../CSS/index.css">
		<link rel="stylesheet" id="info" type="text/css" href="CSS/info.css">
		<link rel="stylesheet" id="navfoot" type="text/css" href="../CSS/navfoot.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">
			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#index").attr("href", "../CSS/index.css");
			    $("#navfoot").attr("href", "../CSS/navfoot.css");
			    $("#info").attr("href", "CSS/info.css");
			  } else if (width < 1920) {
			    $("#index").attr("href", "../CSS/index-2.css");
			    $("#navfoot").attr("href", "../CSS/navfoot-2.css");
			    $("#info").attr("href", "CSS/info-2.css");
			  } else {
			     $("#index").attr("href", "../CSS/index.css"); 
			     $("#navfoot").attr("href", "../CSS/navfoot.css");
			     $("#info").attr("href", "CSS/info.css");
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
	<body style="background-image: url('../img/signup.jpg'); background-size: cover;">
		<?php
			include '../includes/navbar.php';
		?>
		<div class="container" style="background: transparent;">
			<center>
				<h1 class="page-title" style="color: white;margin-top: 225px;">A verification email has been sent.</h1>
				<h2>Why verify your email?</h2>
				<h2 style="color: white;width: 400px;">We want to make sure that you can retrieve your lost password.</h2r>
			</center>
		</div>
		<?php
			include '../includes/footer.php';
		?>
	</body>
</html>