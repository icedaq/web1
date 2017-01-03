<?php

session_start();

require_once('ShoppingCartItem.php');

// The shopping cart.
class ShoppingCart {

	private $cart = array(); 

	public static function load() {
		if (!empty($_SESSION["shoppingcart"])) {
			return $_SESSION["shoppingcart"];
		} else {
			$newCart = new ShoppingCart();
			$_SESSION["shoppingcart"] = $newCart; 
			return $newCart;
		}
	}

    public function addProduct($productID, $quantity) {
        $item = new ShoppingCartItem($productID, $quantity);
		array_push($this->cart, $item);
	}

	public function updateProduct($productID, $newQuantity) {
		foreach ($this->cart as &$value) {

			if ($value->getId() == $productID)
			{
				$value->setAmount($newQuantity);
			}
		}
	}

	public function productQuantity($productID) {
		foreach ($this->cart as &$value) {
			if ($value->getId() == $productID)
			{
				return $value->getAmount();
			}
		}
	}
    
	public function getCart() {
		return $this->cart;
	}

	// Calculate the price of the whole cart.
	public function cartPrice() {

		$price = 0;
		foreach ($this->cart as $value) {
            $price += $value->getPrice();
		}
    
        return $price;

    }

    public function clearCart() {
        $this->cart = array();
    }

}
