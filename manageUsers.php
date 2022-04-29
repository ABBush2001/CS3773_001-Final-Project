<?php
    require_once 'loadUser.php';
    session_start();
    require_once 'userinstance.php';
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
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="manageUsers.css" rel="stylesheet" />
	<div class="head">
        <div class="header-right">
        <a class="btn" href="adminHome.php">Return</a>
        </div>
    </div>
</head>
<body>
<div class="block">
<button class="btn" type="submit" onclick="location.href = 'createNewUser.php';" >Add New User</button>
<br><br>
    </div>
    <table>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Password</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>isAdmin</th>
        </tr>
        <?php
            $userArray = loadUsers();
            foreach($userArray as $user){
                echo '<tr>',
                '<td><a href="displayUser.php?id='.$user->getUName().'"style="color: forestgreen;"/>'.$user->getUName(). '</td>',
                '<td>'.$user->getFirstName().'</td>',
                '<td>'.$user->getLastName().'</td>',
                '<td>'.$user->getPassword().'</td>',
                '<td>'.$user->getEmail().'</td>',
                '<td>'.$user->getPhoneNumber().'</td>',
                '<td>'.$user->getAdmin().'</td>',
                '</tr>';
            }
        ?>
    </table>
</body>
