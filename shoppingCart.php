<?php
require_once 'loaditems.php';
require_once 'userinstance.php';
require_once 'items.php';
require_once 'checkOut.php';
require_once 'loadUser.php';
require_once 'loadDiscounts.php';
session_start();
$user=null;

if(isset($_SESSION['userID'])==FALSE && $_SESSION['userID']  != "guest")
{
  $user = new UserInstance("guest","guest","guest","none","none","none",0);
  $_SESSION['userID'] = $user->getUName();
}else{
  $usr = $_SESSION['userID'];
  if($_SESSION['userID'] != "guest") {
    $user = loadUser($usr);
    if($user->getAdmin() == 1){
      header("Location: adminHome.php");
    }
  }else{
    $user = new UserInstance("guest","guest","guest","none","none","none",0);
  }
}
if(isset($_SESSION['discountList']) == FALSE)
{
  $discountArray = array();
  $_SESSION['discountList'] = $discountArray;
}
if(isset($_SESSION['usedDiscounts']) == FALSE)
{
  $usedDiscounts = array();
  $_SESSION['usedDiscounts'] = $usedDiscounts;
}
if(isset($_SESSION['cart'])==FALSE)
{
  $cart = array();
  $_SESSION['cart'] = $cart;
}

if(array_key_exists('apply', $_POST)){
  if(isset($_POST['discount'])) {
    $discount = $_POST['discount'];
    if(in_array($discount, $_SESSION['usedDiscounts']) || strlen($discount) < 1 || loadDiscount($discount) == FALSE){
      echo '<div class="alert alert-warning alert-dismissible">
      <a href="shoppingCart.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Warning!</strong> Invalid code.
      </div>';
    }else{
      $discount = loadDiscount($discount);
      array_push($_SESSION['discountList'], $discount->getDiscountEffect());
      array_push($_SESSION['usedDiscounts'], $discount->getDiscountName());
      header("Refresh:0");
    }
  }
}

function deleteItem($item){
  foreach($_SESSION['cart'] as $i){
    if(($key = array_search($item, $_SESSION['cart'], FALSE)) !== FALSE){
      unset($_SESSION['cart'][$key]);
    }
  }

}

function logOrder($total, $user, $cart) {
  require("databaseHandler.php");

  $sql = "INSERT INTO websiteDatabase.orderLog (orderNum, date, user, total, current, cart)
  VALUES(NULL, '".date("Y-m-d")."','".$user->getUName()."', $total, 1, '".$cart."');";

  mysqli_query($conn, $sql);

}

function displayItem($item, $quantity) {
  echo "<table class=\"Cart-Items\">
  <tr><div class=\"image-box\">
  <img src=".$item->getImg()." style={{ height=\"120px\" }} />
  </div>
  <div class=\"about\">
  <h1 class=\"amount\">".$item->getName()."</h1>
  </div>
  <div class=\"counter\">
  <form method = \"post\">
  <input type=\"submit\" style=\"
  display:inline-block;
  padding:0.3em 1.2em;
  margin:0 0.3em 0.3em 0;
  border-radius:2em;
  box-sizing: border-box;
  text-decoration:none;font-family:'Roboto',sans-serif;
  font-weight:300;
  color:#FFFFFF;
  background-color:#4eb5f1;
  text-align:center;
  transition: all 0.2s;
  \" name= \"".$item->getID()."_minus\" value=\"-\"/>
  </form>

  <div class=\"count\" style=\"tab-size: 4;x\">".$quantity."</div>

  <form method = \"post\">
  <input type=\"submit\" style=\"
  display:inline-block;
  padding:0.3em 1.2em;
  margin:0 0.3em 0.3em 0;
  border-radius:2em;
  box-sizing: border-box;
  text-decoration:none;font-family:'Roboto',sans-serif;
  font-weight:300;
  color:#FFFFFF;
  background-color:#4eb5f1;
  text-align:center;
  transition: all 0.2s;
  \" name= \"".$item->getID()."_plus\" value=\"+\"/>
  </form>
  </div>
  <div class=\"prices\">
  <div class=\"amount\">$".$item->getPrice()."</div>
  <form method = \"post\">
  <input type=\"submit\" name= ".$item->getID()." class =\"buttion\" value=\"Remove\"/>
  </form>
  </div></tr>
  </table>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Shopping Cart</title>
  <link href="shoppingCart.css" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <link rel="stylesheet" href="CSS\shoppingCart.css">
</head>

<div class="Header">
  <h3 class="Heading">Shopping Cart</h3>
</div>
<div class="menu" >
  <a href="index.php" style="font-size:10px">HOME</a>
</div>
<div class="container">
  <form method = "post">
    <input type="submit" class="Action" name="removeAll" value= "Clear cart"></input>
  </form>
  <?php
  if(array_key_exists('removeAll', $_POST)){
    unset($_SESSION['cart']);
    header("Refresh:0");
  }
  ?>
  <form method = "post">
    <input type="submit" class="Action" name="removeDiscounts" value= "Clear discounts"></input>
  </form>
  <?php
  if(array_key_exists('removeDiscounts', $_POST)){
    unset($_SESSION['discountList']);
    unset($_SESSION['usedDiscounts']);
    header("Refresh:0");
  }
  ?>
</div>

<hr>
<?php
$itemArray = $_SESSION['cart'];
$result = $_SESSION['cart'];
$cartString = "";
$idArray = array();
foreach($itemArray as $item) {
  array_push($idArray, $item->getID());
}
$quantity = array_count_values($idArray);
if(array_key_exists('checkoutBtn', $_POST)) {
  if($user->getUName() != "guest"){
    $subtotal=0;
    foreach($itemArray as $item) {
      $subtotal = $subtotal + $item->getPrice();
    }
    $discountTotal = 0;
    foreach($_SESSION['discountList'] as $usrDiscount) {
      $discountTotal += $subtotal - ($subtotal * $usrDiscount);
    }
    $postDiscountSubtotal = $subtotal - $discountTotal;
    $taxTotal = (0.0825*$postDiscountSubtotal);
    $taxTotal = number_format($taxTotal, 2, '.', '');
    $total = number_format($postDiscountSubtotal + $taxTotal, 2, '.', '');
    foreach($result as $item) {
      checkOut($item, $quantity[$item->getID()]);
      foreach($_SESSION['cart'] as $i){
        if(($key = array_search($item, $_SESSION['cart'], FALSE)) !== FALSE){
          $cartString .= $i->getID()."-";
          unset($itemArray);
          unset($_SESSION['cart'][$key]);

        }
      }

    }
    logOrder($total, $user, $cartString);
    unset($_SESSION['discountList']);
    unset($_SESSION['usedDiscounts']);

}else {
  echo '<div class="alert alert-warning alert-dismissible">
  <a href="shoppingCart.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Warning!</strong> You must login before checking out.
  </div>';
}
}

$result= array_unique($result, SORT_REGULAR);

if($itemArray){
  foreach($result as $item){
    if(array_key_exists($item->getID(), $_POST)){
      deleteItem($item);
      header("Refresh:0");
    }
    if(array_key_exists($item->getID()."_minus", $_POST)){
      $key = array_search($item, $_SESSION['cart'], FALSE);
      unset($_SESSION['cart'][$key]);

      header("Refresh:0");
    }
    if(array_key_exists($item->getID()."_plus", $_POST)){
      if($quantity[$item->getID()] < $item->getStock()){
        array_push($_SESSION['cart'], $item);
        header("Refresh:0");
      }else{
        echo '<div class="alert alert-warning alert-dismissible">
        <a href="shoppingCart.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Unable to add quantity: Exceeds stock availability.
        </div>';
      }
    }

  }
  foreach($result as $item) {
    displayItem($item, $quantity[$item->getID()]);
  }
}else{
  echo '<p class=\"center\">The shopping cart is empty.</p>';
}
//echo '<script>console.log("'.$item.'");</script>';


?>
<hr>
<div class="checkout">
  <div class="pricing">
    <div>
      <div class="Subtotal-title">Sub-Total</div>
    </div>
    <div class="Subtotal-amount">$<?php
    $subtotal=0;
    foreach($itemArray as $item) {
      $subtotal = $subtotal + $item->getPrice();
    }
    echo "$subtotal";
    ?></div>
  </div>
  <div class="pricing">
    <div>
      <div class="Subtotal-title">Discount</div>
    </div>
    <div class="Subtotal-amount">$<?php
    $discountTotal = 0;
    foreach($_SESSION['discountList'] as $usrDiscount) {
      $discountTotal += $subtotal - ($subtotal * $usrDiscount);
    }
    $postDiscountSubtotal = $subtotal - $discountTotal;

    echo "".$discountTotal."";
    ?></div>
  </div>
  <div class="pricing">
    <?php foreach($_SESSION['discountList'] as $discountPercent) { $discountPercent=$discountPercent*100; echo "<div class=\"Subtotal-amount\">$discountPercent% OFF</div>";}?>

    <form method = "post">
      <input type="text" placeholder="Enter Discount Code" name="discount" id="discount">
      <input type="submit" name="apply" class="registerbtn" value="Apply"/>
    </form>

  </div>
  <div class="pricing">
    <div>
      <div class="Subtotal-title">Tax</div>
    </div>
    <div class="Subtotal-amount">$<?php
    $taxTotal = (0.0825*$postDiscountSubtotal);
    $taxTotal = number_format($taxTotal, 2, '.', '');
    echo "$taxTotal";
    ?></div>
  </div>

</div>
<hr>
<div class="checkout">
  <div class="pricing">
    <div>
      <div class="Total-title">Total: </div>
    </div>
    <div class="Total-amount">$<?php
    $total = number_format($postDiscountSubtotal + $taxTotal, 2, '.', '');
    echo "$total";
    ?></div>
    <form method = "post" action="shoppingCart.php">
      <input type="submit" id="checkoutBtn" name="checkoutBtn" class="button" value="Checkout"/>
    </form>

  </div>
  </html>
