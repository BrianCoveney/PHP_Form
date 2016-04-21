<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
</head>
<body>

<?php 


echo "<table border = '1' cellspacing='0'>\n";
			echo "<tr><th>ID</th>" .
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
				     "<th>Peppers</th></tr>";

	
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
				 "<td><a href=\"updateorder.php?ReportID=" . 
                         $order_id . "\">Update</a></td>" . 
                    "</tr>\n";
?>

</body>
</html>