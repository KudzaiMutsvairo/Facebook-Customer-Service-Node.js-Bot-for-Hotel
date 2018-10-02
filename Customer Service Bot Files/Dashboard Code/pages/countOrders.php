<?php
header('Content-Type: application/json');

DEFINE('DB_USER', 'id6063512_kudzie');
DEFINE('DB_PASSWORD', 'password123');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'id6063512_chatbotdb');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL ' . mysqli_connect_error());

$year = date('Y');

$month[0] = "SELECT * FROM orders WHERE order_date >= '".$year."-01-01' AND order_date <= '".$year."-01-31'";
$month[1] = "SELECT * FROM orders WHERE order_date >= '".$year."-02-01' AND order_date <= '".$year."-02-28'";
$month[2] = "SELECT * FROM orders WHERE order_date >= '".$year."-03-01' AND order_date <= '".$year."-03-31'";
$month[3] = "SELECT * FROM orders WHERE order_date >= '".$year."-04-01' AND order_date <= '".$year."-04-30'";
$month[4] = "SELECT * FROM orders WHERE order_date >= '".$year."-05-01' AND order_date <= '".$year."-05-31'";
$month[5] = "SELECT * FROM orders WHERE order_date >= '".$year."-06-01' AND order_date <= '".$year."-06-30'";
$month[6] = "SELECT * FROM orders WHERE order_date >= '".$year."-07-01' AND order_date <= '".$year."-07-31'";
$month[7] = "SELECT * FROM orders WHERE order_date >= '".$year."-08-01' AND order_date <= '".$year."-08-31'";
$month[8] = "SELECT * FROM orders WHERE order_date >= '".$year."-09-01' AND order_date <= '".$year."-09-30'";
$month[9] = "SELECT * FROM orders WHERE order_date >= '".$year."-10-01' AND order_date <= '".$year."-10-31'";
$month[10] = "SELECT * FROM orders WHERE order_date >= '".$year."-11-01' AND order_date <= '".$year."-11-30'";
$month[11] = "SELECT * FROM orders WHERE order_date >= '".$year."-12-01' AND order_date <= '".$year."-12-31'";

//to run the queries and save in results
$results = array();
$resultNum = array();

foreach ($month as $monthx) { 
	$results[] = @mysqli_query($dbc, $monthx);
}

foreach ($results as $key) {
	$resultNum[] = mysqli_num_rows($key);
}

//print json_encode($resultNum);
print json_encode($resultNum);
?>
