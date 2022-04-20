<?php
function loadOrders() {
	require('databaseHandler.php');
    require_once('order.php');
	$orderArray = array();
	$sql = "SELECT * FROM orderLog;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$obj = new Order($row['orderNum'], $row['date'], $row['user'], $row['total'], $row['current']);
			array_push($orderArray, $obj);
		}
	}
	return $orderArray;
}

function loadOrder($orderNum) {
	require('databaseHandler.php');
	require_once('items.php');
	$sql = "SELECT * FROM orderLog WHERE orderNum=$orderNum;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) {
		$row = mysqli_fetch_assoc($result);
		$fetchedOrder = new Order($row['orderNum'], $row['date'], $row['user'], $row['total'], $row['current']);
	}
	return $fetchedOrder;
}
