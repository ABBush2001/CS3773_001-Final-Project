<?php
require_once 'userinstance.php';
require_once 'loadUser.php';

session_start();
$user=null;
if(isset($_SESSION['userID'])==FALSE)
{
  header("Location: index.php");
}else{
    $usr = $_SESSION['userID'];
	if($_SESSION['userID'] != "guest") {
		$user = loadUser($usr);
        if($user->getAdmin() != 1){
            header("Location: index.php");
        }
	}else{
		header("Location: index.php");
	}
}
?>
<!DOCTYPE html>
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="adminHome.css" rel="stylesheet" />
	<div class="head">
		<a href="adminHome.php" class="logo"><img src="images/ArtCentral.png" style="width:200px; height:auto; float: left;"></a>
        <div class="header-right">
        	<form method = "post">
			<input type ="submit" class="btn" name = "logout" value = "Log out"/>
		</form>
        </div>
    </div>
</head>
<body>
    <div class="container">
        <button class="imgBtn"> <img src="images/write.png" height="200" width="200" onclick="location.href = 'orderLogs.php';"/></button>
        <button class="imgBtn"> <img src="images/cart.png" height="200" width="200" onclick="location.href = 'manageInventory.php';"/></button>
        <button class="imgBtn"> <img src="images/sale.jpg" height="200" width="200" onclick="location.href = 'manageDiscounts.php';"/></button>
        <button class="imgBtn"> <img src="images/manage.jpg" height="200" width="200" onclick="location.href = 'manageUsers.php';"/></button>
    </div>
        <div class="labels">
        <a>Order Logs</a>
        <a>Inventory</a>
        <a>Discounts</a>
        <a>Users</a>
    </div>
    <br><br>
</body>
<?php
if(isset($_POST['logout'])){
    unset($_SESSION['userID']);
    unset($_POST['uname']);
    unset($_POST['psw']);
    header("Location: index.php");
}
