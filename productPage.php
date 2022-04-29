<?php
require_once 'loaditems.php';
require_once 'userinstance.php';
require_once 'items.php';
require_once 'loadUser.php';
session_start();
$id = $_GET['id'];
$item = loadItem($id);

$user = null;
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
if(isset($_SESSION['cart'])==FALSE)
{
	$cart = array();
	$_SESSION['cart'] = $cart;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="productPage.css">
	<div class="head">
		<div class="menu" >
					<a href="index.php" class="logo"><img src="images/ArtCentral.png" style="width:200px; height:auto; float: left;"></a>
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
		<br><br>
		<br><br>
		<br><br>
		<br>
    <!--This is the login Icon, has a hyperlink that takes the user to the login screen-->
	</div>
</head>
<body>

    <header>
		<div class="block">
		<h2>
			<?php
				echo $item->getName();
			?>
		</h2>
		</div>
    </header>

    <section>
        <nav>
            <div class="test">
                <img src="<?php echo $item->getImg()?>" width="25%;" height="50%;" style="right:50px;" alt=""/>

            </div>
        </nav>

        <article>
            <?php

                if($item->getStock() == 0){
                    echo '<h1 style="color:red;">Product Amount: Item unavailable</h1>';
                }
                else{
                    echo '<h1 style="color:black;">Product Amount: '.$item->getStock().'</h1>';
                }
            ?>
            <h1>
				<?php
					echo 'Price $'.$item->getPrice();
				?>
			</h1>
            <p>Description</p>
            <p>
				<?php
					echo $item->getDescription();
				?>
			</p>
            <?php
                $itemArray = $_SESSION['cart'];
                $result = $_SESSION['cart'];

                $result= array_unique($result, SORT_REGULAR);
                $idArray = array();
                foreach($itemArray as $i) {
                    array_push($idArray, $i->getID());
                }
                $quantity = array_count_values($idArray);
                if(array_key_exists('button1', $_POST)){

                    if($item->getStock() > $quantity[$item->getID()]){
                        array_push($_SESSION['cart'], $item);
                        header("Refresh:0");
                    }else{
                        echo '<div class="alert alert-warning alert-dismissible">
                        <a href="shoppingCart.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Unable to add quantity: Exceeds stock availability.
                      </div>';
                    }
                    //echo "<script>console.log('test');</script>";
                }
                if($item->getStock() != 0) {
                    echo '<form method = "post">
                            <input type="submit" name= "button1" class ="cartBtn" value="Add to Cart"/>
                            </form>';
				}
            ?>

        </article>
    </section>
</body>
</html>
