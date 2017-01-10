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
        $catalog2 = new Catalog(); 
        $prod = $catalog2->getProductByID(1);

		$this->assertEquals("Cat!", $prod->getName());
    }
}
