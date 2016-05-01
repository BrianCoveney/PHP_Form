<?php 

$ShowForm=TRUE;

require('mysqli_connect.php');


// fetch data from the DB for the form below
$SQLString = "SELECT * FROM orders";
$r = mysqli_query($dbc, $SQLString);

if (mysqli_num_rows($r) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($r)) {

        $retOrderID = $row["order_id"];
        $returnedName = $row["firstname"];
        $retEmail = $row['email'];
        $retAddress = $row['address'];
        $retPhoneNo = $row['phone'];
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
        echo "0 results";
}




// if 'update' is clicked
if(isset($_POST['update']))
{

    include('validate.php');

    $order_id =$_POST['order_id'];
    $hidden = $_POST['hidden'];
    $name = $_POST['firstname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phoneNo'];
    $size = $_POST['pizzaSize'];


    if(isset($_POST['student'])){ $checkedStudent = 'Y';
    }else{ $checkedStudent = 'N'; }

    if(isset($_POST['addAnchovies'])){ $checkedAnchovies = 'Y';
    }else{ $checkedAnchovies = 'N'; }

    if(isset($_POST['addPineapple'])){ $checkedPineapple = 'Y';
    }else{ $checkedPineapple = 'N'; }

    if(isset($_POST['addPepperoni'])){ $checkedPepperoni = 'Y';
    }else{ $checkedPepperoni = 'N'; }

    if(isset($_POST['addOlives'])){ $checkedOlives = 'Y';
    }else{ $checkedOlives = 'N'; }

    if(isset($_POST['addOnion'])){ $checkedOnion = 'Y';
    }else{ $checkedOnion = 'N'; }

    if(isset($_POST['addPeppers'])){ $checkedPeppers = 'Y';
    }else{ $checkedPeppers = 'N'; }



    if(empty($errors))
    {

        $updateStatement = "UPDATE orders SET  order_id=?, firstname=?, email=?, address=?, phone=?, size=?, 
            student=?, anchovies=?, pinapples=?, pepperoni=?, olives=?, onion=?, peppers=? WHERE order_id =?";

        if(!$stmt = $dbc->prepare($updateStatement)){
            echo "Prepare failed: (" . $dbc->errno . ") ". $dbc->error;
        }

        $mBindParam = $stmt->bind_param("ssssisssssssss", $order_id,
            $name, $email, $address, $phone, $size, $checkedStudent, $checkedAnchovies,
                $checkedPineapple, $checkedPepperoni, $checkedOlives, $checkedOnion, $checkedPeppers, $hidden);

        if(!$mBindParam){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }


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




if ($ShowForm===TRUE) {
?>
<h2 id="heading">Pizzas Order Form</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
    <h3>What Size of Pizza Would You Like? </h3>

    <input name="order_id" id="order" type="text" value='<?php echo $retOrderID; ?>'/><br/>
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


    <h3>Enter your  details</h3>
    First Name:
    <input name="firstname" id="cname" type="text" value='<?php echo $returnedName; ?>'/>
    <br/>
    <br/>
    Address:
    <textarea name="address" id = "caddress" type="text"rows="5" cols="30"/><?php echo $retAddress;?></textarea>
    <span class="error"> 
    <br/>
    <br/>
    Email Address:
    <input name="email" type="email" value="<?php echo $retEmail; ?>"/> 
    <br/>
    <br/>
    <br/>
    Phone Number:
    <input name="phoneNo" id="phoneNumber" type="text" value="<?php echo $retPhoneNo; ?>"/> 
	 <br/>
     <br/>
	Tick here if you are student:

    <input type="checkbox" id="studentdiscount" name="student" value="1" <?php if($retStudent === 'Y') echo 'checked="checked"';?> />
    
  <br/>
  <button type="submit" name="update" value="Place Order" >Update order</button>
</form>

<br/>


<?php

}


?>
