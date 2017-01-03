<?php

require_once("src/model/Catalog.php");

use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase
{
     protected function setUp(){
         $db = Database::getInstance();
         $db->seed();
    }

    public function testGetProduct()
	{
		// This one should seed the database;
        $catalog1 = new Catalog(); 
		$catalog1->addProduct("Miten", 2.05, "Cute AF cat pick.", "1", "anotherimage.jpg"); 

        $catalog2 = new Catalog(); 
		$prod = $catalog2->getProductByID(3);

		$this->assertEquals("Miten", $prod->getName());
    }
}
