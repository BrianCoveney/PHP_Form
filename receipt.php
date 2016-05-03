<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
</head>
<body>

<?php 


// Normailise the MySQL DATETIME format 
// from: 2016-04-01 14:42:00 
// to: 	 May 01, 2016, 2:42 pm
$mDateFormat = date('F j, Y, g:i a', strtotime($createdDateTime));


echo "<table border = '1' cellspacing='0'>\n";
			echo "<tr><th>Order ID</th>" .
				     "<th>Name</th>" .
				     "<th>Email</th>" .
				     "<th>Student</th>" .
				     "<th>Address</th>" .
				     "<th>Phone No</th>" . 
				     "<th>Size</th>" . 
				     "<th>Anchovies</th>" . 
				     "<th>Pineapple</th>" . 
				     "<th>Pepperoni</th>" .
				     "<th>Olives</th>" .
				     "<th>Onions</th>" . 
				     "<th>Peppers</th>" .
				     "<th>Date & Time</th></tr>";

	
			echo "<td>". $order_id . "</td>" .
				 "<td>" . $returnedName . "</td>" .
				 "<td>" . $returnedEmail . "</td>" .
				 "<td>" . $returnedStudent . "</td>" .
				 "<td>" . $returnedAddress . "</td>" .
				 "<td>" . $returnedPhoneNo . "</td>" .
				 "<td>" . $returnedSize . "</td>" .
				 "<td>" . $returnedAnchovies . "</td>" .
				 "<td>" . $returnedPineapples . "</td>" .
				 "<td>" . $returnedPepperoni . "</td>" .
				 "<td>" . $returnedOlives . "</td>" .
				 "<td>" . $returnedOnions . "</td>" .
				 "<td>" . $returnedPeppers . "</td>" . 
				 "<td>" . $mDateFormat . "</td>" .
				 "<td><a href=\"updateorder.php?ReportID=" . 
                         $order_id . "\">Update</a></td>" . 
                    "</tr>\n";
?>

</body>
</html>