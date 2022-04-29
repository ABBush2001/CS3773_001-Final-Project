<!DOCTYPE html>
<?php
include_once 'recoverAccount.php'
?>
<form action="recover.php" method="post">
    <head>
        <title>Items Display</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="recover.css" rel="stylesheet" />
    </head>
    <div class="imgcontainer">
        <img src="images/userImage.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="uname" required>

        <button type="submit" onclick=<?php
          if(isset($_POST['uname'])) {
            $username = $_POST['uname'];
            $pass = recoverAccount($username);
          }

          unset($_POST['uname']);
        ?>>Recover</button>
       <button type="submit" onclick="history.back()">Cancel</button> 
        <br><br><br>
    </div>
    <body>
      <?php
        echo $pass;
      ?>
    </body>
</form>
