<?php
session_start();
function logIN($username, $password){
    require('databaseHandler.php');
    require('loadUser.php');

    $sql = "SELECT * FROM users WHERE userID='$username';";
    $result = mysqli_query($conn, $sql);
    //$login = loadUser($username);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0) {
		$row = mysqli_fetch_assoc($result);
	}

    if($row['password'] == $password && $row['userID'] == $username){
		$user = loadUser($username);
        $_SESSION['userID'] = $user->getUName();
        if($user->getAdmin() == 1){
            header('Location: adminHome.php');
        }
        else{
            header('Location: index.php');
        }
    }else {
        header("Location: logIn.php?error=Incorrect User name or password $username $password");
    }

}


?>
