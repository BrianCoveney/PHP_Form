<?php 


require_once('mysqli_connect.php');

// if 'update' is clicked
if(isset($_POST['update']))
{

    include('validate.php');

    $orderID =$_POST['order_id'];
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

        $updateStatement = "UPDATE orders SET 
            order_id=?, 
            firstname=?, 
            email=?, 
            address=?, 
            phone=?, 
            size=?, 
            student=?, 
            anchovies=?, 
            pinapples=?, 
            pepperoni=?, 
            olives=?, 
            onion=?, 
            peppers=? 
            WHERE order_id =?";

        if(!$stmt = $dbc->prepare($updateStatement)){
            echo "Prepare failed: (" . $dbc->errno . ") ". $dbc->error;
        }

        $mBindParam = $stmt->bind_param("sssssissssssss", $orderID, 
            $name, $email, $address, $phone, $size, $checkedStudent, $checkedAnchovies,
                $checkedPineapple, $checkedPepperoni, $checkedOlives, $checkedOnion, $checkedPeppers, $hidden);

        if(!$mBindParam){
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        $stmt->execute();


        if(mysqli_query($dbc, $SQLUpdateString)){
             echo "<h2>Update Success</h2>";
        }else{
               echo "update fail " . mysqli_error($dbc); 
        }

    }else {
        echo 'Hello '. $returnedName . ' please check the following error(s): ';
        foreach($errors as $msg){
            echo "$msg | "; 
        }

    }

}



$SQLString = "SELECT * FROM orders";
$result = mysqli_query($dbc, $SQLString);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_array($result)) {

        $retOrderID = $row["order_id"];
        $retFirstName = $row["firstname"];
        $retEmail = $row['email'];
        $retAddress = $row['address'];
        $retPhoneNo = $row['phone'];
        $retStudent = $row['student'];
        $retAnchovies = $row['anchovies'];
        $retPineapple = $row['pinapples'];
        $retPepperoni = $row['pepperoni'];
        $retOlives = $row['olives'];
        $retOnion = $row['onion'];
        $retPeppers = $row['peppers'];

    }
mysqli_close($dbc);

} else {
        echo "0 results";
}

?>
<h2 id="heading">Pizzas Order Form</h2>
<form action="updateorder.php"  method="post" novalidate>
    <h3>What Size of Pizza Would You Like? </h3>

    <input name="order_id" id="order" type="text" value='<?php echo $retOrderID; ?>'/><br/>
    <input name="hidden" id="order" type="hidden" value='<?php echo $retOrderID; ?>'/><br/>
 
    Small
    <input id="small" type="radio" name="pizzaSize" value="small" onChange="redraw()"/>
    Medium
    <input id="medium" type="radio" name="pizzaSize" value="medium" onChange="redraw()" />
    Large
    <input id="large" type="radio" name="pizzaSize" value="large" onChange="redraw()" checked/>


  <br>
  <h3>Add Extra Toppings</h3>

    Anchovies
   <input id="anchovies" type="checkbox" name="addAnchovies" value="yes" onChange="redraw()"
   <?php if($retAnchovies === 'Y') echo 'checked="checked"';?>/>
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
    <input name="firstname" id="cname" type="text" value='<?php echo $retFirstName; ?>'/>
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

// echo "<a href=\"receipt.php?ReportID=" . 
//                          $retOrderID . "\">View Changed Order</a></td>";
//     mysqli_close($dbc);


?>
