<?php
function createUser($usr, $first, $last, $pass, $email, $phone, $admin){
  require("databaseHandler.php");
  require('loadUser.php');
  $sql = "SELECT * FROM users WHERE userID='$usr';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
  //user exists
  echo '<script>alert("User exists")</script>';
  header("Location: register.php?signup=failure");
  }
  else{
  //create user
   //create the data for the user
    $sql = "INSERT INTO websiteDatabase.users (userID, firstName, lastName, password, email, phoneNumber,admin)
    VALUES('$usr', '$first', '$last', '$pass', '$email', $phone, $admin);";

    mysqli_query($conn,$sql);
    //logIN($usr, $pass);
    header('Location: logIn.php?signup=success');
    
  }

}

function createUserAdmin($usr, $first, $last, $pass, $email, $phone, $admin){
  require("databaseHandler.php");
  require('loadUser.php');
  $sql = "SELECT * FROM users WHERE userID='$usr';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
  //user exists
  echo '<script>alert("User exists")</script>';
  }
  else{
  //create user
   //create the data for the user
    $sql = "INSERT INTO websiteDatabase.users (userID, firstName, lastName, password, email, phoneNumber,admin)
    VALUES('$usr', '$first', '$last', '$pass', '$email', $phone, $admin);";

if ($conn->query($sql) === TRUE) {
  header("Location: manageUsers.php?accountCreated");
} else {
    echo "Error creating user: " . $conn->error;
}
  }

}

function updateUser($usr, $first, $last, $pass, $email, $phone, $admin){
  require("databaseHandler.php");
  $sql = "SELECT * FROM users WHERE userID='".$usr."';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
  //user exists
  echo "foundUser";
  $sql = "UPDATE users SET firstName = '".$first."', lastName = '".$last."', password='".$pass."', email='".$email."', phoneNumber=$phone , admin=$admin WHERE userID='".$usr."';";
  if ($conn->query($sql) === TRUE) {
    header("Location: manageUsers.php?accountUpdated");
  } else {
      echo "Error updating user: " . $conn->error;
  }
  }
  else{
    //changed user name
    $sql = "INSERT INTO websiteDatabase.users (userID, firstName, lastName, password, email, phoneNumber,admin)
    VALUES('$usr', '$first', '$last', '$pass', '$email', $phone, $admin);";

if ($conn->query($sql) === TRUE) {
  header("Location: manageUsers.php?UserUpdated");
} else {
    echo "Error creating user: " . $conn->error;
}
  }
}

function deleteUser($userID){
  require("databaseHandler.php");
  $sql = "DELETE FROM users WHERE userID ='".$userID."';";
  if ($conn->query($sql) === TRUE) {
	header("Location: manageUsers.php?DiscountDeleted");
  } else {
	  echo "Error deleting item: " . $conn->error;
  }
}
