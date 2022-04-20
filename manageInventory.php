<?php
    require_once'loaditems.php';
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="manageInventory.css" rel="stylesheet" />
    <div class="head">
        <a href="#default" class="logo">CompanyLogo</a>
        <button type="submit" onclick="location.href = 'adminHome.php';" >Home</button>
        <div class="header-right">
            <button type="submit">profile</button>
        </div>
    </div>
</head>
<body>
<button type="submit" onclick="location.href = 'createNewItem.php';" >Add New Item</button> 
    <table>
        <tr>
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Item Price</th>
            <th>Availability</th>
        </tr>
        <?php
            $itemArray = loadItems();
            foreach($itemArray as $item){
                echo '<tr>',
                '<td><a href="displayInventory.php?id='.$item->getID().'">'.$item->getID(). '</td>',
                '<td>'.$item->getName().'</td>',
                '<td>'.$item->getPrice().'</td>',
                '<td>'.$item->getStock().'</td>',
                '</tr>';
            }
        ?>
    </table>
</body>