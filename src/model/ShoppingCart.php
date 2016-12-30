<?php

session_start();

// The shopping cart.
class ShoppingCart {

	private $cart = array(); 

	public function load() {

		if (!isempty($_SESSION["shoppingcart"])) {
			return $_SESSION["shoppingcart"];
		} else {
			$newCart = new ShoppingCart();
			$_SESSION["shoppingcart"] = $newCart; 
			return $newCart;
		}
	}

	public function addProduct($productID, $quantity) {
		array_push($this->cart, ["productID"=>$productID, "quantity"=>$quantity]);
	}

	public function updateProduct($productID, $newQuantity) {
		foreach ($this->cart as &$value) {

			if ($value["productID"] == $productID)
			{
				$value["quantity"] = $newQuantity;
			}
		}
	}

	public function getPosOfProduct($id) {
		foreach ($this->cart as $key => $value) {
			if ($value["productID"] == $id)
			{
				return $key;
			}
		}
	}

	public function getCart() {
		return $this->cart;
	}

}
