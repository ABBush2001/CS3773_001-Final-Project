<?php
class Order{
	private $orderNum;
	private $date;
    private $user;
    private $totalPrice;
    private $current;
	private $cart = array();

	public function __construct($orderNum, $date, $user, $total, $current, $cart) {
		$this->orderNum = $orderNum;
        $this->date = $date;
        $this->user = $user;
        $this->totalPrice = $total;
        $this->current = $current;
		$this->cart = $cart;
	}

	public function getOrderNum() {
		return $this->orderNum;
	}
    public function getDate(){
        return $this->date;
    }
    public function getUser(){
        return $this->user;
    }
    public function getTotal(){
        return $this->totalPrice;
    }
    public function getCurrent(){
        if($this->current){
            return "ACTIVE";
        }
        else return "CANCELED";
    }
	public function getCart() {
		return $this->cart;
	}

}

?>
