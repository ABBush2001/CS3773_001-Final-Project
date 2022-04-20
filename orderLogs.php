<?php
session_start();
require_once 'loadOrders.php';
$orderArray = loadOrders();
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
        <a href="#default" class="logo" >CompanyLogo</a>
        <button type="submit" onclick="location.href = 'adminHome.php';" >Home</button>
        <div class="header-right">
            <button type="submit">profile</button>
        </div>
    </div>
</head>
<body>
    <form method="post">
    <input type="submit" name="sortByDate"
                class="button" value="Sort by Date" />
    <input type="submit" name="sortByAlpha"
                class="button" value="Sort by User" />      
    <input type="submit" name="sortByPrice"
                class="button" value="Sort by Price" />
    <input type="submit" name="activeOrCanceled"
                class="button" value="Active/Canceled" />
    </form>
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
        if(isset($_POST['sortByDate'])) {
            $_SESSION['tokenDate']++; 
            if($_SESSION['tokenDate']%2==0){
                usort($orderArray, 'recentDate');
                displayOrders($orderArray);
            }
            else if($_SESSION['tokenDate']%2==1){
                usort($orderArray, 'oldestDate');
                displayOrders($orderArray);
            }
        }
        //name button
        if(isset($_POST['sortByAlpha'])) {
            $_SESSION['tokenName']++; 
            if($_SESSION['tokenName']%2==0){
                usort($orderArray, 'alphaOrder');
                displayOrders($orderArray);
            }
            else if($_SESSION['tokenName']%2==1){
                usort($orderArray, 'reverseAlphaOrder');
                displayOrders($orderArray);
            }
        }
        //price button
        if(isset($_POST['sortByPrice'])) {
            $_SESSION['tokenPrice']++; 
            if($_SESSION['tokenPrice']%2==0){
                usort($orderArray, 'HLprice');
                displayOrders($orderArray);
            }
            else if($_SESSION['tokenPrice']%2==1){
                usort($orderArray, 'LHprice');
                displayOrders($orderArray);
            }
        }
        //status button
        if(isset($_POST['activeOrCanceled'])) {
            $_SESSION['tokenStatus']++; 
            if($_SESSION['tokenStatus']%2==0){
                activeOrders($orderArray);
            }
            else if($_SESSION['tokenStatus']%2==1){
                canceledOrders($orderArray);
            }
        }
        ?>
    </table>
</body>