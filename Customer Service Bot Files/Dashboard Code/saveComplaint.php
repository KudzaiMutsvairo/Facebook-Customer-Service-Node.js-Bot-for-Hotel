<?php
//Module to complaints orders posted from the bot
DEFINE('DB_USER', 'id6063512_kudzie');
DEFINE('DB_PASSWORD', 'password123');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'id6063512_chatbotdb');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL ' . mysqli_connect_error());

if($_POST['room'] && $_POST['facility'] && $_POST['complaintText'] && $_POST['dept']){
	
	$room = trim($_POST['room']);
	$complaint_statement = trim($_POST['complaintText']);
	$facility = trim($_POST['facility']);
	$dept = trim($_POST['dept']);

	$date = date('Y/m/d');
	$time = date("h:i");

	$sql = "INSERT INTO complaints (complaintDept, complaintDate, complaintTime, facility, statement, room)VALUES ('".$dept."', '".$date."', '".$time."', '".$facility."', '".$complaint_statement."', '".$room."')";

	if ($dbc->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . ": " . $dbc->error;
	}

}

?>