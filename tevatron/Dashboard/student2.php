<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
	<link rel="stylesheet" type="text/css" href="CSS/dashboard-2.css">
	<link rel="stylesheet" type="text/css" href="../CSS/inputs-2.css">
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
	<nav>
		<h2 style="float: left;margin-top: 10px;">Student Dashboard</h2>
	</nav>
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
				<div class="widget" style="width: 500px;">
					<center>
						<div class="head"><p>Upcoming Bytes</p></div>
						<div class="body" style="height: 225px;overflow-y: scroll;">
							<div style="width: 275px;float: left;margin-left: 10px;">
								<p>Scalars and Vectors</p>
							</div>
							<div style="width: 75px;float: left;">
								<p>7/22/2017</p>
							</div>
							<div style="width: 100px;float: left;">
							<a href="http://tevatron.prioritycoding.net/Byte/bytes.php?=">
								<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Go!</p></a>
							</div>
					</center>
				</div>
				<div class="widget" style="width: 300px;margin-left: 525px;">
					<center>
						<div class="head" style="background: #FF6E2D;"><p>Grade Progress</p></div>
						<div class="body" style="height: 300px;">
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
				<div class="widget" style="width: 250px;margin-left: 850px;">
					<center>
						<div class="head" style="background: #20B87F;"><p>Teacher Notes</p></div>
						<div class="body" style="height: 500px;overflow-y: scroll;">
							<p style="text-align: left;margin-left: 25px;font-family: 'Merriweather Sans';font-size: 23px;">Mr. Venne:</p>
							<p style="width: 90%;">Make sure that you all or working hard to get your Bytes done so you can get your grade up!</p>
							<hr style="width: 80%;margin-top: 30px;margin-bottom: 20px;">
						</div>

					</center>
				</div>
				<div class="widget" style="width: 500px;margin-top: 300px;">
					<center>
						<div class="head" style="background: #47759E;"><p>Finished Bytes</p></div>
						<div class="body" style="height: 200px;overflow-y: scroll;">
							<div style="width: 275px;float: left;margin-left: 10px;">
								<p>Scalars and Vectors</p>
							</div>
							<div style="width: 75px;float: left;">
								<p>7/22/2017</p>
							</div>
							<div style="width: 100px;float: left;">
							<a href="http://tevatron.prioritycoding.net/Byte/bytes.php?=">
								<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Go!</p></a>
							</div>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 300px;margin-left: 525px;margin-top: 375px">
					<center>
						<div class="head" style="background: #20B87F;"><p>Your Bits</p></div>
						<div class="body" style="height: 125px;">
							<h2 style="margin-top: 25px;">Total Bits:</h2>
							<h1 style="margin-top: 20px;">96</h1>
							<h2>This Month:</h2>
							<h1>12</h1>
						</div>
				</div>
			</div>
			<div id="tab-classes" style="display: none;">
				<div class="widget" style="width: 500px;">
					<center>
						<div class="head" style="background: #FF6E2D"><p>Current Classes</p></div>
						<div class="body" style="height: 225px;">
						<div>
							<div style="width: 100px;float: left;margin-left: 10px;">
								<p>Physics</p>
							</div>
							<div style="width: 145px;float: left;">
								<p>Mr. Venne</p>
							</div>
							<div style="width: 95px;float: left;">
								<p>4th Hour</p>
							</div>
							<div style="width: 95px;float: left;">
								<p>2016/17</p>
							</div>
							<div style="width: 45px;float: left;">
								<p style="text-align: right;font-weight: bold;color: #0B5AA2;">Drop</p>
							</div>
						</div>
						</div>
						
					</center>
				</div>
				<div class="widget" style="width: 300px;margin-left: 525px;">
					<center>
						<div class="head" style="background: #47759E;"><p>Join Another Class</p></div>
						<div class="body" style="height: 175px;">
						<p></p>
							<p style="font-size: 22px;margin-top: 5px;">Enter Class Code:</p>
							<form name="message" method="post" style="margin-top: 30px;">
								<input name="cjcode" id="cjode" type="text" class="single-input" placeholder="Class Code">

								<input type="submit" name="login" action='post' class="btn-primary" value="Join Class">
							</form>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 250px;margin-left: 850px;">
					<center>
						<div class="head" style="background: #20B87F;"><p>Class Notifications</p></div>
						<div class="body" style="height: 500px;overflow-y: scroll;">
							<p style="text-align: left;margin-left: 25px;font-family: 'Merriweather Sans';font-size: 23px;">Physics:</p>
							<p style="width: 90%">Class has entered into 2nd Semester, grading has reset.</p>
							<hr style="width: 80%;margin-top: 30px;margin-bottom: 20px;">
						</div>

					</center>
				</div>
				<div class="widget" style="width: 500px;margin-top: 300px;">
					<center>
						<div class="head" style="background: #47759E;"><p>Classmate Rankings</p></div>
						<div class="body" style="height: 200px;overflow-y: scroll;">
							<div style="width: 30px;float: left;margin-left: 10px;">
								<p>1.</p>
							</div>
							<div style="width: 200px;float: left;">
								<p>Roger J</p>
							</div>
							<div style="width: 100px;float: left;">
								<p>145 Bits</p>
							</div>
							<div style="width: 100px;float: left;">
								<p style="text-align: right;">Physics</p>
							</div>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 300px;margin-left: 525px;margin-top:250px">
					<center>
						<div class="head" style="background: #20B87F;"><p>Class Statistics</p></div>
						<div class="body" style="height: 250px;overflow-y: scroll;">
							<p></p>
							<p style="font-size: 28px;margin-top: 5px;">Physics</p>
							<h2 style="margin-top: 15px;font-size: 18px;">Assigned Bytes:</h2>
							<h1 style="margin-top: 10px;font-size: 22px;">24</h1>
							<h2 style="font-size: 18px;">Bytes Completed:</h2>
							<h1 style="font-size: 22px;"">12</h1>
							<h2 style="font-size: 18px;">Questions:</h2>
							<h1 style="font-size: 22px;"">48</h1>
							<p style="font-size: 28px;margin-top: 10px;">Chemistry</p>
							<h2 style="margin-top: 15px;font-size: 18px;">Assigned Bytes:</h2>
							<h1 style="margin-top: 10px;font-size: 22px;">54</h1>
							<h2 style="font-size: 18px;">Bytes Completed:</h2>
							<h1 style="font-size: 22px;"">26</h1>
							<h2 style="font-size: 18px;">Questions:</h2>
							<h1 style="font-size: 22px;"">456</h1>
						</div>
				</div>
			</div>
			<div id="tab-badges" style="">
				<div class="widget" style="width: 550px;margin-left: 50px;">
					<center>
						<div class="head" style="background: #FF6E2D;"><p>Close Badge Progress</p></div>
						<div class="body" style="height: 225px;">
							<p>Badges currently unavailable.</p>
						</div>
					</center>
				</div>
				<div class="widget" style="width: 400px;margin-left: 650px;">
					<center>
						<div class="head" style="background: #20B87F;"><p>All Badges</p></div>
						<div class="body" style="height: 500px;overflow-y: scroll;">
							<p>Badges currently unavailable.</p>
						</div>

					</center>
				</div>
				<div class="widget" style="width: 550px;margin-left: 50px;margin-top:300px">
					<center>
						<div class="head" style="background: #47759E;"><p>Earned Badges</p></div>
						<div class="body" style="height: 200px;overflow-y: scroll;">
							<p>Badges currently unavailable.</p>
						</div>
				</div>
			</div>
		</div>
	</center>
</body>
</html>