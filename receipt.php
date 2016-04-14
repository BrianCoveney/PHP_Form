<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
</head>
<body>

<?php 

$SQLString = "SELECT firstname FROM orders ORDER BY id";

$queryResult = mysqli_query($dbc, $SQLString);

if(!$queryResult){
	echo 'Error executing query: ', mysqli_error($dbc);
	exit();
}else{
	echo "First name: $fn<br />";
	echo "Last Name: $ln";
}


?>



 
</body>
</html>