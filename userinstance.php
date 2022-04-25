<?php
class UserInstance {
	private $shoppingCart = array();
	private $password;
	private $username;
	private $email;
	private $phoneNumber;
	private $firstName;
	private $lastName;
	private $admin;

	public function __construct($usr, $first, $last, $pass, $email, $phone,$admin) {
		$this->username = $usr;
		$this->firstName = $first;
		$this->lastName = $last;
		$this->password = $pass;
		$this->email = $email;
		$this->phoneNumber = $phone;
		$this->admin = $admin;
	}

	public function addItem($item) {
		array_push($this->shoppingCart, $item);
    	//echo "item added";
	}

	public function removeItem($item) {
		foreach($this->shoppingCart as $i){
			if(($key = array_search($item, $this->shoppingCart, FALSE)) !== FALSE){
				unset($this->shoppingCart[$key]);
			}
		}
	}
	public function subtractItem($item){
		if(($key = array_search($item, $this->shoppingCart, FALSE)) !== FALSE){
			unset($this->shoppingCart[$key]);
		}
	}
	public function removeCart(){
		unset($this->shoppingCart);
	}
	public function getCart() {
		return $this->shoppingCart;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getUName() {
		return $this->username;
	}

	public function getFirstName(){
		return $this->firstName;
	}

	public function getLastName(){
		return $this->lastName;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getPhoneNumber(){
		return $this->phoneNumber;
	}

	public function getAdmin(){
		return $this->admin;
	}
}
