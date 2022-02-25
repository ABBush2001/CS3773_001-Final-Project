<?php
class UserInstance {
	private $shoppingCart = array();
	private $password;
	private $username;
	private $email;

	public function __construct($usr, $pass, $email) {
		$this->username = $usr;
		$this->password = $pass;
		$this->email = $email;
	}

	public function addItem($item) {
		array_push($shoppingCart, $item);
	}

}
