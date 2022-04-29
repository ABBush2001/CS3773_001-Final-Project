<?php
include_once 'createUser.php';
include_once 'alert.php';
session_start();

?>
<!DOCTYPE html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="register.css" rel="stylesheet" />
</head>

<form action="register.php" method="post">
    <div class="container">
        <hr>

        <label for="firstName"><b>First Name</b></label>
        <input type="text" placeholder="Enter First Name" name="firstName" id="firstName" required>

        <label for="lastName"><b>Last Name</b></label>
        <input type="text" placeholder="Enter Last Name" name="lastName" id="lastName" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" id="email" required>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username" id="username" required>

        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone Number" name="phone" id="phone" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" required>

        <label for="psw-repeat"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="psw-repeat" id="psw-repeat" required>
        <hr>

        <button type="submit" class="registerbtn" onclick=
        <?php
        //function_alert("testing out method");
          if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['email'])
           && isset($_POST['username']) && isset($_POST['psw']) && isset($_POST['psw-repeat'])) {
           $username = $_POST['username'];
           $password = $_POST['psw'];
           $pswRepeat = $_POST['psw-repeat'];
           $first = $_POST['firstName'];
           $last = $_POST['lastName'];
           $email = $_POST['email'];
           $phone = $_POST['phone'];
            if(strcmp($password, $pswRepeat) == 0){
              createUser($username, $first, $last, $password, $email, $phone,0);
            }
          }
          unset($_POST['firstName']);
          unset($_POST['lastName']);
          unset($_POST['email']);
          unset($_POST['username']);
          unset($_POST['psw']);
          unset($_POST['psw-repeat']);


        ?>>Register</button>
    </div>

    <div class="container signin">
        <p>Already have an account? <a href="logIn.php">Sign in</a>.</p>
        <p><a href="index.php">Return Home</a></p>
    </div>
</form>
