<?php
require_once 'loaditems.php';
require_once 'userinstance.php';
require_once 'loadUser.php';
session_start();
$user=null;
if(isset($_SESSION['userID'])==FALSE && $_SESSION['userID']  != "guest")
{
  	$user = new UserInstance("guest","guest","guest","none","none","none",0);
	$_SESSION['userID'] = $user->getUName();
}else{
    $usr = $_SESSION['userID'];
	if($_SESSION['userID'] != "guest") {
		$user = loadUser($usr);
    if($user->getAdmin() == 1){
       header("Location: adminHome.php");
    }
	}else{
		$user = new UserInstance("guest","guest","guest","none","none","none",0);
	}
}
?>
<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="CSS\HomePage.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <title>Art Central</title>
			<div class="head">
            	<div class="menu" >
                	<a href="index.php" class="logo">ArtCentral</a>
                	<form action="/searchPage.php">
                    	<input type="text" placeholder="Search..." name="search">
                    	<button type="submit" class="btn"><i class="fa fa-search"></i>Submit</button>
                            <select class="table-filter" name="filters">
                            <option value="all">No filter selected</option>
                            <option value="lowHigh">Sort by price (low to high)</option>
                            <option value="highLow">Sort by price (high to low)</option>
                            <option value="lowAvail">Sort by availability (low to high)</option>
                            <option value="highAvail">Sort by availability (high to low)</option>
                            <optgroup label="Artists">
                                <?php
                                    $itemArray = loadItems();
                                    $artistArray= array();
                                    $position = 0;
                                    foreach($itemArray as $item){
                                        for($i=0; $i<strlen($item->getDescription()); $i++){
                                            if($item->getDescription()[$i]== '['){
                                                $position = $i+1;
                                            }else if($item->getDescription()[$i] == ']'){
                                                array_push($artistArray, substr($item->getDescription(), $position, $i-$position));
                                            }
                                        }
                                    }
                                    $artistArray= array_unique($artistArray);
                                    foreach($artistArray as $artist){
                                        echo '<option value="'.$artist.'">'.$artist.'</option>';
                                    }

                                ?>
                            </optgroup>
                        </select>
                    </form>
				</div>
            <div class= "header-right">
              <?php
              if(isset($_SESSION['userID'])==TRUE && $_SESSION['userID']  != "guest")
              {
                  echo '<a href="userOrderLogs.php">';
              }else{
                  echo '<a href="logIn.php">';
              } ?>

                    <img src="images/userImage.png" class ="profile" width="95" height="50" style="right: 15px;"/>
                </a>
                <a href="shoppingCart.php">
                    <img src="images/cart.png" width="50" height="50" style="right: 80px;"/>
                </a>
				<?php

					if($user != null && $user->getUName() != "guest" )
					{
						echo '<form method = "post">
		                    <input type ="submit" name = "logout" class = "btn" value = "Log out" style="top: 80px; right: 30px;"/>
		                </form>';
					}
					if(array_key_exists('logout', $_POST)){
						unset($_SESSION['userID']);
						unset($_POST['uname']);
						unset($_POST['psw']);
						header("Refresh:0");
					}
                ?>
                </div>
			</div>
</head>

        <body>
            <table class="productImg" style="width:100%">
                <tr>
                    <?php
                        $itemArray = loadItems();
                        $count = (int)0;
                        foreach($itemArray as $item){
                            $count= $count + 1;
                            if($count%5 == 0){
                                echo '<tr></tr>';
                            }
                            echo '<td><a href= "productPage.php?id='.$item->getID().'"> <img src="' . $item->getImg() . '" style="right:50px;"></img></a></td>';

                        }
                    ?>
                </tr>
            </table>
        </body>
    </html>
