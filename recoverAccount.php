<?php
function recoverAccount($username) {
  function validate($data){

    $data = trim($data);

    $data = stripslashes($data);

    $data = htmlspecialchars($data);

    return $data;

  }
  require('databaseHandler.php');
  require('loadUser.php');
  $username = validate($username);
  $sql = "SELECT * FROM users WHERE userID='$username';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0) {
    $row = mysqli_fetch_assoc($result);
  }
  $pass = 'empty';
  if($row['userID'] == $username){
      $_SESSION['userID'] = $username;
      $pass = $row['password'];
    }else {
      header("Location: recover.php?error=Incorrect User name or password".$username);
  }
  return $pass;
}

?>
