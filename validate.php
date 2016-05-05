<?php 



	global $returnedName, $returnedLastName, $returnedAddress, $returnedEmail, 
			$returnedPhoneNo, $returnedSize, $returnedPrice,
				$nameError, $addressError, $emailError, $phoneError;

	
	// initalise an error array 
	$errors = array();


	/*--- Here the returned value of $_POST 
	are stored in variables. These are used later on -
	for insertion into the db ---*/

	

	// radio button selection for 'Size' 
	$checkSize = $_POST['pizzaSize'];
	switch ($checkSize) {
		case 'small':
			$returnedSize = 'small';
			$returnedPrice = 6; // 6 euro
			break;
		case 'medium':
			$returnedSize = 'medium';	
			$returnedPrice = 10;
			break;
		case 'large':
			$returnedSize = 'large';
			$returnedPrice = 12;
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
		// requires that user enters their Last Name, by checking for a space
		// after Firsr Name
		$checkForSpace = strpos($checkFName, " ");

		if($checkForSpace === false){
			$nameError = 'You forgot to enter your last name.';
			$errors[] = "name";
		}else{

			$nameArr = explode(" ", $checkFName);
			$returnedName = $nameArr[0];
			$returnedLastName = $nameArr[1];
		}
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
	if(isset($_POST['addAnchovies'])){ 
		$returnedAnchovies = 'Y';
		if($checkSize == "small"){
			$returnedPrice += 0.5; // 50c added
		}else{
			$returnedPrice += 1;// 1euro added
		}	
	}else{ 
		$returnedAnchovies = 'N'; 
	}
	
	if(isset($_POST['addPineapple'])){ 
		$returnedPineapples = 'Y';
		if($checkSize == "small"){
			$returnedPrice += 0.5;
		}else{
			$returnedPrice += 1;
		}
	}else{ 
		$returnedPineapples = 'N'; 
	}
	
	if(isset($_POST['addPepperoni'])){ 
		$returnedPepperoni = 'Y';
		if($checkSize == "small"){
			$returnedPrice += 0.5;
		}else{
			$returnedPrice += 1;
		}
	}else{ 
		$returnedPepperoni = 'N'; 
	}

	if(isset($_POST['addOlives'])){ 
		$returnedOlives = 'Y';
		if($checkSize == "small"){
			$returnedPrice += 0.5;
		}else{
			$returnedPrice += 1;
		}
	}else{ 
		$returnedOlives = 'N'; 
	}

	if(isset($_POST['addOnion'])){ 
		$returnedOnions = 'Y';
		if($checkSize == "small"){
			$returnedPrice += 0.5;
		}else{
			$returnedPrice += 1;
		}
	}else{ 
		$returnedOnions = 'N'; 
	}

	if(isset($_POST['addPeppers'])){ 
		$returnedPeppers = 'Y';
		if($checkSize == "small"){
			$returnedPrice += 0.5;
		}else{
			$returnedPrice += 1;
		}
	}else{ 
		$returnedPeppers = 'N'; 
	}


	// checkbox for Student discount
	if(isset($_POST['student'])){
		$returnedStudent = 'Y';
		$returnedPrice *= 0.9; // 10% student discount
	}else{
		$returnedStudent = 'N';
	}



 ?>