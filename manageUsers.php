<?php
    require_once 'loadUser.php';
    session_start();
?>
<!DOCTYPE html>
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="manageUsers.css" rel="stylesheet" />
    <div class="head">
        <a href="#default" class="logo">CompanyLogo</a>
        <button type="submit" onclick="location.href = 'adminHome.php';">Home</button>
        <div class="header-right">
            <button type="submit">profile</button>
        </div>
    </div>
</head>
<body>
<button type="submit" onclick="location.href = 'createNewUser.php';" >Add New User</button> 
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
                '<td><a href="displayUser.php?id='.$user->getUName().'">'.$user->getUName(). '</td>',
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