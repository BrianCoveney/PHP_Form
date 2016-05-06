<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Update Order</title>
    <link href="./Styles/main.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="./js/pizza-order.js"></script>
</head>
<body>

<?php 




$ShowForm=TRUE;
$nameError =""; 
$emailError =""; 
$phoneError =""; 
$addressError ="";





require('mysqli_connect.php');



// fetch data from the DB for the form below
$SQLString = "SELECT * FROM orders";
$r = mysqli_query($dbc, $SQLString);

if (mysqli_num_rows($r) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($r)) {

        $retOrderID = $row["order_id"];
        $returnedName = $row["firstname"];
        $retLastName = $row["lastname"];
        $retEmail = $row['email'];
        $retAddress = $row['address'];
        $retPhoneNo = $row['phone'];
        $retPrice = $row['price'];
        $retSize = $row['size'];
        $retStudent = $row['student'];
        $returnedAnchovies = $row['anchovies'];
        $retPineapple = $row['pinapples'];
        $retPepperoni = $row['pepperoni'];
        $retOlives = $row['olives'];
        $retOnion = $row['onion'];
        $retPeppers = $row['peppers'];
    }

} else {
        
        // If, for example by calling
        // http://localhost/vieworder.php?order_id=54ff645d4506a <= incorrect order_id
        // the order_id cannot be found, the customer should be presented with a
        // “cannot find order” style of error message.

        header('Location: http://localhost/phpproj/brian_coveney/page-not-found.php');
        exit;

}




// This will redirect to page-not-found.php if user enters invalid URL,
// but will also redirect when 'Update' is clicked

// $id="";
// $id = ($_GET['order_id']);

// // $subID =  substr($id, 1); // remove first char, the '?'

// //prepend '?' to variable, to match $_GET['order_id']
// $mOrderID = '?' . $retOrderID;


// if($id == $mOrderID){
//     echo "<h1>ID equal: $id = $mOrderID</h1>";
// }else{

//     echo "<h1>ID not: $id != $mOrderID</h1>";

//     // header('Location: http://localhost/phpproj/brian_coveney/page-not-found.php');
//     // exit;
// }





// if 'update' is clicked
if(isset($_POST['update']))
{

    include('validate.php');

    $order_id =$_POST['order_id'];
    $hidden = $_POST['hidden'];
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phoneNo'];
    $size = $_POST['pizzaSize'];
    $price = $_POST['price'];





    // requires that user enters their Last Name, by checking for a space
    // after Firsr Name
    $checkForSpace = strpos($checkFName, " ");

    if($checkForSpace === false){
        $nameError = 'You forgot to enter your last name.';
        $errors[] = "name";
    }else{
        $nameArr = explode(" ", $checkFName);
        $fname = $nameArr[0];
        $lname = $nameArr[1];
    }


    // radio button selection for 'Size' 
    $checkSize = $_POST['pizzaSize'];
    switch ($checkSize) {
        case 'small':
            $price = 6;
            break;
        case 'medium':
            $price = 10;
            break;
        case 'large':
            $price = 12;
        default:
            break;
    }
    

    if(isset($_POST['addAnchovies'])){ 
        $checkedAnchovies = 'Y';
        if($checkSize == "small"){
            $price += 0.5;
        }else{
            $price += 1;
        }
    }else{ 
        $checkedAnchovies = 'N'; 
    }

    if(isset($_POST['addPineapple'])){ 
        $checkedPineapple = 'Y';
        if($checkSize == "small"){
            $price += 0.5;
        }else{
            $price += 1;
        }
    }else{ 
        $checkedPineapple = 'N'; 
    }

    if(isset($_POST['addPepperoni'])){ 
        $checkedPepperoni = 'Y';
        if($checkSize == "small"){
            $price += 0.5;
        }else{
            $price += 1;
        }
    }else{ 
        $checkedPepperoni = 'N'; 
    }

    if(isset($_POST['addOlives'])){ 
        $checkedOlives = 'Y';
        if($checkSize == "small"){
            $price += 0.5;
        }else{
            $price += 1;
        }
    }else{ 
        $checkedOlives = 'N'; 
    }

    if(isset($_POST['addOnion'])){ 
        $checkedOnion = 'Y';
        if($checkSize == "small"){
            $price += 0.5;
        }else{
            $price += 1;
        }
    }else{ 
        $checkedOnion = 'N'; 
    }

    if(isset($_POST['addPeppers'])){ 
        $checkedPeppers = 'Y';
        if($checkSize == "small"){
            $price += 0.5;
        }else{
            $price += 1;
        }
    }else{
        $checkedPeppers = 'N'; 
    }


    if(isset($_POST['student'])){ 
        $checkedStudent = 'Y';
        $price *= 0.9; // 10% student discount

    }else{ 
        $checkedStudent = 'N'; 
    }



    if(empty($errors))
    {

        $updateStatement = "UPDATE orders SET 
        order_id=?, firstname=?, lastname=?, email=?, student=?, address=?, phone=?, price=?, size=?, 
             anchovies=?, pinapples=?, pepperoni=?, olives=?, onion=?, peppers=?, createddatetime=?  WHERE order_id =?";

        if(!$stmt = $dbc->prepare($updateStatement)){
            echo "Prepare failed: (" . $dbc->errno . ") ". $dbc->error;
        }

        $mBindParam = $stmt->bind_param("ssssssidsssssssss", 
            $order_id, $fname, $lname, $email, $checkedStudent, $address, $phone, $price, $size, $checkedAnchovies,
                $checkedPineapple, $checkedPepperoni, $checkedOlives, $checkedOnion, $checkedPeppers, $createdDateTime, 
                     $hidden);

        if(!$mBindParam){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $createdDateTime = date('Y-m-d H:i:s');

        $result = $stmt->execute();




        // Using the 'result' of the query, we perform a conditional test. 
        // Either display the receipt, or print the error(s). 
        // Also, hide the form. The form can be accessed again from the link in the 'receipt'. 
        if($result){
            $ShowForm=FALSE;
            include('receipt.php');

         }else{
            echo '<h1>Register Error</h1>';
            echo '<p>MySQLi Error: ' . mysqli_error($dbc); 
         }



    mysqli_close($dbc);
        

    }else {
        echo 'Hello '. $returnedName . ' please check the following error(s): ';
        foreach($errors as $msg){
            echo "$msg | "; 
        }

    }

} // end $_SERVER['REQUEST_METHOD'] == 'POST'






// if 'delete' is clicked
if(isset($_POST['delete']))
{

    include('validate.php');

    $order_id =$_POST['order_id'];

    $deletePrepStatement = "DELETE from orders WHERE order_id=?";

    if(!$stmt = $dbc->prepare($deletePrepStatement)){
            echo "Prepare failed: (" . $dbc->errno . ") ". $dbc->error;
    }

    $mBindParam = $stmt->bind_param("s", $order_id);

    if(!$mBindParam){
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    
    $stmt->execute();



    // // This will redirect if user enters invalid URL,
   // but will also redirect when 'Update' is clicked

    // $id="";
    // $id = ($_GET['order_id']);

    if (isset($_GET['id'])) {

        // $subID =  substr($id, 1); // remove first char, the '?'

        //prepend '?' to variable, to match $_GET['order_id']
        $mOrderID = '?' . $retOrderID;


        if($id == $mOrderID){
            echo "<h1>ID equal: $id = $mOrderID</h1>";
        }else{

            echo "<h1>ID not: $id != $mOrderID</h1>";

            // header('Location: http://localhost/phpproj/brian_coveney/page-not-found.php');
            // exit;
        }
    }else{
        echo "EMPTY Id";
    }




    echo "DELETED!";

    $ShowForm = FALSE; 

    echo '<p><a href="order.php">Start Again?</a></p>';

}


if ($ShowForm===TRUE) {

?>
<h2 id="heading">Pizzas Order Form</h2>
<form id="pizza-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="mForm" method="post" novalidate>
    <h3>What Size of Pizza Would You Like? </h3>

    <span id="orderIDLabel">Your Order - </span><input name="order_id" id="orderID" type="text" value='<?php echo $retOrderID; ?>' readonly/><br/>
    <input name="hidden" id="order" type="hidden" value='<?php echo $retOrderID; ?>'/><br/>
 
    Small
    <input id="small" type="radio" name="pizzaSize" value="small" onChange="redraw()"
    <?php if($retSize === 'small') echo 'checked="checked"';?>/>
    Medium
    <input id="medium" type="radio" name="pizzaSize" value="medium" onChange="redraw()" 
    <?php if($retSize === 'medium') echo 'checked="checked"';?>/>
    Large
    <input id="large" type="radio" name="pizzaSize" value="large" onChange="redraw()"
    <?php if($retSize === 'large') echo 'checked="checked"';?>/>
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
   <input id="anchovies" type="checkbox" name="addAnchovies" value="yes" onChange="redraw()" 
   <?php if($returnedAnchovies === 'Y') echo 'checked="checked"';?>/>
    Pineapple
   <input id="pineapple" type="checkbox" name="addPineapple" value="yes" onChange="redraw()" 
    <?php if($retPineapple === 'Y') echo 'checked="checked"';?>/>
    Pepperoni
   <input id="pepperoni" type="checkbox" name="addPepperoni" value="yes" onChange="redraw()" 
   <?php if($retPepperoni === 'Y') echo 'checked="checked"';?>/>
    Olives
    <input id="olives" type="checkbox" name="addOlives" value="yes" onChange="redraw()" 
    <?php if($retOlives === 'Y') echo 'checked="checked"';?>/>
    Onion
    <input id="onion" type="checkbox" name="addOnion" value="yes" onChange="redraw()" 
    <?php if($retOnion === 'Y') echo 'checked="checked"';?>/>
    Peppers
    <input id="peppers" type="checkbox" name="addPeppers" value="yes" onChange="redraw()" 
    <?php if($retPeppers === 'Y') echo 'checked="checked"';?>/>

    <h3>Total Price is: €<span id="pricetext">18</span></h3>
    <input type="hidden" name="price" id="mPrice" value='<?php echo $retPrice; ?>'/>
    


    <h3>Enter your  details</h3>
    Name:
    <input name="firstname" id="cname" type="text" value='<?php echo $returnedName . " " . $retLastName; ?>'/>
    <span class="error"><?php echo $nameError;?></span>
    <input name="lastname" id="cname" type="hidden" value='<?php echo $retLastName; ?>'/>
    <br/>
    <br/>
    Address:
    <textarea name="address" id = "caddress" type="text"rows="5" cols="30"/><?php echo $retAddress;?></textarea>
    <span class="error"><?php echo $addressError;?></span>
    <br/>
    <br/>
    Email Address:
    <input name="email" type="email" value="<?php echo $retEmail; ?>"/><span class="error"><?php echo $emailError; ?></span> 
    <br/>
    <br/>
    <br/>
    Phone Number:
    <input name="phoneNo" id="phoneNumber" type="text" value="<?php echo $retPhoneNo; ?>"/><span class="error"><?php echo $phoneError; ?></span> 
	 <br/>
     <br/>
	Tick here if you are student:
    <input type="checkbox" id="studentdiscount" name="student" value="1" <?php if($retStudent === 'Y') echo 'checked="checked"';?> />
  <br/>
  <button type="submit" name="update" value="Update Order" >Update order</button>
  <button type="submit" name="delete" value="Delete Order" onclick="return confirm('Are you Sure?');">Delete Order</button>
</form>

<br/>
<?php } ?>
</body>
</html>