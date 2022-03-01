<?php
function loadItems() {
	require("databaseHandler.php");
	require('items.php');
	$itemArray = array();
	$sql = "SELECT * FROM items;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$obj = new Item($row['itemID'], $row['itemName'], $row['itemPrice'], $row['picLoc'], $row['availability'], $row['description']);
			array_push($itemArray, $obj);
		}
	}
	return $itemArray;
}
?>
