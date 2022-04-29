<?php
require_once 'userLogin.php';
session_start();
?>
<!DOCTYPE html>
<form action="logIn.php" method="post">
    <head>
        <title>Items Display</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="logIn.css" rel="stylesheet" />
    </head>
    <div class="imgcontainer">
        <img src="images/userImage.png" alt="Avatar" class="avatar">
    </div>

    <div class="block">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" id="uname" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <button type="submit" onclick=
        <?php
          if(isset($_POST['uname']) && isset($_POST['psw'])) {
            $username = $_POST['uname'];
            $password = $_POST['psw'];
        	logIN($username, $password);
          }
          unset($_POST['uname']);
          unset($_POST['psw']);
        ?>>Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" onclick="history.back()" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="recover.php">password?</a></span>
        <span class="register"><a href="register.php">Register Account </a></span>

    </div>
</form>
