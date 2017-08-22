<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}
	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	

	$user = "website_access";
	$pass = "+Hacking1859";

	

	try{
		$concern = filter($_POST["concern"]);
		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $user, $pass);
		$run = $dbh->prepare("INSERT INTO concerns (complaint, time) VALUES (:complaint, :time)");
		$run->bindParam(':complaint', $concern);
		$run->bindParam(':time', $time);

		$time = date("h:i:sa");
		$run->execute();
	
		$run = null;
		$dbh = null;

	} catch(PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
    	die();
	}
}

?>
<div class="footer" style="<?php echo $style;?>">
	<center>
		<div>
			<h1>Important Links</h1>
			<p>About Us</p>
			<p>Pricing</p>
			<p>Student Portal</p>
			<p>Teacher Portal</p>
			<p>Account Managment</p>
		</div>
		<div>
			<h1>Subjects</h1>
			<p>Physics</p>
			<p>Chemistry</p>
			<p>Ecology</p>
			<p>More Soon!</p>
		</div>
		<h1 id="qoute">What are you waiting for?</h1>
		<form name="message" method="post" style="">
			<input id="concern" type="text" name="concern" class="txt" placeholder="What's your concern?">
			<input type="submit" action="post" name="submit-concern" class="btn" value="Submit Concern">
		</form>
		<div>
			<h1>Contact Us</h1>
			<p>Staff Bio's</p>
			<p>Contact Staff</p>
			<p>District Request</p>
			<p>School Registration</p>
			<p>Customer Services</p>
		</div>
		<div>
			<h1>Value Points</h1>
			<p>Content</p>
			<p>Tracking</p>
			<p>Gamification</p>
			<p>Affordable</p>
		</div>
	</center>
</div>
<script src="js/dropdown.js" ></script>