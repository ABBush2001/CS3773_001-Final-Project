<?php
    require_once 'loaditems.php';
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
    <link href="manageInventory.css" rel="stylesheet" />
	<div class="head">
        <div class="header-right">
        <a class="btn" href="adminHome.php">Return</a>
        </div>
    </div>
</head>
<body>
	<div class="block">
		<button type="submit" class="btn" onclick="location.href = 'createNewItem.php';" >Add New Item</button>
		<br><br>
	</div>
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
                '<td><a href="displayInventory.php?id='.$item->getID().'"style="color: forestgreen;">'.$item->getID(). '</td>',
                '<td>'.$item->getName().'</td>',
                '<td>'.$item->getPrice().'</td>',
                '<td>'.$item->getStock().'</td>',
                '</tr>';
            }
        ?>
    </table>
</body>
