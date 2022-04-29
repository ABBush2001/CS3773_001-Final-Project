<?php
function checkOut($item, $quantity) {
  require('databaseHandler.php');
  $stock = $item->getStock();
  $updatedStock = $stock-$quantity;
  $sql = "UPDATE products SET availability=$updatedStock WHERE itemId=".$item->getID().";";
  $item->setAvailability($updatedStock);
  $conn->query($sql);
}
