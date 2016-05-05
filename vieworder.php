<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<title>View Order</title>
	<link href="./Styles/main.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="./js/pizza-order.js"></script>
</head>
<body>

<?php 

// assign empty values to variables 


if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
// database connection
require_once('mysqli_connect.php');





include('validate.php');


/* There are no errors - submit MySQLi statement */
if(empty($errors))
{

	/* We use 'prepared statment', to prevent SQL injection. 
	The (?,?,?) are parameter markers for var binding*/

	// Prepared Statement
	$insertQuery = "INSERT INTO orders 
		(order_id, firstname, lastname, email, student, address, phone, price, size,
			anchovies, pinapples, pepperoni, olives, onion, peppers, createddatetime) 
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

	if(!$stmt = $dbc->prepare($insertQuery)){
	echo "Prepare failed: (" . $dbc->errno . ") " . $dbc->error;
	}

	// Bind Parameters
	$mBindParam = $stmt->bind_param(
	"ssssssidssssssss", 
	$order_id, $firstname, $lastname, $email, $student,
		$address, $phoneNo, $price, $size, $addAnchovies, $addPineapple,
			$addPepperoni, $addOlives, $addOnions, $addPeppers, $createdDateTime); 

	if(!$mBindParam){
	echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
	}



	// unique ID  
	$order_id = uniqid();
	$createdDateTime = date('Y-m-d H:i:s');




	/* make the sql bind_params equal to the returned value of 
	$_POST['***'] that was retrieved in the validation above */
	$firstname = $returnedName;
	$lastname = $returnedLastName;
	$email = $returnedEmail;
	$student = $returnedStudent;
	$address = $returnedAddress;
	$phoneNo = $returnedPhoneNo;
	$price = $returnedPrice;
	$size = $returnedSize;
	$addAnchovies = $returnedAnchovies;
	$addPineapple = $returnedPineapples;
	$addPepperoni = $returnedPepperoni;
	$addOlives = $returnedOlives;
	$addOnions = $returnedOnions;
	$addPeppers = $returnedPeppers;


	// store the value returned from the sql statement in the boolean 'result'
	$result = $stmt->execute();


	// Using the 'result' of the query, we perform a conditional test. 
	// Either display the receipt, or print the error(s). 
	if($result){

		include('receipt.php');

		}else{
			echo '<h1>Register Error</h1>';
			echo '<p>MySQLi Error: ' . mysqli_error($dbc); 
	}


	// close connection to DB
	$dbc->close();



// There are errors - loop thru and pint message(s)
}else {
	echo 'Hello '. $returnedName . ' please check the following error(s): ';
	foreach($errors as $msg){
		echo "$msg | "; 
}
?>

<h2 id="heading">Pizzas Order Form</h2>
<form id="pizza-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="mForm" method="post" novalidate>
	<h3>What Size of Pizza Would You Like? </h3>

	Small
	<input id="small" type="radio" name="pizzaSize" value="small" onChange="redraw()"/>
	Medium
	<input id="medium" type="radio" name="pizzaSize" value="medium" onChange="redraw()" />
	Large
	<input id="large" type="radio" name="pizzaSize" value="large" onChange="redraw()" checked/>

	<div id="pizzaImages">
		<img id="image1" src="images/base.png" width="250" height="250" alt="food pic"/>
		<img id="image2" src="images/anchois.png" width="250" height="250" alt="food pic"/>
		<img id="image3" src="images/pineapple.png" width="250" height="250" alt="food pic"/>
		<img id="image4" src="images/pepperoni.png" width="250" height="250" alt="food pic"/>
		<img id="image5" src="images/olives.png" width="250" height="250" alt="food pic"/>
		<img id="image6" src="images/onion.png" width="250" height="250" alt="food pic"/>
		<img id="image7" src="images/pepper.png" width="250" height="250" alt="food pic"/>
	</div>
	<br>
	<h3>Add Extra Toppings</h3>

	Anchovies
	<input id="anchovies" type="checkbox" name="addAnchovies" value="yes" onChange="redraw()" checked/>

	Pineapple
	<input id="pineapple" type="checkbox" name="addPineapple" value="yes" onChange="redraw()" checked/>

	Pepperoni
	<input id="pepperoni" type="checkbox" name="addPepperoni" value="yes" onChange="redraw()" checked/>

	Olives
	<input id="olives" type="checkbox" name="addOlives" value="yes" onChange="redraw()" checked/>

	Onion
	<input id="onion" type="checkbox" name="addOnion" value="yes" onChange="redraw()" checked/>

	Peppers
	<input id="peppers" type="checkbox" name="addPeppers" value="yes" onChange="redraw()" checked/>

	<h3>Total Price is: €<span id="pricetext">18</span></h3>

	

	<h3>Enter your  details</h3>
	Name:
	<input name="firstname" id="cname" type="text" value="<?php echo $returnedName;?>"/><span class="error"><?php echo $nameError;?></span>
	<br/>
	<br/>
	Address:
	<textarea name="address" id = "caddress" type="text"rows="5" cols="30"/><?php echo $returnedAddress;?></textarea>
	<span class="error"><?php echo $addressError;?></span>
	<br/>
	<br/>
	Email Address:
	<input name="email" type="email" value="<?php echo $returnedEmail; ?>"/><span class="error"><?php echo $emailError; ?></span>
	<br/>
	<br/>
	<br/>
	Phone Number:
	<input name="phoneNo" id="phoneNumber" type="text" value="<?php echo $returnedPhoneNo; ?>"/><span class="error"><?php echo $phoneError; ?></span>
	<br/>
	<br/>
	Tick here if you are student:
	<input type="checkbox" id="studentdiscount" name="student" value="<?php $returnedStudent; ?>"  />
	<br/>
	<button type="submit" name="submit" value="Place Order" >Submit order</button>
</form>

<?php
}

}// end $_SERVER['REQUEST_METHOD'] == 'POST'

?>
</body>
</html>