<?php

require_once("src/model/ShoppingCart.php");

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private $cart;

    protected function setUp(){
        $db = Database::getInstance();
        $db->seed();
        $this->cart = new ShoppingCart(); 
    }

    public function testAddAndUpdate()
    {
       $this->cart->addProduct(1,5);
       $this->cart->updateProduct(1,3);

       $howMany = $this->cart->productQuantity(1);

       $this->assertEquals(3, $howMany);
    }

    public function testCartPrice()
    {
       $this->cart->addProduct(1,3);
       $this->cart->addProduct(2,5);

       $price = $this->cart->cartPrice();

       $this->assertEquals(6.5, $price);
    }

    // Test if the cart is stored in the session of the user.
    public function testCartSession() 
    {
        $cart = ShoppingCart::load();

        $cart->addProduct(1,5);
        $cart->addProduct(2,6);
        $oldPrice = $cart->cartPrice();

        $newCart = ShoppingCart::load();
        $newPrice = $newCart->cartPrice();

       $this->assertEquals($oldPrice, $newPrice);
    }

}
