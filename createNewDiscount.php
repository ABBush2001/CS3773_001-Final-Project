<?php
    require_once 'loadDiscounts.php';
    require_once 'discount.php';

    session_start();
    $discount = loadDiscount($_GET['id']);
    require_once 'userinstance.php';
require_once 'loadUser.php';
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
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="displayDiscount.css">

        <div class="head">
        <a class= "logo" href="adminHome.php">Art Central</a>
    </div>
</head>
<body>
    <?php
        echo '<form method="post">',
            '<label for="code">Code:</label>',
            '<input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="code" name="code"><br><br>',
            '<label for="effect">Effect:</label>',
            '<input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="effect" name="effect"><br><br>',
        
            '<input type="submit" name="applyChanges"',
                'class="btn" value="Create" /><br><br>',      
            '</form>';

            if(isset($_POST['applyChanges'])){
                //if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['picLoc']) && isset($_POST['qty']) && isset($_POST['description'])){
                    $discountEffect = $_POST['effect'];
                    $discountName = $_POST['code'];
    
    
                   createDiscount($discountName, $discountEffect);
               // }
            }
    ?>

</body>
</html>