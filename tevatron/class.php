<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

$sql_user = "website_access";
$sql_pass = "+Hacking1859";
$user = filter($_COOKIE["user"]);
$session = filter($_COOKIE["session"]);
$user_type = filter($_COOKIE["user_type"]);
$logins = filter($_COOKIE["logins"]);

try{

	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM users WHERE username = :username');
	$run->bindParam(':username', $user);
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);
	$session_check = $return[0]["session"];
	$return = 0;
	$run = 0;

} catch(PDOException $e){

	
}


if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if($user_type == 2){

		try{

			do {

				$class_id = mt_rand(1000000000, 9999999999);
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('SELECT * FROM users WHERE class_id = :class_id');
				$run->bindParam(':class_id', $class_id);
				$run->execute();

				$return = $run->fetchALL(PDO::FETCH_ASSOC);


			} while ($return[0]["class_id"] == $class_id);

			$class = filter($_POST["cname"]);
			$hour = filter($_POST["chour"]);
			$code = filter($_post["ccode"]);

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('SELECT * FROM classes WHERE class = :class');
			$run->bindParam(':class', $class)
			$run->execute();

			$return = $run->fetchAll(PDO::FETCH_ASSOC);

			if ($return[0]['class'] == $class){
				#error class name already taken
			} else{


			$run = $dbh->prepare('SELECT * FROM users WHERE session = :session');
			$run->bindParam(":session", $session);
			$run->execute();

			$return = $run->fetchALL(PDO::FETCH_ASSOC);


			if($return[0]['class1'] == NULL) {
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class1 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class2'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class2 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class3'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class3 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class4'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class4 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class5'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class5 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class6'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class6 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class7'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class7 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class8'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class8 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} else{
				//insert error for too many classes
				//also kill it so the code down below dosent run and we dont create ghost classes
			}

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('INSERT INTO classes (class_id, class, hour, code) VALUES (:class_id, :class, :hour, :code)');
			$run->bindParam(':class_id', $class_id);
			$run->bindParam(':class', $class);
			$run->bindParam(':hour', $hour);
			$run->bindParam(':code', $code);
			$run->execute();
		}


		} catch(PDOException $e){
			//insert error here
		}


	} elseif($user_type == 1){

		try{

			$join = filter($_POST ["cjcode"]);

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);

			$run = $dbh->prepare('SELECT * FROM classes WHERE code = :code');
			$run->bindParam(':code', $join);
			$run->execute();

			$return = $run->fetchALL(PDO::FETCH_ASSOC);

			if ($return[0]['code'] != $join){
				#error for incorect code
			}	else {

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('SELECT * FROM classes WHERE code = :code');
			$run->bindParam(':code', $join);
			$run->execute();

			$return = $run->fetchALL(PDO::FETCH_ASSOC);
			$class_id = $return [0]['class_id'];


			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);

			$run = $dbh->prepare('SELECT * FROM users WHERE session = :session');
			$run->bindParam(":session", $session);
			$run->execute();

			$return = $run->fetchALL(PDO::FETCH_ASSOC);


			if($return[0]['class1'] == NULL) {
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class1 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class2'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class2 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class3'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class3 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class4'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class4 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class5'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class5 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class6'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class6 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class7'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class7 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class8'] == NULL){
				$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
				$run = $dbh->prepare('UPDATE users SET class8 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} else{
				//insert error for too many classes
				//also kill it so the code down below dosent run and we dont create ghost classes
			}

			$class_count = $return[0]['count'] + 1;

			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('UPDATE classes SET count = :count WHERE code = :code');
			$run->bindParam(':count', $class_count);
			$run->bindParam(':code', $join);
			$run->execute();




}

		} catch(PDOException $e){
			//insert error here
		}

	} elseif($uer_type == 3){


	}
}


?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" id="index" type="text/css" href="CSS/index.css">
		<link rel="stylesheet" id="login" type="text/css" href="CSS/login.css">
		<link rel="stylesheet" id="inputs" type="text/css" href="CSS/inputs.css">
		<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script type="text/javascript">
			function adjustStyle(width) {
			  width = parseInt(width);
			  if (width < 800) {
			    $("#index").attr("href", "CSS/index.css");
			    $("#inputs").attr("href", "CSS/inputs.css");
			    $("#login").attr("href", "CSS/login.css");
			  } else if (width < 1920) {
			    $("#index").attr("href", "CSS/index-2.css");
			    $("#inputs").attr("href", "CSS/inputs-2.css");
			    $("#login").attr("href", "CSS/login.css");
			  } else {
			     $("#index").attr("href", "CSS/index.css"); 
			     $("#inputs").attr("href", "CSS/inputs.css");
			     $("#login").attr("href", "CSS/login.css");
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
		<div class="container">
			<center>
				<div style="width: 25vw;padding-top: 32vh;max-width: 500px;min-width: 250px;">
					<form name="message" method="post" style="">
						<?php


						if($user_type == 3 and $session == $session_check){
						echo '<h1 class="title">Join a Class</h1>
						<input name="cjcode" id="cjode" type="text" class="single-input" placeholder="Class Code">

						<input type="submit" name="login" action="post" class="btn-primary" value="Join Class">';
						
						echo '<h1 class="title">Create a Class</h1>
						<input name="cname" id="cname" type="text" class="top-input" placeholder="Class Name">
						<input name="chour" id="chour" type="text" class="middle-input" placeholder="Class Hour (Ex: 3)">
						<input name="ccode" id="ccode" type="text" class="bottom-input" placeholder="Class Code">
						<div style="width: 315px;height: auto;margin-top: 20px;">
							<h2 style="margin-left: 0px;float: left;" class="smoltitle">Class subject:</h2>
							<select name="csubject" id="csubject" class="select" style="margin-top: -2px;">
								<option value = "1">Physics</option>
				            </select>
						</div>

						<input type="submit" name="login" action="post" class="btn-primary" value="Create Class" style="margin-top: 0px;">';
						}

						elseif($user_type == 2 and $session == $session_check){

						echo '<h1 class="title">Create a Class</h1>
						<input name="cname" id="cname" type="text" class="top-input" placeholder="Class Name">
						<input name="chour" id="chour" type="text" class="middle-input" placeholder="Class Hour (Ex: 3)">
						<input name="ccode" id="ccode" type="text" class="bottom-input" placeholder="Class Code">
						<div style="width: 315px;height: auto;margin-top: 20px;">
							<h2 style="margin-left: 0px;float: left;" class="smoltitle">Class subject:</h2>
							<select name="csubject" id="csubject" class="select" style="margin-top: -2px;">
								<option value = "1">Physics</option>
				            </select>
						</div>

						<input type="submit" name="login" action="post" class="btn-primary" value="Create Class" style="margin-top: 0px;">';
					} elseif($user_type == 1 and $session == $session_check){
					
						echo '<h1 class="title">Join a Class</h1>
						<input name="cjcode" id="cjcode" type="text" class="single-input" placeholder="Class Code">

						<input type="submit" name="login" action="post" class="btn-primary" value="Join Class">';
					} else{

						echo '<h1>You are not logged in</h1>';


					}
						

						?>
					</form>
					<p class="foot">Having issues?</p>
				</div>
			</center>
		</div>
	</body>
</html>