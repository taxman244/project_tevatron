<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

$sql_user = "tevatron_access";
$sql_pass = "+Hacking1859";

$email_code = $_SERVER['QUERY_STRING'];

if ($email_code == ""){

} elseif ($email_code == "error") {
	$errorHad = true;
	$error = "You are not logged in!";
} elseif ($email_code != "error"){

	$errorHad = true;
	$error = "Email has been varified.";

	try{

		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('UPDATE users SET verified = 1 WHERE email_code = :email_code');
		$run->bindParam(':email_code', $email_code);
		$run->execute();
		$dbh = null;

	} catch(PDOException $e) {
		$errorHad = true;
		$error = "Seems we could not reach our servers! Please contact an admin.";
	}
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = filter($_POST["username"]);
	$password = filter($_POST["password"]);

		$hash_pass1 = crypt($password, 'bkhwevrehj');
		$hash_pass2 = crypt($hash_pass1, 'zknlyxufok');
		$hash_pass_fin = crypt($hash_pass2, 'lamtfinmzg');
	
	try{

		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('SELECT * FROM users WHERE username = :username');
		$run->bindParam(':username', $username);
		$run->execute();

		$return = $run->fetchALL(PDO::FETCH_ASSOC);

		$crave = $return[0]["salt"];
	
		$spicy = crypt($hash_pass_fin, $crave);

	if ($password == "" OR $username == "") {
		$errorHad = true;
		$error = "Please fill out all forms.";
	}

	$sql_user = "website_access";
	$sql_pass = "+Hacking1859";



		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('SELECT * FROM users WHERE username = :username');
		$run->bindParam(':username', $username);
		$run->execute();

		$return = $run->fetchALL(PDO::FETCH_ASSOC);

		if($return[0]["username"]=="") {
			$errorHad = true;
			$error = "Account not found!";
		}else {
			if($return[0]["password"]== $spicy) {

				if($return[0]["verified"] == 1){

						do {

								$session = mt_rand(1000000000, 9999999999);
								$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
								$run = $dbh->prepare('SELECT * FROM users WHERE session = :session');
								$run->bindParam(':session', $session);
								$run->execute();

								$return = $run->fetchALL(PDO::FETCH_ASSOC);


						} while ($return[0]["session"] == $session);

					$run = $dbh->prepare('UPDATE users SET session = :session WHERE username = :username');
					$run->bindParam(':session', $session);
					$run->bindParam(':username', $username);
					$run->execute();

					
					$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
					$run = $dbh->prepare('SELECT * FROM users WHERE username = :username');
					$run->bindParam(':username', $username);
					$run->execute();

					$return = $run->fetchALL(PDO::FETCH_ASSOC);

					setcookie('user', $username);
					setcookie('session', $session);
					setcookie('user_type', $return[0]["user_type"]);

					$user_type = $return[0]["user_type"];

					$logins = $return[0]["logins"] + 1;
					$last_log = date("y/m/d h:i:sa");

					$run = $dbh->prepare('UPDATE users SET logins = :logins, last_log = :last_log WHERE username = :username');
					$run->bindParam(':logins', $logins);
					$run->bindParam(':last_log', $last_log);
					$run->bindParam(':username', $username);
					$run->execute();

					setcookie('logins', $logins);

					if ($logins < 2){
						header("Location: /class.php");
					die();
					} elseif ($user_type = 1) {
						header("Location: /Dashboard/student.php");
					die();
					} elseif ($user_type = 2) {
						header("Location: /Dashboard/teacher.php");
					die();
					}


					
				}else{
					$errorHad = true;
					$error = "Account not verified!";

				}

			}else{
				$errorHad = true;
				$error = "Incorrect Password";	
			}
		}

	} catch(PDOException $e) {
		$errorHad = true;
			$error = "Seems we could not reach our servers! Please contact an admin.";


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

			function adjustStyle(width) {
			  width = parseInt(width);
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
	<body style="background-image: url('img/background.jpg'); background-size: cover;">
		<?php
			include 'includes/navbar.php';
		?>
		<div class="container" style="background: transparent;">
			<center>
			<?php 
				if($errorHad == true) {
					echo '<div class="error-box">';
						echo '<h4>' . $error . '</h4>';
					echo '</div>';
				} 
			?>
				<div style="width: 25vw;padding-top: 32vh;max-width: 500px;min-width: 250px;">
					<h1 class='title'>Login</h1>
					<form name="message" method="post" style="">
						<input type="text" name="username" class="top-input" placeholder="Username">
						<input type="password" name="password" class="bottom-input" placeholder="Password">
						<input type="submit" name="login" action='post' class="btn-primary" value="Login">
					</form>
					<p class="foot">Having issues?</p>
				</div>
			</center>
		</div>
	</body>
</html>