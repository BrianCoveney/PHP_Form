<!DOCTYPE html>
<html>
<head>
	<title>Receipt</title>
	<link href="../Styles/main.css" rel="stylesheet" type="text/css">
</head>
<body>

<main id="receipt-main">
<?php 


// Normailise the MySQL DATETIME format 
// from: 2016-04-01 14:42:00 
// to: 	 May 01, 2016, 2:42 pm
$mDateFormat = date('F j, Y, g:i a', strtotime($createdDateTime));

// **:**pm
$timeBaked = date('g:ia', strtotime($mDateFormat));

?>
<div id="receipt-bg">
<h1 class="mTime"> Hi <?php echo $returnedName ?>, your pizza began baking at <?php echo $timeBaked?>.</h1>

<?php

echo "<fieldset class='fieldset'><table border = '1' cellspacing='0'>\n";
			echo "<tr><th>Order ID</th>" .
				     "<th>First Name</th>" .
				     "<th>Last Name</th>" .
				     "<th>Email</th>" .
				     "<th>Student</th>" .
				     "<th>Address</th>" .
				     "<th>Phone No</th>" .
				     "<th>Price</th>" . 
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
				 "<td>" . $returnedLastName . "</td>" .
				 "<td>" . $returnedEmail . "</td>" .
				 "<td>" . $returnedStudent . "</td>" .
				 "<td>" . $returnedAddress . "</td>" .
				 "<td>" . $returnedPhoneNo . "</td>" .
				 "<td>" . $returnedPrice . "</td>" .
				 "<td>" . $returnedSize . "</td>" .
				 "<td>" . $returnedAnchovies . "</td>" .
				 "<td>" . $returnedPineapples . "</td>" .
				 "<td>" . $returnedPepperoni . "</td>" .
				 "<td>" . $returnedOlives . "</td>" .
				 "<td>" . $returnedOnions . "</td>" .
				 "<td>" . $returnedPeppers . "</td>" . 
				 "<td>" . $mDateFormat . "</td>
				 </table></fieldset>";

				 // "<td><a href=\"updateorder.php?order_id=" 
				 // 	. $order_id . "\">Update Order</a></td>" . "</tr>\n </table>";


			// path to URL
        	$theURL = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] .
        		"/updateorder.php?order_id=" .$order_id;
          
?>


</div>

<h2><?php echo "If you would like to update your order, please click this link: <br />
            	<a href=\"updateorder.php?order_id=" . "?" .  $order_id . "\"> $theURL </a>"  ?> </h2>



</body>
</html>