<?php
class Discount{
	private $discountName;
	private $discountEffect;

	public function __construct($discountName, $discountEffect) {
        $this->discountName = $discountName;
        $this->discountEffect = $discountEffect;
	}

	public function getDiscountName() {
		return $this->discountName;
	}

	public function getDiscountEffect() {
		return $this->discountEffect;
	}
}

function updateDiscount($discountName, $discountEffect){
	require("databaseHandler.php");
	$sql = "UPDATE Coupons SET discount = $discountEffect WHERE code ='".$discountName."';";
	if ($conn->query($sql) === TRUE) {
		header("Location: manageDiscounts.php?DiscountUpdated");
	  } else {
		echo "Error updating discounts: " . $conn->error;
	  }
}
function deleteDiscount($discountName){
  require("databaseHandler.php");
  $sql = "DELETE FROM Coupons WHERE code ='".$discountName."';";
  if ($conn->query($sql) === TRUE) {
	header("Location: manageDiscounts.php?DiscountDeleted");
  } else {
	  echo "Error deleting item: " . $conn->error;
  }
}

function createDiscount($discountName, $discountEffect){
  require("databaseHandler.php");
  $sql = "SELECT * FROM Coupons WHERE code = '$discountName';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
if($resultCheck > 0){
//discount exists
echo "discount exists";
}
else{
	$sql = "INSERT INTO Coupons (code, discount)
	VALUES('$discountName', $discountEffect);";

	 if ($conn->query($sql) === TRUE) {
	header("Location: manageDiscounts.php?DiscountCreated");
  	} else {
	  echo "Error creating item: " . $conn->error;
  	}
}

}

?>
