
<?php
if($_POST["name"] || $_POST["punchline"]){
	echo "Welcome ".$_POST['name']. "<br/>";
	echo "".$_POST['punchline'];
	http_response_code(200);
	$myfile = fopen("result.txt", "w") or die("Unable to open file");
	fwrite($myfile, "name is ".$_POST['name']." \n");
	fclose($myfile);
	exit();
} 
?>