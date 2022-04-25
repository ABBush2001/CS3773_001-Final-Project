<?php
    require_once 'loadUser.php';
    require_once 'userinstance.php';
    require_once 'createUser.php';

    session_start();
    $user = loadUser($_GET['id']);
    if($user->getAdmin()){
        $admincheck = "checked";
    }
    else $admincheck ="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="displayUser.css">

    <div class="topnav">
        <a class="active" href="adminHome.php">Home</a>
        <a href="#about">About</a>
        <a href="#contact">Contact</a>
        <input type="text" placeholder="Search..">
        <a href="LoggingInPage.html">
            <img src="login.png" width="25" height="25" style="right:50px;" />
        </a>
    </div>
</head>
<body>
    <?php
    echo '<form method="post">',
    '<label for="username">Username:</label>',
    '<input type="text" id="username" name="username" value="'.$user->getUName().'"><br><br>',
    '<label for="fName">First Name:</label>',
    '<input type="text" id="fName" name="fName" value="'.$user->getFirstName().'"><br><br>',
    '<label for="lName">Last Name:</label>',
    '<input type="text" id="lName" name="lName" value="'.$user->getLastName().'"><br><br>',
    '<label for="pass">Password:</label>',
    '<input type="text" id="pass" name="pass" value="'.$user->getPassword().'"><br><br>',
    '<label for="email">Email:</label>',
    '<input type="text" id="email" name="email" value="'.$user->getEmail().'"><br><br>',
    '<label for="phone">Phone Number:</label>',
    '<input type="text" id="phone" name="phone" value="'.$user->getPhoneNumber().'"><br><br>',
    '<input type="checkbox" id="admin" name="admin" value="isAdmin">',
    '<label for="admin"> Admin?</label>',
    '<br>',
    '<input type="submit" name="delete"',
        'class="button" value="Delete" />',
    '<input type="submit" name="applyChanges"',
        'class="button" value="Apply Changes" />',      
    '</form>';

    if(isset($_POST['delete'])){
        $username = $_POST['username'];
        deleteUser($username);
    }
    if(isset($_POST['applyChanges'])){
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
           if($username != $user->getUName()){
               deleteUser($user->getUName());
           }
           echo "updateUserCLicked";
           echo $username;
           echo $password;
           echo $first;
           echo $last;
           echo $email;
           echo $phone;
           echo $admin;
           updateUser($username,$first,$last,$password,$email,$phone,$admin);
    }
    ?>
</body>
</html>
