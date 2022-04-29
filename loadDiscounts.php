<?php
function loadDiscounts() {
	require('databaseHandler.php');
	require_once('discount.php');
	$discountArray = array();
	$sql = "SELECT * FROM Coupons;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$obj = new Discount($row['code'], $row['discount']);
			array_push($discountArray, $obj);
		}
	}
	return $discountArray;
}

function loadDiscount($code) {
	require('databaseHandler.php');
	require_once('discount.php');
	$sql = "SELECT * FROM Coupons WHERE code='".$code."';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0) {
		$row = mysqli_fetch_assoc($result);
		$fetchedDiscount = new Discount($row['code'], $row['discount']);
	}else{
		return FALSE;
	}
	return $fetchedDiscount;
}
