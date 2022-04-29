<?php
session_start();
require_once 'loadOrders.php';
require_once 'userinstance.php';
require_once 'loadUser.php';
require_once 'loaditems.php';
require_once 'products.php';
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
$orderArray = loadOrdersByUser($user->getUName());
$_SESSION['tokenDate'] = ((isset($_SESSION['tokenDate'])) ? $_SESSION['tokenDate'] : 0);
$_SESSION['tokenPrice'] = ((isset($_SESSION['tokenPrice'])) ? $_SESSION['tokenPrice'] : 0);
$_SESSION['tokenStatus'] = ((isset($_SESSION['tokenStatus'])) ? $_SESSION['tokenStatus'] : 0);
$_SESSION['tokenName'] = ((isset($_SESSION['tokenName'])) ? $_SESSION['tokenName'] : 0);


//high to low
function HLprice($log1, $log2){
    return $log1->getTotal() < $log2->getTotal();
}
//low to high
function LHprice($log1, $log2){
    return $log1->getTotal() > $log2->getTotal();
}
//alphabetic order
function alphaOrder($log1, $log2){
    return $log1->getUser() > $log2->getUser();
}
function reverseAlphaOrder($log1, $log2){
    return $log1->getUser() < $log2->getUser();
}
//oldest order
function oldestDate($log1, $log2){
    return $log1->getOrderNum() > $log2->getOrderNum();
}
//recent orders
function recentDate($log1, $log2){
    return $log1->getOrderNum() < $log2->getOrderNum();
}

function activeOrders($orderArray){
    foreach($orderArray as $order){
        if($order->getCurrent()=="ACTIVE"){
            echo '<tr>',
            '<td>'. $order->getDate() . '</td>',
            '<td>'.$order->getUser().'</td>',
            '<td>'.$order->getTotal().'</td>',
            '<td>'.$order->getCurrent().'</td>',
            '<td><a href="userOrderLogs.php?id='.$order->getOrderNum().'">'.$order->getOrderNum().'</td>',
            '<td><form method = "post">
                  <input type="submit" class="btn" name="cancel'.$order->getOrderNum().'" value= "Cancel"></input>
              </form></td>',

            '</tr>';
            if(array_key_exists('cancel'.$order->getOrderNum().'', $_POST)){
              # connect to database, request change active to canceled
              cancelOrder($order->getOrderNum());
			        $itemS = $order->getCart();
			        $itemArray = explode("-", $itemS);
			        foreach($itemArray as $item){
				        $item = loadItem($item);
				        updateProducts($item->getID(), $item->getName(), $item->getPrice(), $item->getImg(), $item->getStock()+1, $item->getDescription());
                header("Refresh:0");
              }
        }
    }

}
}

function canceledOrders($orderArray){
    foreach($orderArray as $order){
        if($order->getCurrent()=="CANCELED"){
            echo '<tr>',
            '<td>'. $order->getDate() . '</td>',
            '<td>'.$order->getUser().'</td>',
            '<td>'.$order->getTotal().'</td>',
            '<td>'.$order->getCurrent().'</td>',
			'<td><a href="userOrderLogs.php?id='.$order->getOrderNum().'">'.$order->getOrderNum().'</td>',
            '</tr>';
        }
    }
}


function displayOrders($orderArray){
    foreach($orderArray as $order){
        echo '<tr>',
            '<td>'. $order->getDate() . '</td>',
            '<td>'.$order->getUser().'</td>',
            '<td>'.$order->getTotal().'</td>',
            '<td>'.$order->getCurrent().'</td>',
            '<td><a href="'.$order->getOrderNum().'">'.$order->getOrderNum().'</td>',
            '</tr>';
        }
}
?>
<!DOCTYPE html>
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="orderLogs.css" rel="stylesheet" />
    <div class="head">
        <div class="header-right">
        <a class="btn" href="index.php">Return</a>
        </div>
    </div>
    
</head>
<body>
    <div class="block" style="text-align:center;">
        <a style="font-size:35px; font-family: Arial;">Orders</a>
    </div>
    <div class="table" style="text-align:center;">
    <table>
        <tr>
            <th stlye="font-family: Arial">Date</th>
            <th stlye="font-family: Arial">Customer Name</th>
            <th stlye="font-family: Arial">Total Price</th>
            <th stlye="font-family: Arial">Status</th>
            <th stlye="font-family: Arial">Order Number</th>
        </tr>
        <?php
          activeOrders($orderArray);
          canceledOrders($orderArray);
        ?>
    </table>
    </div>
	<?php
		if(isset($_GET['id'])){
			$order = loadOrder($_GET['id']);
			$itemString = $order->getCart();
			echo '<script>console.log("'.$itemString.'");</script>';
			$itemArray = explode("-", $itemString);
			foreach($itemArray as $item){
				echo '<script>console.log("'.$item.'");</script>';
				$item = loadItem($item);
				echo '<td><a href= "productPage.php?id='.$item->getID().'"> <img src="' . $item->getImg() . '" width=10%; height=auto;></img></a></td>';
			}

		}
	?>
    <div class="head">
        <a class="table" style="font-family: Arial;"><?php echo "Logged in as: ".$user->getUName() ?></a>
    </div>
</body>
