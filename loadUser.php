<?php
function loadUser($user_id) {
	require('databaseHandler.php');
	require_once('userinstance.php');
	$sql = "SELECT * FROM users WHERE userID='$user_id';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	$fetchedUser = null;
	if($resultCheck > 0) {
		$row = mysqli_fetch_assoc($result);

		$fetchedUser = new UserInstance($row['userID'], $row['firstName'], $row['lastName'], $row['password'], $row['email'], $row['phoneNumber'], $row['admin']);
	}
	return $fetchedUser;
}

function loadUsers(){
	require('databaseHandler.php');
    require_once('userinstance.php');
	$userArray = array();
	$sql = "SELECT * FROM users;";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			$obj = new UserInstance($row['userID'], $row['firstName'], $row['lastName'], $row['password'], $row['email'], $row['phoneNumber'], $row['admin']);
			array_push($userArray, $obj);
		}
	}
	return $userArray;
}

?>
