<?php

require_once("src/model/ShoppingCart.php");

use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private $cart;

    protected function setUp(){
        $this->cart = new ShoppingCart(); 
    }

    public function testAddAndUpdate()
    {
       $this->cart->addProduct(1,5);
       $this->cart->updateProduct(1,3);

       $theCart = $this->cart->getCart();
       $howMany = $theCart[$this->cart->getPosOfProduct(1)]["quantity"];

       $this->assertEquals(3, $howMany);
    }
}
