<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

$sql_user = "tevatron_access";
$sql_pass = "+Hacking1859";


if($_SERVER["REQUEST_METHOD"] == "POST") {
	$new_username = filter($_POST["username"]);
	$new_password = filter($_POST["password"]);
	$new_email = filter($_POST["email"]);
	

		$hash_pass1 = crypt($new_password, 'bkhwevrehj');
		$hash_pass2 = crypt($hash_pass1, 'zknlyxufok');
		$hash_pass_fin = crypt($hash_pass2, 'lamtfinmzg');



	if ($new_username =="" OR $new_password =="" OR $new_email == "") {
		$errorHad = true;
		$error = "Please fill out all forms.";


	} else {

		try{

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('SELECT * FROM users WHERE username = :new_username');
			$run->bindParam(':new_username', $new_username);
			$run->execute();

			$return = $run->fetchALL(PDO::FETCH_ASSOC);

			if ($return[0]["username"] == $new_username) {
				$errorHad = true;
				$error = "That username is currently in use. Please chose a different username.";
			} else {

				do {

				$salty_bitch = mt_rand(1000000000, 9999999999);
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('SELECT * FROM users WHERE salt = :salt');
				$run->bindParam(':salt', $salty_bitch);
				$run->execute();

				$return = $run->fetchALL(PDO::FETCH_ASSOC);


				} while ($return[0]["salt"] == $salty_bitch);

				$spicy = crypt($hash_pass_fin, $salty_bitch);

				do {

					$email_code = mt_rand(1000000000, 9999999999);
					$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
					$run = $dbh->prepare('SELECT * FROM users WHERE email_code = :email_code');
					$run->bindParam(':email_code', $email_code);
					$run->execute();

					$return = $run->fetchALL(PDO::FETCH_ASSOC);


				} while ($return[0]["email_code"] == $email_code);
				
				do {

					$user_id = mt_rand(1000000000000, 9999999999999);
					$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
					$run = $dbh->prepare('SELECT * FROM users WHERE user_id = :user_id');
					$run->bindParam(':user_id', $user_id);
					$run->execute();

					$return = $run->fetchALL(PDO::FETCH_ASSOC);


				} while ($return[0]["user_id"] == $user_id);


				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare("INSERT INTO users (user_id, username, password, email, email_code, salt) VALUES (:user_id, :username, :password, :email, :email_code, :salt)");
				$run->bindParam(':user_id', $user_id);
				$run->bindParam(':username', $new_username);
				$run->bindParam(':password', $spicy);
				$run->bindParam(':email', $new_email);
				$run->bindParam(':email_code', $email_code);
				$run->bindParam(':salt', $salty_bitch);
				$run->execute();
				$run = null;
				$dbh = null;

				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('INSERT INTO assigned (user_id) VALUES (:user_id)');
				$run->bindParam(':user_id', $user_id);
				$run->execute();

				setcookie("username", $new_username);

				header("Location: /moresignup.php");
				die();
		}

		} catch(PDOException $e) {
				$errorHad = true;
				$error = "Seems we could not reach our servers! Please contact an admin. B";
		}



}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" id="index" type="text/css" href="CSS/index.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="CSS/login.css">
		<link rel="stylesheet" id="navfoot" type="text/css" href="CSS/navfoot.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/parallax.min.js"></script>
		<script type="text/javascript">

			if (width < 800) {
			    $("#index").attr("href", "CSS/index.css");
			    $("#inputs").attr("href", "CSS/login.css");
			    $("#navfoot").attr("href", "CSS/navfoot.css");
			  } else if (width < 1920) {
			    $("#index").attr("href", "CSS/index-2.css");
			    $("#inputs").attr("href", "CSS/login-2.css");
			    $("#navfoot").attr("href", "CSS/navfoot-2.css");
			  } else {
			     $("#index").attr("href", "CSS/index.css"); 
			     $("#inputs").attr("href", "CSS/login.css");
			     $("#navfoot").attr("href", "CSS/navfoot.css");
			  }
			}

			$(function() {
			  adjustStyle($(this).width());
			  $(window).resize(function() {
			    adjustStyle($(this).width());
			  });
			});
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	<body style="background-image: url('img/signup.jpg'); background-size: cover;">
		<?php
			include 'includes/navbar.php';
		?>
		<div class="container" style="background: transparent;">
			<center>
				<?php 
					if($errorHad == true) {
						echo '<div class="error-box">';
							echo '<h4>' . $error . '</h4>';
							print $e;
						echo '</div>';
					} 
				?>
				<div style="width: 25vw;padding-top: 32vh;max-width: 500px;min-width: 250px;">
					<h1 class='title'>Sign Up</h1>
					<form name="message" method="post" style="">
						<input type="text" name="username" class="top-input" placeholder="Username">
						<input type="text" name="email" class="middle-input" placeholder="Email">
						<input type="password" name="password" class="bottom-input" placeholder="Password">
						<input type="submit" name="login" action='post' class="btn-primary" value="Sign Up!">
					</form>
					<p class="foot">Having issues?</p>
				</div>
			</center>
		</div>
	</body>
</html>