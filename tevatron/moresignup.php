<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

$username = $_COOKIE["username"];
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$user_type = filter($_POST["accountType"]);
	$first_name = filter($_POST["fname"]);
	$last_name = filter($_POST["lname"]);
	$district = filter($_POST["sdistrict"]);
	$city = filter($_POST["city"]);
	$state = filter($_POST["state"]);

	if ($first_name == "" OR $last_name == "" OR $district == "" OR $city == "" OR $state == "") {
		$errorHad = true;
		$error = "Please fill out all forms!";
	} else {

		$sql_user = "pc_admin";
		$sql_pass = "+Newton11";

		try{

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('UPDATE users SET user_type = :user_type , first_name =  :first_name, last_name =  :last_name, district =  :district, city =  :city, state = :state WHERE username = :username');
			$run->bindParam(':user_type', $user_type);
			$run->bindParam(':first_name', $first_name);
			$run->bindParam(':last_name', $last_name);
			$run->bindParam(':district', $district);
			$run->bindParam(':city', $city);
			$run->bindParam(':state', $state);
			$run->bindParam(':username', $username);
			$run->execute();
			$dbh = null;

			unset($_COOKIE["username"]);

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('SELECT * FROM users WHERE username = :username');
			$run->bindParam(':username', $username);
			$run->execute();
			$return = $run->fetchALL(PDO::FETCH_ASSOC);

			$email_send = $return[0]["email"];
			$email_code = $return[0]["email_code"];

			require 'phpmailer/PHPMailerAutoload.php';

			$mail = new PHPMailer;

			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'projecttevatron@gmail.com';                 // SMTP username
			$mail->Password = '+Thecube11';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->setFrom('projecttevatron@gmail.com', 'DONT REPLY');
			$mail->addAddress($email_send);     // Add a recipient

			//$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Verify Email -- Project Tevatron';
			$mail->Body    = 'Hello '.$first_name.'! Here is your link to verify your email! http://tevatron.prioritycoding.net/login.php?'.$email_code.' Simply follow the link and you will be all set to use Project Tevatron!';


			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}



			header("Location: https://www.youtube.com/watch?v=aT8ix3ZNlLM");
			die();

		} catch(PDOException $e) {
			$errorHad = true;
			$error = "Seems we could not reach our servers! Please contact an admin.";
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" id="index" type="text/css" href="CSS/index.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="CSS/login.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="js/parallax.min.js"></script>
		<script type="text/javascript">

			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#index").attr("href", "CSS/index.css");
			    $("#inputs").attr("href", "CSS/login.css");
			  } else if (width < 1920) {
			    $("#index").attr("href", "CSS/index-2.css");
			    $("#inputs").attr("href", "CSS/login-2.css");
			  } else {
			     $("#index").attr("href", "CSS/index.css"); 
			     $("#inputs").attr("href", "CSS/login.css");
			  }
			}

			$(function() {
			  adjustStyle($(this).width());
			  $(window).resize(function() {
			    adjustStyle($(this).width());
			  });
			});
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
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
						echo '</div>';
					} 
				?>
				<div style="width: 25vw;padding-top: 32vh;max-width: 500px;min-width: 250px;">
					<form name="message" method="post" style="">
						<div style="width: 300px;height: auto;">
							<h1 style="margin-left: 0px;float: left;" class="smoltitle">You are a</h1>
							<select name= "accountType" id="accountType" class="select" >
								<option value = "1">Student</option>
				               	<option value = "2">Teacher</option>
				            </select>
						</div>
					
						<input name="fname" id="fname" type="text"  class="top-input" placeholder="First Name" style="margin-top: 15px;">
						<input name="lname" id="lname" type="text" class="bottom-input" placeholder="Last Name">

						<input name="sdistrict" id="sdistrict" type="text"  class="top-input" placeholder="School District" style="margin-top: 25px;">
						<input name="city" id="city" type="text"  class="middle-input" placeholder="City">
						<input name="state" id="state" type="text" class="bottom-input" placeholder="State">
						<input type="submit" name="login" action='post' class="btn-primary" value="Sign Up!">
					</form>
					<p class="foot">Having issues?</p>
				</div>
			</center>
		</div>
	</body>
</html>