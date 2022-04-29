<?php
include_once 'createUser.php';
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
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="displayUser.css">

    <div class="head">
        <a class="logo" href="adminHome.php">Art Central</a>
    </div>
</head>
<body>
    <form method="post">
    <label for="username">Username:</label>
    <input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="username" name="username"><br><br>
    <label for="fName">First Name:</label>
    <input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="fName" name="fName"><br><br>
    <label for="lName">Last Name:</label>
    <input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="lName" name="lName"><br><br>
    <label for="pass">Password:</label>
    <input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="pass" name="pass"><br><br>
    <label for="email">Email:</label>
    <input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="email" name="email"><br><br>
    <label for="phone">Phone Number:</label>
    <input type="text" style="background-color: #DDE5B6; color: #6C584C; border: 3px solid #6C584C;" id="phone" name="phone"><br><br>
    <input type="checkbox" id="admin" name="admin" value="isAdmin">
    <label for="admin"> Admin?</label>
    <br>
    <button type="submit" class="btn" onclick=
    <?php
        //function_alert("testing out method");
          if(isset($_POST['fName']) && isset($_POST['lName']) && isset($_POST['pass'])
           && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['phone'])) {
           $username = $_POST['username'];
           $password = $_POST['pass'];
           $first = $_POST['fName'];
           $last = $_POST['lName'];
           $email = $_POST['email'];
           $phone = $_POST['phone'];
           if(isset($_POST['admin'])){
                $admin = 1;
           }
           else{
               $admin = 0;
           }
            createUserAdmin($username, $first, $last, $password, $email, $phone,$admin);
          }
          unset($_POST['fName']);
          unset($_POST['lName']);
          unset($_POST['email']);
          unset($_POST['username']);
          unset($_POST['pass']);
          unset($_POST['phone']);
          unset($_POST['admin']);


        ?>>Create</button><br><br>
    </form>
</body>
</html>
