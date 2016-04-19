<?php 


    require_once('mysqli_connect.php');
    include('vieworder.php');

    $SQLString = "SELECT * FROM orders";
    $result = mysqli_query($dbc, $SQLString);




   

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
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
    } else {
            echo "0 results";
    }


?>
<h2 id="heading">Pizzas Order Form</h2>
    <form action="vieworder.php"  method="post" novalidate>
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
        <input name="firstname" id="cname" type="text" value='<?php echo $retFirstName; ?>'/><span class="error"><?php echo $nameError;?></span>
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
      <button type="submit" name="submit" value="Place Order" >Submit order</button>
    </form>

    <?php

?>
