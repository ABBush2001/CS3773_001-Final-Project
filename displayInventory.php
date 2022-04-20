<?php
    require_once 'loaditems.php';
    require_once 'products.php';
    //require_once 'databaseHandler';

    session_start();
    $id = $_GET['id'];
    if($id != 0){
        $item = loadItem($id);  
    }
    $target_dir = "images/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Art Central</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="displayInventory.css">

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
    <section>
        <article>
            <?php
            echo '<form method="post" enctype="multipart/form-data">',
                '<label for="id">Item Id:</label>',
                '<label type="text" id="id" name="id"> '.$item->getID().'</label><br><br>',
                '<label for="name">Item Name:</label>',
                '<input type="text" id="name" name="name" value="'.$item->getName().'" required ><br><br>',
                '<label for="price">Price:</label>',
                '<input type="text" id="price" name="price" value="'.$item->getPrice().'" required ><br><br>',
                '<label for="qty">Availability:</label>',
                '<input type="text" id="qty" name="qty" value="'.$item->getStock().'" required ><br><br>',
                '<label for="price">Description:</label>',
                '<textarea id="description" name="description" rows="4" cols="50" required >'.$item->getDescription().'</textarea><br><br>',
                '<input type="file" name="fileToUpload" id="fileToUpload"/><br><br>',
                '<input type="submit" name="delete"',
                    'class="button" value="Delete" />',
                '<input type="submit" name="applyChanges"',
                    'class="button" value="Apply Changes" />',      
                '</form>';
            ?>
    
    <?php
        if(isset($_POST['delete'])){
            deleteProduct($item->getID());
        }
        if(isset($_POST['applyChanges'])){

            if(empty($_FILES['fileToUpload']['name'])){ //if image is not uploaded
                $picLoc = $item->getImg();
            }
            else{
                $target_file = $target_dir . $_FILES["fileToUpload"]["name"];//file path
                $uploadOK = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));//gets the type of file
                $tempFileName = $_FILES["fileToUpload"]["tmp_name"];
                //check if image file is an actual image or fake image
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }
  
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
  
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($tempFileName, $target_file)) {
                        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
                    } else {
                        echo "\nSorry, there was an error uploading your file: ".$_FILES["fileToUpload"]["error"] ;
                        echo "\nfileName: ".$_FILES["fileToUpload"]["tmp_name"] ;
                    }
                }
                $picLoc = $target_file;
            }

                $name = $_POST['name'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $description = $_POST['description'];
                $id = $item->getID();


               updateProducts($id ,$name,$price, $picLoc, $qty, $description);
        }
    ?>
            
        </article>
    </section>

</body>
</html>