<?php
    function updateProducts($id, $itemName, $itemPrice, $picLoc, $availability, $description){
        require("databaseHandler.php");
        $sql = "UPDATE products SET itemName = '".$itemName."' , availability = ".$availability." , itemPrice = ".$itemPrice.", picLoc='".$picLoc."', description='".$description."' WHERE itemId=".$id.";";
        if ($conn->query($sql) === TRUE) {
            header("Location: manageInventory.php?ItemUpdated");
          } else {
            echo "Error updating record: " . $conn->error;
          }
    }
    function deleteProduct($id){
      require("databaseHandler.php");
      $sql = "DELETE FROM products WHERE itemId=".$id.";";
      if ($conn->query($sql) === TRUE) {
        header("Location: manageInventory.php?ItemDeleted");
      } else {
          echo "Error updating record: " . $conn->error;
      }
    }

    function createProduct($productName, $itemPrice, $picLoc, $availability, $description){
      require("databaseHandler.php");
      $sql = "INSERT INTO products (itemID, itemName, itemPrice, picLoc, availability, description)
	    VALUES(NULL, '".$productName."', $itemPrice, '".$picLoc."', $availability, '".$description."');";

	    if ($conn->query($sql) === TRUE) {
        header("Location: manageInventory.php?ItemCreated");
      } else {
        echo "Error creating item: " . $conn->error;
      }
    }
