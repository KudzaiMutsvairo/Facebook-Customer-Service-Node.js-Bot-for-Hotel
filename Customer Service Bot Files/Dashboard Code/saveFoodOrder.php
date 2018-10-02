<?php
echo "Connection successful";
//Module to save food orders posted from the bot
DEFINE('DB_USER', 'id6063512_kudzie');
DEFINE('DB_PASSWORD', 'password123');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'id6063512_chatbotdb');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL ' . mysqli_connect_error());

if($_POST["room"] && $_POST["food"]){
	$room = trim($_POST["room"]);
	$order_items = trim($_POST["food"]);

	$date = date('Y/m/d');
	$time = date("h:i");

	$sql = "INSERT INTO orders (order_date, order_time, room, order_items) VALUES ('".$date."', '".$time."', '".$room."', '".$order_items."');";

	if ($dbc->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $dbc->error;
	}

}

?>