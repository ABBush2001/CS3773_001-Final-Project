<?php
class Item{
	private $itemID;
	private $itemName;
	private $itemPrice;
	private $picLoc;
	private $availability;
	private $description;

	public function __construct($id, $name, $price, $img, $stock, $description) {
		$this->itemID = $id;
		$this->itemName = $name;
		$this->itemPrice = $price;
		$this->picLoc = $img;
		$this->availability = $stock;
		$this->description = $description;
	}

	public function getID() {
		return $this->itemID;
	}

	public function getName() {
		return $this->itemName;
	}

	public function getPrice() {
		return $this->itemPrice;
	}

	public function getImg() {
		return $this->picLoc;
	}

	public function getStock() {
		return $this->availability;
	}

	public function getDescription() {
		return $this->description;
	}

}

?>
