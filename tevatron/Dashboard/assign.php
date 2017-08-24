<?php

function filter($string) {

  return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

}

$sql_user = "tevatron_access";
$sql_pass = "+Hacking1859";
$user = filter($_COOKIE["user"]);
$session = filter($_COOKIE["session"]);
$user_type = filter($_COOKIE["user_type"]);

$byte_id = filter($_SERVER['QUERY_STRING']);
try{
	
	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM subjects');
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);

	$subjects = array();

	foreach($return as $row){
	array_push($subjects, $row['sub_name']);

	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM topics');
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);

	$topics = array();

	foreach ($return as $row) {
	array_push($topics, $row['topic_name']);
	array_push($topics, $row['subject_id']);	
	}

	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM bytes_data');
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);

	$bytes = array();

	foreach ($return as $row) {
	array_push($bytes, $row['name']);
	array_push($bytes, $row['topic_id']);
	}
	
	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM bytes_data');
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);

	$previews = array();

	foreach ($return as $row) {
	array_push($previews, $row['byte_id']);
	array_push($previews, $row['byte_des']);
	}



	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM users WHERE username = :username');
	$run->bindParam(':username', $user);
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);
	$info = $return[0];

	$classes_id = array();
	array_push($classes_id, $info['class1']);
	array_push($classes_id, $info['class2']);
	array_push($classes_id, $info['class3']);
	array_push($classes_id, $info['class4']);
	array_push($classes_id, $info['class5']);
	array_push($classes_id, $info['class6']);
	array_push($classes_id, $info['class7']);
	array_push($classes_id, $info['class8']);

	$classes = array();

	foreach ($classes_id as $class_id){
	
	$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
	$run = $dbh->prepare('SELECT * FROM classes WHERE class_id = :class_id');
	$run->bindParam(':class_id', $class_id);
	$run->execute();

	$return = $run->fetchALL(PDO::FETCH_ASSOC);

		array_push($classes, $return[0]['class']);

	}

	array_filter($classes);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$date = date("m/d/y");
		$due = filter($_POST["dateDue"]);
		$tries = filter($_POST["tries"]);
		$class = filter($_POST["class"]);
		$byte_id = filter($_POST["byteId"]);

		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('SELECT * FROM classes WHERE class = :class');
		$run->bindParam(':class', $class);
		$run->execute();

		$return = $run->fetchAll(PDO::FETCH_ASSOC);
		$assign_class_id = $return[0]['class_id'];

		$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
		$run = $dbh->prepare('SELECT user_id FROM users WHERE class1 = :class1 OR class2 = :class2 OR class3 = :class3 OR class4 = :class4 OR class5 = :class5 OR class6 = :class6 OR class7 = :class7 OR class8 = :class8');
		$run->bindParam(':class1', $assign_class_id);
		$run->bindParam(':class2', $assign_class_id);
		$run->bindParam(':class3', $assign_class_id);
		$run->bindParam(':class4', $assign_class_id);
		$run->bindParam(':class5', $assign_class_id);
		$run->bindParam(':class6', $assign_class_id);
		$run->bindParam(':class7', $assign_class_id);
		$run->bindParam(':class8', $assign_class_id);
		$run->execute();

		$return = $run->fetchALL(PDO::FETCH_ASSOC);

		$students = $return; #might not work. We will see.

		foreach ($students as $student) {
			$dbh = new PDO("mysql:host=prioritycodingcom.ipagemysql.com;dbname=tevatron", $sql_user, $sql_pass);
			$run = $dbh->prepare('UPDATE assigned SET $class."_class" = :class, $byte_id."_date" = :today, $byte_id."_due" = :due, $byte_id."_tries" = :tries WHERE user_id = :user_id');
			$run->bindParam(':class', $assign_class_id);
			$run->bindParam(':today', $date);
			$run->bindParam(':due', $due);
			$run->bindParam(':tries', $tries);
			$run->bindParam(':user_id', $student);
			$run->execute();
		}



	}


  }
}catch(PDOException $e){
  $errorHad = true;
  $error = "Seems we could not reach our servers! Please contact an admin.";
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Assign Bytes</title>
	<link rel="stylesheet" type="text/css" href="CSS/dashboard.css">
	<link rel="stylesheet" type="text/css" href="../CSS/login.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa|Merriweather+Sans" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		
		var subjects = 
			<?php
			echo json_encode($subjects);
			?>
		;
		var topics = 
			<?php
			echo json_encode($topics, JSON_NUMERIC_CHECK);
			?>
		;
		var bytes = 
			<?php
			echo json_encode($bytes, JSON_NUMERIC_CHECK);
			?>
		;
		var previews = 
			<?php
			echo json_encode($previews, JSON_NUMERIC_CHECK);
			?>
		;

		var addedBytes = [];

		$(document).ready(function(){
		  for(i = 0;i < subjects.length; i++) {
		    $('#subjectsColumn').append('<div class="subject" id="'+ subjects[i] +'-div" onClick="topicShow(' + i +')"> <p class="name">' + subjects[i] + '</p><p class="arrow">&rarr;</p></div><hr class="hrSubjects">');
		  }
		});

		function topicShow(subjectId) {
			$('#preview-content').css('display', 'none');
			$('.byte').remove();
			$('.hrByte').remove();
			$('.subject').css('font-weight', 'normal');
			$('#' + subjects[subjectId] + '-div').css('font-weight', 'bold');
			$('.topic').remove();
			$('.hrTopic').remove();
			for(i = 0;i < topics.length; i++) {
				if(topics[i] === subjectId) {
					var b = i-1;
			        $('#topicsColumn').append('<div class="topic" id="'+ b +'-div" onClick="byteShow(' + b +')"> <p class="name">' + topics[b] + '</p><p class="arrow">&rarr;</p></div><hr class="hrTopic">');
				}
		  	}
		}

		function byteShow(topicId) {
			$('#preview-content').css('display', 'none');
			$('.topic').css('font-weight', 'normal');
			$('#' + topicId + '-div').css('font-weight', 'bold');
			$('.byte').remove();
			$('.hrByte').remove();
			for(i = 0;i < bytes.length; i++) {
				var b = i-1;
				if(bytes[i] === topicId) {
			        $('#bytesColumn').append('<div class="byte" id="'+ bytes[b] +'-div" onClick="previewShow(' + b +')"> <p class="name">' + bytes[b] + '</p><p class="arrow">&rarr;</p></div><hr class="hrByte">');
				}
		  	}
		}

		function previewShow(byteId) {
			$('#center').remove();
			$('#preview-content').css('display', 'block');
			$('#previewTitle').text(bytes[byteId]);
			$('#previewDesc').text(previews[byteId+1]);
			$('#preview-content').append('<center id="center"><input class="btn-primary" type="submit" value="Preview Byte"><input onClick="addByte(' + previews[byteId] + ')" class="btn-primary" type="submit" value="Add Byte" id="previewAdd"></center>');
		}

		function addByte(byteId) {
			$('.darken').css('display','block');
			$('.addWindow').css('display','block');
			$('#byteName').text(bytes[byteId]);
			$('#byteId').val(previews[byteId]);
		}

		function byteAssigned() {
			$('.darken').css('display','none');
			$('.addWindow').css('display','none');
		}

	</script>
</head>
<body>
	<?php
		$title = 'Assign Byte';
		include '../includes/usernavbar.php';
	?>
	<div class="column" id="subjectsColumn">
		<h1>Subject</h1>
	</div>
	<div class="column" id="topicsColumn">
		<h1>Topic</h1>
	</div>
	<div class="column" id="bytesColumn">
		<h1>Bytes</h1>
	</div>
	<div class="column">
		<h1>Preview</h1>
		<div id="preview-content">
			<img src="../img/background.jpg">
			<h2 id="previewTitle">Why Not H?</h2>
			<p id="previewDesc" style="width: 70%;text-align: center;margin-left: 15%;margin-top: 10px;">This byte will ask the students all about the letters that are used to make up music. And H is not one of them.</p>
			
		</div>
	</div>
	<div class="darken">
		
	</div>
	<div class='addWindow'>
		<form name="message" method="post" style="margin-top: 30px;">
			<center>
				<h2 id="byteName">Placeholder Text</h2>
				<h3>Date Due</h3>
				<input name="dateDue" id="dateDue" type="date" class="single-input, addByteInput" placeholder="Class Code">
				<h3>Number of Tries</h3>
				<input name="tries" id="tries" type="number" class="single-input, addByteInput" placeholder="4">
				<h3>Class</h3>
				<select name= "class" id="class" class="addByteInput">
					<?php
					foreach ($classes as $class){
						echo "<option> $class </option>";
					}
					?>
				</select>
				<input name="byteId" id="byteId" type="text" class="single-input, addByteInput" placeholder="4" style="display: none;">
				<input type="submit" name="login" action='post' class="btn-primary" value="Assign Byte" style="width: 70%;margin-top: 30px;" onclick="byteAssigned()">
			</center>
		</form>
	</div>
</body>
</html>