<?php

require_once('Catalog.php');

// A shopping cart item.
class ShoppingCartItem {

    private $itemID;
    private $itemAmount;

    public function __construct($id, $amount) {

        $this->itemID = $id;
        $this->itemAmount = $amount;
    
    }

	public function getId() {
		return $this->itemID;
    }
	public function getAmount() {
		return $this->itemAmount;
    }
    public function setAmount($amount) {
        $this->itemAmount = $amount;
    }

    public function getPrice() {
        $catalog = new Catalog(); 
        $prod = $catalog->getProductByID($this->itemID);
        return $prod->getPrice() * $this->itemAmount;
    }

}
