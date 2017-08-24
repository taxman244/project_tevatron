<!DOCTYPE html>
<html>
	<head>

	<title>Pricing | Project Tevatron</title>
		<meta charset="UTF-8">
		<meta name="description" content="Interested in our server? Here you can find the prices and look for discounts if you are eligable.">
		<meta name="keywords" content="Tevatron,Project Tevatron,Modern Learning, Byte, Bit">
		<meta name="author" content="Priority Coding">

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
	<body>
		<?php
			include '../includes/navbar.php';
		?>
		<div class="container" style="background: white;">
			<center>
				<h1 class="page-title">Let's talk numbers.</h1>
				<div class="price-wrapper" style="background: #FF6E2D;">
					<h1>Teacher</h1>
					<p>1 teacher</p>
					<h2>$30/yr</h2>
				</div>
				<div class="price-wrapper" style="background: #FFA82D;">
					<h1>Department</h1>
					<p>8 to 19 teachers</p>
					<h2>$25/yr</h2>
				</div>
				<div class="price-wrapper" style="background: #2A72B2;">
					<h1>Entire School</h1>
					<p>20 - 149 teachers</p>
					<h2>$20/yr</h2>
				</div>
				<div class="price-wrapper" style="background: #20B87F;">
					<h1>District</h1>
					<p>150+ teachers</p>
					<h2>$15/yr</h2>
				</div>
				<h1 class="subtitle">Is one of these not right for you?</h1>
				<h2>We offer Alpha and Beta tester discounts!</h2>
				<input type="submit" class="button" value="Find Out More">
			</center>
		</div>
		<?php
			include '../includes/footer.php';
		?>
	</body>
</html>