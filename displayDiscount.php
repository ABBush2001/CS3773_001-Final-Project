<?php
    require_once 'loadDiscounts.php';
    require_once 'discount.php';

    session_start();
    $discount = loadDiscount($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="displayDiscount.css">

    <div class="topnav">
        <a class="active" onclick="location.href = 'adminHome.php';">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <input type="text" placeholder="Search..">
        <a href="LoggingInPage.html">
            <img src="login.png" width="25" height="25" style="right:50px;" />
        </a>
    </div>
</head>
<body>
    <?php
        echo '<form method="post">',
            '<label for="code">Code:</label>',
            '<label type="text" id="code" name="code">'.$discount->getDiscountName().'</label><br><br>',
            '<label for="effect">Effect:</label>',
            '<input type="text" id="effect" name="effect" value="'.$discount->getDiscountEffect().'"><br><br>',
        
            '<input type="submit" name="delete"',
                'class="button" value="Delete" />',
            '<input type="submit" name="applyChanges"',
                'class="button" value="Apply Changes" />',      
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

</body>
</html>