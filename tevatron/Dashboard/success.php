<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

?>

<!DOCTYPE html>
<html>
	<head>

	<title>Email Sent | Project Tevatron</title>
		<meta charset="UTF-8">
		<meta name="description" content="You need to verify your email!">
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
	<body style="background-image: url('../img/mushroom.jpg'); background-size: cover;">
		<?php
			include '../includes/navbar.php';
		?>
		<div class="container" style="background: transparent;">
			<?php
			if($_COOKIE["user_type"] == 2){ 
				echo '
					<center>
						<h1 class="page-title" style="color: white;margin-top: 225px;">You have succesfully created the class:</h1>
						<h2 style="color: #FFA82D;">' . filter($_COOKIE["class"]); . '</h2>
						<a href="/Dashbaord/teacher.php">
							<h2 style="color: white;width: 400px;">Click here to continue to your dashboard.</h2>
						</a>
					</center>';
				}else if ($_COOKIE["user_type"] == 1) {
					echo '
					<center>
						<h1 class="page-title" style="color: white;margin-top: 225px;">You have succesfully joined the class:</h1>
						<h2 style="color: #FFA82D;"><?php echo filter($_COOKIE["class"]); ?></h2>
						<a href="/Dashbaord/student.php">
							<h2 style="color: white;width: 400px;">Click here to continue to your dashboard.</h2>
						</a>
					</center>';
				}
				?>
		</div>
		<?php
			include '../includes/footer.php';
		?>
	</body>
</html>