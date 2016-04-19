<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>Pizza</title>
  <link href="./Styles/main.css" rel="stylesheet" type="text/css">
<link href="main.css" rel="stylesheet" type="text/css">
</head>
<body>

    <!-- turing off html 5 validation ('novalidate') to test PHP  -->
    <h2 id="heading">Pizzas Order Form</h2>
    <form  id="pizza-form" onSubmit="return validateInput();" name="theform" method="post" action="vieworder.php" novalidate>
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
        First Name:
        <input name="firstname" id="cname" type="text"/>
        <br/>
        <br/>
        Address:
        <textarea name="address" id = "caddress" type="text"rows="5" cols="30" ></textarea>
        <br/>
        <br/>
        Email Address:
        <input name="email" type="email"  />
        <br/>
        <br/>
        <br/>
        Phone Number:
        <input name="phoneNo" id="phoneNumber" type="text" />
     <br/>
         <br/>
    Tick here if you are student:
        <input type="checkbox" id="studentdiscount" name="student" onChange="redraw()"/>
       
  
      <br/>
      <button type="submit" name="submit" value="Place Order" >Submit order</button>
    </form>

  
</body>
</html>