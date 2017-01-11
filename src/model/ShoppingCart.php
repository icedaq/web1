<?php
require_once('ShoppingCartItem.php');
session_start();

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

    // TODO: Consolidate this a little bit.
	public function updateProduct($productID, $quantity) {
        $found = false;
        foreach ($this->cart as &$value) {

			if ($value->getId() == $productID)
			{
				$value->setAmount($quantity);
                $found = true;
            }
        }
        if (!$found)
        {
            $this->addProduct($productID, $newQuantity);

        }
	}

	public function increaseProduct($productID, $quantity) {
        $found = false;
        foreach ($this->cart as &$value) {

			if ($value->getId() == $productID)
			{
				$value->setAmount($value->getAmount() + $quantity);
                $found = true;
            }
        }
        if (!$found)
        {
            $this->addProduct($productID, $newQuantity);

        }
	}

	public function decreaseProduct($productID, $quantity) {
        foreach ($this->cart as &$value) {
			if ($value->getId() == $productID)
            {
                if ($value->getAmount() > 0 ) {
				    $value->setAmount($value->getAmount() - $quantity);
                }
            }
        }
    }

	public function removeProduct($productID) {
        foreach ($this->cart as &$value) {
			if ($value->getId() == $productID)
            {
                if ($value->getAmount() > 0 ) {
				    $value->setAmount(0);
                }
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

    public function getJsonCart() {

        $cart = array();

        foreach ($this->cart as $v) {
            array_push($cart, ["id"=>$v->getId(), "quantity"=>$v->getAmount(), "price"=>$v->getPrice()]);
        }
		return $cart;
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
