<?php
class Order{
	private $orderNum;
	private $date;
    private $user;
    private $totalPrice;
    private $current;

	public function __construct($orderNum, $date, $user, $total, $current) {
		$this->orderNum = $orderNum;
        $this->date = $date;
        $this->user = $user;
        $this->totalPrice = $total;
        $this->current = $current;
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

}

?>