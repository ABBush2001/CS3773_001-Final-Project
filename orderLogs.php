<?php
session_start();
require_once 'loadOrders.php';
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
$orderArray = loadOrders();
if($_GET['filters'] == "sortByDate"){
$_SESSION['tokenDate'] = ((isset($_SESSION['tokenDate'])) ? $_SESSION['tokenDate'] : 0);
}
if($_GET['filters'] == "sortByPrice"){
$_SESSION['tokenPrice'] = ((isset($_SESSION['tokenPrice'])) ? $_SESSION['tokenPrice'] : 0);
}
if($_GET['filters'] == "activeOrCanceled"){
$_SESSION['tokenStatus'] = ((isset($_SESSION['tokenStatus'])) ? $_SESSION['tokenStatus'] : 0);
}
if($_GET['filters'] == "sortByAlpha"){
$_SESSION['tokenName'] = ((isset($_SESSION['tokenName'])) ? $_SESSION['tokenName'] : 0);
}

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
            '<td>'.$order->getOrderNum().'</td>',
            '</tr>';
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
            '<td>'.$order->getOrderNum().'</td>',
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
            '<td>'.$order->getOrderNum().'</td>',
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
        <a class="btn" href="adminHome.php">Return</a>
        </div>
    </div>
</head>
<body>
    <div class="block">
    <form action="/orderLogs.php">
        <button type="submit" class="btn"><i class="fa fa-search"></i>Submit</button>
            <select class="table-filter" name="filters">
                <option value="noFilter">No filter selected</option>
                <option value="sortByDate" >Sort by Date</option>
                <option value="sortByAlpha">Sort by User</option>
                <option value="sortByPrice">Sort by Price</option>
                <option value="activeOrCanceled">Active/Canceled</option>
            </select>
            </form>
        <br><br>
        <br><br>
    </div>





    <table>
        <tr>
            <th>Date</th>
            <th>Customer Name</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Order Number</th>
        </tr>
        <?php
        //date button
        switch($_GET['filters']){
            case 'noFilter':
                /*
                $_SESSION['tokenDate']++;
                if($_SESSION['tokenDate']%2==0){
                    usort($orderArray, 'recentDate');
                    displayOrders($orderArray);
                }
                else if($_SESSION['tokenDate']%2==1){
                    usort($orderArray, 'oldestDate');
                    displayOrders($orderArray);
                }
                */
                displayOrders($orderArray);
                break;
            case 'sortByDate':
                $_SESSION['tokenDate']++;
                if($_SESSION['tokenDate']%2==0){
                    usort($orderArray, 'recentDate');
                    displayOrders($orderArray);
                }
                else if($_SESSION['tokenDate']%2==1){
                    usort($orderArray, 'oldestDate');
                    displayOrders($orderArray);
                }
                break;
            case 'sortByAlpha':
                $_SESSION['tokenName']++;
                if($_SESSION['tokenName']%2==0){
                    usort($orderArray, 'alphaOrder');
                    displayOrders($orderArray);
                }
                else if($_SESSION['tokenName']%2==1){
                    usort($orderArray, 'reverseAlphaOrder');
                    displayOrders($orderArray);
                }
                break;
            case 'sortByPrice':
                $_SESSION['tokenPrice']++;
                if($_SESSION['tokenPrice']%2==0){
                    usort($orderArray, 'HLprice');
                    displayOrders($orderArray);
                }
                else if($_SESSION['tokenPrice']%2==1){
                    usort($orderArray, 'LHprice');
                    displayOrders($orderArray);
                }
                break;
            case 'activeOrCanceled':
                $_SESSION['tokenStatus']++;
                if($_SESSION['tokenStatus']%2==0){
                    activeOrders($orderArray);
                }
                else if($_SESSION['tokenStatus']%2==1){
                    canceledOrders($orderArray);
                }
                break;
            default:
            /*
                $_SESSION['tokenDate']++;
                if($_SESSION['tokenDate']%2==0){
                    usort($orderArray, 'recentDate');
                    displayOrders($orderArray);
                }
                else if($_SESSION['tokenDate']%2==1){
                    usort($orderArray, 'oldestDate');
                    displayOrders($orderArray);
                }
                */
                displayOrders($orderArray);
                break;
        }
        ?>
    </table>
</body>
