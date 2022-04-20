<?php
    require_once'loadDiscounts.php';
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="manageDiscounts.css" rel="stylesheet" />
    <div class="head">
        <a href="#default" class="logo">CompanyLogo</a>
        <button type="submit" onclick="location.href = 'adminHome.php';">Home</button>
        <div class="header-right">
            <button type="submit">profile</button>
        </div>
    </div>
</head>
<body>
    <button type="submit" onclick="location.href = 'createNewDiscount.php';">Create New Discount</button>
    <table>
        <tr>
            <th>Discount Code</th>
            <th>Effect</th>
        </tr>
        <?php
            $discountArray = loadDiscounts();
            foreach($discountArray as $discount){
                echo '<tr>',
                '<td><a href="displayDiscount.php?id='.$discount->getDiscountName().'">'.$discount->getDiscountName(). '</td>',
                '<td>'.$discount->getDiscountEffect().'</td>',
                '</tr>';
            }
        ?>
    </table>
</body>