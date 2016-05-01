<?php 



	global $returnedName, $returnedAddress, $returnedEmail, $returnedPhoneNo, $returnedSize,
		$nameError, $addressError, $emailError, $phoneError;

	
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
	$checkSize = $_POST['pizzaSize'];


	switch ($checkSize) {
		case 'small':
			$returnedSize = 'small';
			break;
		case 'medium':
			$returnedSize = 'medium';	
			break;
		case 'large':
			$returnedSize = 'large';
		default:
			# code...
			break;
	}



	// check there's an entry for a first name
	$checkFName = $_POST['firstname'];
	if(empty($checkFName))
	{
		$nameError = 'You forgot to enter your first name.';
		$errors[] = "name";
	}
	// check first name format
	elseif(!preg_match("/^[a-zA-Z ]*$/", $checkFName))
	{
		$nameError = "Only letters and spaces allowed for first name field.";
		$errors[] = "name";
	}
	else
	{
		$returnedName = trim($checkFName);
	}




	// check there's an entry for a email
	$checkEmail = $_POST['email'];
	if(empty($checkEmail))
	{
		$emailError = 'You forgot to enter your email address.';
		$errors[] = 'email';
	}
	elseif(!preg_match(
        '/^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z.]{2,4}$/', $checkEmail))
	{
		$emailError = "Invalid Email.";
		$errors[] = "email";
	}
	else
	{
		$returnedEmail = trim($checkEmail);
	}

	// check there's an entry for a address
	$checkAddress = $_POST['address'];
	if(empty($checkAddress)){
		$addressError = 'You forgot to enter your address.';
		$errors[] = 'address';
	}else{
		$returnedAddress = trim($checkAddress);
	}

	// check there's an entry for a phone number
	$checkPhoneNo = $_POST['phoneNo'];
	if(empty($checkPhoneNo))
	{
		$phoneError = 'You forgot to enter your phone number.';
		$errors[] = 'phone number';
	}
	elseif(!is_numeric($checkPhoneNo))
	{
		$phoneError = 'Your phone number cannot contain letters.';
		$errors[] = 'phone number';
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


 ?>