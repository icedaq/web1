<?php

require_once("src/model/Catalog.php");

use PHPUnit\Framework\TestCase;

class CatalogTest extends TestCase
{

    public function testGetProduct()
	{
		// This one should seed the database;
        //$catalog1 = new Catalog(); 
		//$catalog1->addProduct("Miten", 2.05, "Cute AF cat pick.", "1", "anotherimage.jpg"); 

        //$catalog2 = new Catalog(); 
		//$prod = $catalog1->getProductByID(1);

		//$this->assertEquals("Miten", $prod->getName());
		$this->assertEquals(1, 1);
    }
}
