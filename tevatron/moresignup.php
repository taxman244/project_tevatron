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
		<link rel="stylesheet" type="text/css" href="index.css">
		<link rel="stylesheet" type="text/css" href="login.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	</head>
	<body style="background-image: url('img/signup.jpg'); background-size: cover;">
		<div class="navbar">
			<ul>
			    <li style="margin-left: 15vw;margin-top: -10px;">
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
			    <li style="margin-left: 75vw;margin-top: -100px;">
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