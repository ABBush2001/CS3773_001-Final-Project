<?php
session_start();
include_once 'loaditems.php'

?>
<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="CSS\HomePage.css">
            <title>Art Central</title>
            <div class="menu" >
                <a href="index.php" style="font-size:10px">HOME</a>
                <a href="#news" style="font-size:10px">NEWS</a>
                <a href="#notification" style="font-size:10px">NOTIFICATIONS</a>
                <input type="text" placeholder="Search...">
            </div>
            <div class= "rightMenu">
                <a href="LoggingInPage.html">
                    <img src="images/login.png" width="50" height="50" style="right: 25px; position:fixed;float:right;image-orientation: flip;text-align: center;"/>
                </a>
                <a href="ShoppingCartPage.html">
                    <img src="images/cart.png" width="50" height="50" style="right: 80px; position:fixed;float:right;image-orientation: flip;text-align: center;"/>
                </a>
                </div>
        </head>

        <body>
            <br><br><br><br>
            <h1>Art Central</h1>
            <header class="phrase">All your wants for art<br><br></header>
            <br><br>
            <table style="width:50%">
                <tr>
                    <?php
                        $itemArray = loadItems();
                        foreach($itemArray as $item){
                            echo '<td><a href= "itemPage.html"> <img src="' . $item->getImg() . '" width="auto, 50%" height="auto, 50%" style="display: flex; align-items: center; justify-content: center"></img></a>'. $item->getDescription() . '</td>';
                        }
                    ?>
                </tr>
            </table>
        </body>
    </html>
