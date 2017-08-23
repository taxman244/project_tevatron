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
	
	if ($session !== $session_check){

		unset($_COOKIE['user']);
		unset($_COOKIE['session']);
		unset($_COOKIE['user_type']);
		unset($_COOKIE['logins']);

		header("Location: http://tevatron.prioritycoding.net/login.php?error");
		die();
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST"){


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
				$run = $dbh->prepare('UPDATE users SET class1 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class2'] == NULL){
				$run = $dbh->prepare('UPDATE users SET class2 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class3'] == NULL){
				$run = $dbh->prepare('UPDATE users SET class3 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class4'] == NULL){
				$run = $dbh->prepare('UPDATE users SET class4 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class5'] == NULL){

				$run = $dbh->prepare('UPDATE users SET class5 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class6'] == NULL){
				$run = $dbh->prepare('UPDATE users SET class6 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class7'] == NULL){
				$run = $dbh->prepare('UPDATE users SET class7 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} elseif ($return[0]['class8'] == NULL){
				$run = $dbh->prepare('UPDATE users SET class8 = :class_id WHERE session = :session');
				$run->bindParam(':class_id', $class_id);
				$run->bindParam(':session', $session);
				$run->execute();

			} else{
				//insert error for too many classes
				//also kill it so the code down below dosent run and we dont create ghost classes
			}
			}

	}



} catch(PDOException $e){	
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
	<link rel="stylesheet" type="text/css" href="dashboard.css">
	<link rel="stylesheet" type="text/css" href="../login.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		var extended = true;
		function toggleMenu() {
			if(extended){
				$('.sidebar-label').css('display', 'none');
				$('.sidebar').css('width', '55px');
				extended = false;
			}else {
				$('.sidebar').css('width', '250px');
				$('.sidebar-label').css('display', 'block');
				extended = true;
			}
			
		}

		function tabBytes() {
			$('#tab-bytes').css('display', 'block');
			$('#tab-classes').css('display', 'none');
			$('#tab-badges').css('display', 'none');
		}
		function tabClasses() {
			$('#tab-classes').css('display', 'block');
			$('#tab-bytes').css('display', 'none');
			$('#tab-badges').css('display', 'none');
		}
		function tabBadges() {
			$('#tab-badges').css('display', 'block');
			$('#tab-bytes').css('display', 'none');
			$('#tab-classes').css('display', 'none');
		}

	</script>
</head>
<body style="background: #F5F5F5;">
	<?php
		$title = 'Student Dashboard';
		include '../includes/usernavbar.php';
	?>
	<div>hello</div>
	<div class="sidebar">
		<div class="sidebar-icon" onclick="toggleMenu()"><img src="../img/menu.png" style="margin-left: 1px;margin-top: 3px;width: 50px;height: 50px;"></div>
		<div class="sidebar-label" onclick="toggleMenu()"><p>Toggle Menu</p></div>
		<div class="sidebar-icon" onclick="tabBytes()"><img src="../img/assignment.png" style="margin-left: 7px;margin-top: 7px;"></div>
		<div class="sidebar-label" onclick="tabBytes()"><p>Assignments</p></div>
		<div class="sidebar-icon" onclick="tabClasses()"><img src="../img/class.png" style="margin-left: 7px;margin-top: 7px;"></div>
		<div class="sidebar-label" onclick="tabClasses()"><p>Classes</p></div>
		<div class="sidebar-icon" onclick="tabBadges()"><img src="../img/badge.png" style="margin-left: 7px;margin-top: 7px;"></div>
		<div class="sidebar-label" onclick="tabBadges()"><p>Badges</p></div>
		<div class="sidebar-icon"><img src="../img/store.png" style="margin-left: 7px;margin-top: 7px;"></div>
		<div class="sidebar-label"><p>Store</p></div>
		<div class="sidebar-icon"><img src="../img/profile.png" style="margin-left: 7px;margin-top: 7px;"></div>
		<div class="sidebar-label"><p>Profile</p></div>
	</div>
	<center>
		<div class="dash">
			<div id="tab-bytes" style="display: none;">
				<div class="widget" style="width: 725px;">
					<center>
						<div class="head"><p>Upcoming Bytes</p></div>
						<div class="body" style="height: 350px;overflow-y: scroll;">
							<?php
								try{



									$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
									$run = $dbh->prepare('SELECT * FROM users WHERE session = :session');
									$run->bindParam(":session", $session);
									$run->execute();

									$return = $run->fetchALL(PDO::FETCH_ASSOC);
									$user_id = $return[0]['user_id'];

									$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
									$run = $dbh->prepare('SELECT * FROM assigned WHERE user_id = :user_id');
									$run->bindParam(":user_id", $user_id);
									$run->execute();

									$return = $run->fetchALL(PDO::FETCH_ASSOC);
									$clean = array_filter($return[0]);
									$count = count($clean);

									for ($i = 1; $i <= $count; $i+5){
										$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
										$run = $dbh->prepare('SELECT * FROM bytes_data WHERE byte_id = :byte_id');
										$run->bindParam(":byte_id", $clean[$i]);
										$run->execute();

										$return = $run->fetchALL(PDO::FETCH_ASSOC);
										$name = $return[0]["name"];

										echo '"<div style="width: 450px;float: left;margin-left: 25px;">
												<p>" . $name . "</p>
											</div>"';

									}

									for ($i = 4; $i <= $count; $i+5){
										
										echo '"<div style="width: 100px;float: left;">
												<p>" . $clean[$i] . "</p>
											</div>"';	

									}

									for ($i = 1; $i <= $count; $i+5){

										echo '"<div style="width: 100px;float: left;">
                            					<a href="http://tevatron.prioritycoding.net/Byte/bytes.php?". $clean[$x] .
                                					"<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Go!</p></a>
                            				</div>"';

									}



								}catch(PDOException $e){	
								}

							?>
					</center>
				</div>
				<div class="widget" style="width: 375px;margin-left: 750px;">
					<center>
						<div class="head" style="background: #FF6E2D;"><p>Grade Progress</p></div>
						<div class="body" style="height: 400px;">
							<h2 style="margin-top: 25px;">Sitewide Grade:</h2>
							<h1 style="margin-top: 20px;">A</h1>
							<h2>Physics:</h2>
							<h1>C</h1>
							<h2>Chemistry:</h2>
							<h1>B</h1>
							<h2>Algebra:</h2>
							<h1>B</h1>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 350px;margin-left: 1150px;">
					<center>
						<div class="head" style="background: #20B87F;"><p>Teacher Notes</p></div>
						<div class="body" style="height: 750px;overflow-y: scroll;">
							<p style="text-align: left;margin-left: 25px;font-family: 'Merriweather Sans';font-size: 23px;">Mr. Venne:</p>
							<p style="width: 300px;">Make sure that you all or working hard to get your Bytes done so you can get your grade up!</p>
							<hr style="width: 250px;margin-top: 30px;margin-bottom: 20px;">
						</div>

					</center>
				</div>
				<div class="widget" style="width: 725px;margin-top: 420px;">
					<center>
						<div class="head" style="background: #47759E;"><p>Finished Bytes</p></div>
						<div class="body" style="height: 330px;overflow-y: scroll;">



							<div style="width: 450px;float: left;margin-left: 25px;">
								<p>Scalars and Vectors</p>
							</div>
							<div style="width: 100px;float: left;">
								<p>7/22/2017</p>
							</div>
							<div style="width: 100px;float: left;">
								<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Go!</p>
							</div>
							<div style="width: 450px;float: left;margin-left: 25px;">
								<p>Newton's Laws</p>
							</div>
							<div style="width: 100px;float: left;">
								<p>7/28/2017</p>
							</div>
							<div style="width: 100px;float: left;">
								<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Go!</p>
							</div>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 375px;margin-left: 750px;margin-top: 475px">
					<center>
						<div class="head" style="background: #20B87F;"><p>Your Bits</p></div>
						<div class="body" style="height: 275px;">
							<h2 style="margin-top: 25px;">Total Bits:</h2>
							<h1 style="margin-top: 20px;">96</h1>
							<h2>Earned This Month:</h2>
							<h1>12</h1>
						</div>
				</div>
			</div>
			<div id="tab-classes" style="display: none;">
				<div class="widget" style="width: 725px;">
					<center>
						<div class="head" style="background: #FF6E2D"><p>Current Classes</p></div>
						<div class="body" style="height: 300px;">
						<div>
							<div style="width: 125px;float: left;margin-left: 25px;">
								<p>Physics</p>
							</div>
							<div style="width: 200px;float: left;">
								<p>Mr. Venne</p>
							</div>
							<div style="width: 125px;float: left;">
								<p>4th Hour</p>
							</div>
							<div style="width: 125px;float: left;">
								<p>2016/17</p>
							</div>
							<div style="width: 75px;float: left;">
								<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Drop</p>
							</div>
						</div>
						</div>
						
					</center>
				</div>
				<div class="widget" style="width: 425px;margin-left: 750px;">
					<center>
						<div class="head" style="background: #47759E;"><p>Join Another Class</p></div>
						<div class="body" style="height: 225px;">
						<p></p>
							<p style="font-size: 22px;margin-top: 5px;">Enter Class Code:</p>
							<form name="message" method="post" style="margin-top: 30px;">
								<input name="cjcode" id="cjcode" type="text" class="single-input" placeholder="Class Code">

								<input type="submit" name="login" action='post' class="btn-primary" value="Join Class">
							</form>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 300px;margin-left: 1200px;">
					<center>
						<div class="head" style="background: #20B87F;"><p>Class Notifications</p></div>
						<div class="body" style="height: 750px;overflow-y: scroll;">
							<p style="text-align: left;margin-left: 25px;font-family: 'Merriweather Sans';font-size: 23px;">Physics:</p>
							<p style="width: 250px;">Class has entered into 2nd Semester, grading has reset.</p>
							<hr style="width: 250px;margin-top: 30px;margin-bottom: 20px;">
						</div>

					</center>
				</div>
				<div class="widget" style="width: 725px;margin-top: 370px;">
					<center>
						<div class="head" style="background: #47759E;"><p>Classmate Rankings</p></div>
						<div class="body" style="height: 380px;overflow-y: scroll;">
							<div style="width: 30px;float: left;margin-left: 25px;">
								<p>1.</p>
							</div>
							<div style="width: 325px;float: left;">
								<p>Roger J</p>
							</div>
							<div style="width: 150px;float: left;">
								<p>145 Bits</p>
							</div>
							<div style="width: 150px;float: left;">
								<p style="text-align: right;">Physics</p>
							</div>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 425px;margin-left: 750px;margin-top:300px">
					<center>
						<div class="head" style="background: #20B87F;"><p>Class Statistics</p></div>
						<div class="body" style="height: 450px;overflow-y: scroll;">
							<p></p>
							<p style="font-size: 28px;margin-top: 5px;">Physics</p>
							<h2 style="margin-top: 15px;font-size: 18px;">Assigned Bytes:</h2>
							<h1 style="margin-top: 10px;font-size: 22px;">24</h1>
							<h2 style="font-size: 18px;">Bytes Completed:</h2>
							<h1 style="font-size: 22px;"">12</h1>
							<h2 style="font-size: 18px;">Questions Answered:</h2>
							<h1 style="font-size: 22px;"">48</h1>
							<p style="font-size: 28px;margin-top: 5px;">Chemistry</p>
							<h2 style="margin-top: 15px;font-size: 18px;">Assigned Bytes:</h2>
							<h1 style="margin-top: 10px;font-size: 22px;">54</h1>
							<h2 style="font-size: 18px;">Bytes Completed:</h2>
							<h1 style="font-size: 22px;"">26</h1>
							<h2 style="font-size: 18px;">Questions Answered:</h2>
							<h1 style="font-size: 22px;"">456</h1>
						</div>
				</div>
			</div>
			<div id="tab-badges">
				<div class="widget" style="width: 800px;margin-left: 100px;">
					<center>
						<div class="head" style="background: #FF6E2D;"><p>Close Badge Progress</p></div>
						<div class="body" style="height: 350px;">
							<p>Badges currently unavailable.</p>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 500px;margin-left: 925px;">
					<center>
						<div class="head" style="background: #20B87F;"><p>All Badges</p></div>
						<div class="body" style="height: 750px;overflow-y: scroll;">
							<p>Badges currently unavailable.</p>
						</div>

					</center>
				</div>
				<div class="widget" style="width: 800px;margin-left: 100px;margin-top:425px">
					<center>
						<div class="head" style="background: #47759E;"><p>Earned Badges</p></div>
						<div class="body" style="height: 325px;overflow-y: scroll;">
							<p>Badges currently unavailable.</p>
						</div>
				</div>
			</div>
		</div>
	</center>
</body>
</html>