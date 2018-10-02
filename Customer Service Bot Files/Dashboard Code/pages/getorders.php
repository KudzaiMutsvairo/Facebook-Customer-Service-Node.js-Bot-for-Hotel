<?php

require_once('../mysqli_connect.php');

$query = "SELECT * FROM orders";

$response = @mysqli_query($dbc, query);

if($response){
	echo '<table align="left" cellspapcing="5" cellpadding="8">
		<tr><td align="left"><b>OrderID</b><td>
		<td align="left"><b>Date</b><td>
		<td align="left"><b>Time</b><td>
		<td align="left"><b>Room</b><td>
		<td align="left"><b>Order Items</b><td></tr>'

		while ($row = mysqli_fetch_array($response)) {
			echo '<tr><td alig="left">' .
			$row['_id'] . </td><td align="left">'.
			$row['date'] . </td><td align="left">'.
			$row['time'] . </td><td align="left">'.
			$row['room'] . </td><td align="left">'.
			$row['order items'] . </td><td align="left">';
			echo '</tr>';
		}

	echo '</table>';
}else{
	 echo "Couldnt issue database query";
	 echo mysqli_error($dbc);
}

mysqli_close($dbc);
?>