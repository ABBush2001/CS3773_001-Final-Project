<?php
    //this connects the database to the php file.
    include_once 'databaseHandler.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title> TEST PAGE    </title>
</head>
<body>
<?php 
//this should select from the products table, then print out all of the images 
//for the products.
$image_details  = mysqli_query($conn, "SELECT * FROM prodcuts");
while($row = mysqli_fetch_array($image_details)){
    echo "<img src ='images/".$row['picLoc']."' >";
}
?>
</body>
</html>