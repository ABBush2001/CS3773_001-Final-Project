<?php
    require_once 'loadDiscounts.php';
    session_start();
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
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="manageDiscounts.css" rel="stylesheet" />
	<div class="head">
        <div class="header-right">
        <a class="btn" href="adminHome.php">Return</a>
        </div>
    </div>
</head>
<body>
<div class="block">
    <button class="btn" type="submit" onclick="location.href = 'createNewDiscount.php';">Create New Discount</button>
    <br><br>
    </div>
    <table>
        <tr>
            <th>Discount Code</th>
            <th>Effect</th>
        </tr>
        <?php
            $discountArray = loadDiscounts();
            foreach($discountArray as $discount){
                echo '<tr>',
                '<td><a href="displayDiscount.php?id='.$discount->getDiscountName().'" style="color: forestgreen;">'.$discount->getDiscountName(). '</td>',
                '<td>'.$discount->getDiscountEffect().'</td>',
                '</tr>';
            }
        ?>
    </table>
</body>
