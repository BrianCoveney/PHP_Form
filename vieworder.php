<!DOCTYPE html>
<html>
<head>
	<title>View Order</title>
</head>
<body>

<?php 

// assign empty values to variables 
$returnedName = $returnedAddress = $returnedEmail = $returnedPhoneNo ="";
$nameError = $addressError = $emailError = $phoneError="";

if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	// database connection
	require('mysqli_connect.php');

	// initalise an error array
	$errors = array();


	/*--- Here the returned value of $_POST 
	are stored in variables. These are used later on -
	for insertion into the db ---*/

	// checkbox Y/N 
	if(isset($_POST['student'])){
		$returnedStudent = 'Y';
	}else{
		$returnedStudent = 'N';
	}


	// radio button selection for 'Size' 
	$returnedSize = $_POST['pizzaSize'];



	// check there's an entry for a first name
	$checkFName = $_POST['firstname'];
	if(empty($checkFName))
	{
		$nameError = 'You forgot to enter your first name.';
	}
	// check first name format
	elseif(!preg_match("/^[a-zA-Z ]*$/", $checkFName))
	{
		$nameError = "Only letters and spaces allowed for first name field.";
	}
	else
	{
		$returnedName = trim($checkFName);
	}

	


	// check there's an entry for a last name
	$checkLName = $_POST['lastname'];
	if(empty($_POST['lastname']))
	{
		$errors[] = 'You forgot to enter your second name.';
	}
	// check last name format
	elseif(!preg_match("/^[a-zA-Z ]*$/", $checkLName))
	{
		$errors[] = "Only letters and spaces allowed for second name field.";
	}
	else
	{
		$ln = trim($checkLName);
	}


	// check there's an entry for a email
	$checkEmail = $_POST['email'];
	if(empty($checkEmail))
	{
		$emailError = 'You forgot to enter your email address.';
	}
	elseif(!preg_match(
        '/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $checkEmail))
	{
		$emailError = "Invalid Email.";
	}
	else
	{
		$returnedEmail = trim($checkEmail);
	}

	// check there's an entry for a address
	$checkAddress = $_POST['address'];
	if(empty($checkAddress)){
		$addressError = 'You forgot to enter your address.';
	}else{
		$returnedAddress = trim($checkAddress);
	}

	// check there's an entry for a phone number
	$checkPhoneNo = $_POST['phoneNo'];
	if(empty($checkPhoneNo))
	{
		$phoneError = 'You forgot to enter your phone number.';
	}
	elseif(!is_numeric($checkPhoneNo))
	{
		$phoneError = 'Your phone number cannot contain letters.';
	}
	else
	{
		$returnedPhoneNo = trim($_POST['phoneNo']);
	}


	// checkbox Y/N for 'Toppings'
	if(isset($_POST['addAnchovies'])){ $returnedAnchovies = 'Y';
	}else{ $returnedAnchovies = 'N'; }
	
	if(isset($_POST['addPineapple'])){ $returnedPineapples = 'Y';
	}else{ $returnedPineapples = 'N'; }
	
	if(isset($_POST['addPepperoni'])){ $returnedPepperoni = 'Y';
	}else{ $returnedPepperoni = 'N'; }

	if(isset($_POST['addOlives'])){ $returnedOlives = 'Y';
	}else{ $returnedOlives = 'N'; }

	if(isset($_POST['addOnion'])){ $returnedOnions = 'Y';
	}else{ $returnedOnions = 'N'; }

	if(isset($_POST['addPeppers'])){ $returnedPeppers = 'Y';
	}else{ $returnedPeppers = 'N'; }

	/*--- Validation Ends Here ---*/


	/* There are no errors - submit MySQLi statement */
	if(empty($errors))
	{
		
		/* We use 'prepared statment', to prevent SQL injection. 
		The (?,?,?) are parameter markers for var binding*/

		// Prepared Statement
		$insertQuery = "INSERT INTO orders 
				(order_id, firstname, lastname, email, student, address, phone, size,
				anchovies, pinapples, pepperoni, olives, onion, peppers) 
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

		if(!$stmt = $dbc->prepare($insertQuery)){
			echo "Prepare failed: (" . $dbc->errno . ") " . $dbc->error;
		}
			
		// Bind Parameters
		$mBindParam = $stmt->bind_param(
			"ssssssisssssss", 
			$order_id, $firstname, $lastname ,$email, $student,
				$address, $phoneNo, $size, $addAnchovies, $addPineapple,
					$addPepperoni, $addOlives, $addOnions, $addPeppers); 

		if(!$mBindParam){
			echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
		}

		// unique ID  
		$order_id = uniqid(rand(), true);

		/* make the sql bind_params equal to the returned value of 
		$_POST['***'] that was retrieved in the validation above */
		$firstname = $returnedName;
		$lastname = $ln;
		$email = $returnedEmail;
		$student = $returnedStudent;
		$address = $returnedAddress;
		$phoneNo = $returnedPhoneNo;
		$size = $returnedSize;
		$addAnchovies = $returnedAnchovies;
		$addPineapple = $returnedPineapples;
		$addPepperoni = $returnedPepperoni;
		$addOlives = $returnedOlives;
		$addOnions = $returnedOnions;
		$addPeppers = $returnedPeppers;


		// store the value returned from the sql statement in the boolean 'result'
		$result = $stmt->execute();


		// using the 'result' of the query, we perform a conditional test for success 
		if($result){
			// include('receipt.php');

			echo "<table border = '1' cellspacing='0'>\n";
			echo "<tr><th>ID</th>" .
				     "<th>First Name</th>" .
				     "<th>Last Name</th>" .		
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
				 "<td>" . $ln . "</td>" .
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
				 "<td>" . $returnedPeppers . "</td>";

		}else{
			echo '<h1>Register Error</h1>';
			echo '<p>MySQLi Error: ' . mysqli_error($dbc); 
		}
		
		
	// close connection to DB
	$dbc->close();

		
	// There are errors - loop thru and pint message(s)
	}else {
		// echo '<p>Error(s):</p>';
		// foreach($errors as $msg){
		// 	echo "- $msg<br />\n";
		// }

		?>


<h2 id="heading">Pizzas Order Form</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="post" novalidate>
      <h3>What Size of Pizza Would You Like? </h3>
     
        Small
        <input id="small" type="radio" name="pizzaSize" value="small" onChange="redraw()"/>
        Medium
        <input id="medium" type="radio" name="pizzaSize" value="medium" onChange="redraw()" />
        Large
        <input id="large" type="radio" name="pizzaSize" value="large" onChange="redraw()" checked/>
   
      
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
   
        <h3>Enter your  details</h3>
        First Name:
        <input name="firstname" id="cname" type="text" value="<?php echo $returnedName;?>"/><?php echo $nameError;?>
        <br/>
        <br/>
        Second Name:
        <input name="lastname" id="cname" type="text"/>
        <br/>
        <br/>
        Address:
        <textarea name="address" id = "caddress" type="text"rows="5" cols="30" value="<?php echo $returnedAddress;?>"/></textarea><?php echo $addressError;?>
        <br/>
        <br/>
        Email Address:
        <input name="email" type="email" value="<?php echo $returnedEmail; ?>"/><?php echo $emailError; ?>
        <br/>
        <br/>
        <br/>
        Phone Number:
        <input name="phoneNo" id="phoneNumber" type="text" value="<?php echo $returnedPhoneNo; ?>"/><?php echo $phoneError; ?>
		 <br/>
         <br/>
		Tick here if you are student:
        <input type="checkbox" id="studentdiscount" name="student" onChange="redraw()"/>
       
  
      <br/>
      <button type="submit" name="submit" value="Place Order" >Submit order</button>
    </form>

    <?php
	}

}// end the main Submit

?>
</body>
</html>