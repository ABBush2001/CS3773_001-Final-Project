<?php
session_start();
include_once 'loaditems.php';
$id = $_GET['id'];
$item = loadItem($id);
?>
﻿<!DOCTYPE html>
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="productPage.css">
    <div class="logIn">
        <a href="LoggingInPage.html">
            <img src="login.png" width="75" height="75" style="right:50px;" />
        </a>
    </div>

    <!--This is the login Icon, has a hyperlink that takes the user to the login screen-->
    <div class="testing">
        <a href="LoggingInPage.html">
            <img src="login.png"
                 style="position:fixed; right:100px; top:5px;border:none;"
                 width="75" height="75"
                 title="Login Icon" />
        </a>
    </div>
</head>
<body>
    <h1>Art Central</h1>
    <p>All your wants for art</p>

    <header>
        <h2>
			<?php
				echo $item->getName();
			?>
		</h2>
    </header>

    <section>
        <nav>
            <div class="test">
                <a href="image">
					<?php
                    	echo '<img src="'.$item->getImg().'" width="500" height="500" style="right:50px;" />'
					?>
                </a>
            </div>
        </nav>

        <article>
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
            <button type="button">Add To Cart</button>
        </article>
    </section>
</body>
</html>
