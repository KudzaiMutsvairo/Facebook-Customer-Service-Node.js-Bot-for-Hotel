<?php
DEFINE('DB_USER', 'n01414178p');
DEFINE('DB_PASSWORD', 'password123');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'chatbotDB');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MYSQL ' . mysqli_connect_error());

?>