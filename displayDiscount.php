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
        <a class="logo" href="adminHome.php">Art Central</a>
    </div>


    <?php
        echo '<form method="post">',
            '<label for="code">Code:</label>',
            '<label type="text" id="code" name="code">'.$discount->getDiscountName().'</label><br><br>',
            '<label for="effect">Effect:</label>',
            '<input type="text" class="head" id="effect" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" name="effect" value="'.$discount->getDiscountEffect().'"><br><br>',
        
            '<input type="submit" name="delete"',
                'class="btn" value="Delete" />',
            '<input type="submit" name="applyChanges"',
                'class="btn" value="Apply Changes" />',      
            '</form>';

            if(isset($_POST['delete'])){
                deleteDiscount($discount->getDiscountName());
            }
            if(isset($_POST['applyChanges'])){
                //if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['picLoc']) && isset($_POST['qty']) && isset($_POST['description'])){
                    $discountEffect = $_POST['effect'];
                    $discountName = $discount->getDiscountName();
    
    
                   updateDiscount($discountName, $discountEffect);
               // }
            }
    ?>

</head>
</html>