<!DOCTYPE html>
<html>
<head>
	<title>Test Connection to Database</title>
</head>
<body>

<?php

DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', 'bossdog12');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'pizza');


// make the connection
$dbc = @mysqli_connect(DB_HOST, DB_USER, 
	DB_PASSWORD, DB_NAME); 

if(!$dbc){
	die('Could not conncet to MYSQL: '
		. mysqli_error());
}

// passed
// echo "Connected to database successfully";

?>


</body>
</html>