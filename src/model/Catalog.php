<?php

require_once("Product.php");
require_once("Database.php");

// This class is used to manage the products.
class Catalog {

    private $products = array(); 

    public function __construct() {
		$this->load();
    }

    public function addProduct($name, $price, $description, $category, $image) {
		$p = Product::Create($name, $price, $description, $category, $image);
		array_push($this->products, $p);
    }

    // Load all the products from the database.
    private function load() {

      $db = Database::getInstance(); 
	  $con = $db->getConnection();

	  // Where to place this?
	  if ($db->isEmpty()) {
		$db->seed();
	  } else {

      	$query = "SELECT * FROM Catalog ORDER by ID DESC";
      
      	if ($result = $con->query($query)) {
          	/* fetch object array */
         	 while ($prod = $result->fetch_object("Product")) {
			  	array_push($this->products, $p);
          	}
          	/* free result set */
          	$result->close();
      	}

	  }

	}

	public function getProductByID($id) {
		foreach ($this->products as $value) {
			if($value->getId() == $id) {
				return $value;
			}
		}
	}

    // Product: 20 Products. Options. Categories.
    // Create a default set of products.
    public function seed() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      // Create the table for the categories.
      $queryCategories = "CREATE TABLE Categories (id int auto_increment, name varchar(50), primary key (id));";
      $con->query($queryCategories);

      // Create the table for the options.
      $queryOptions = "CREATE TABLE Options (id int auto_increment, name varchar(50), primary key (id));";
      $con->query($queryOptions);

      // Create a helper table for the n:n product-option relationship.
      $queryProductsOptions = "CREATE TABLE ProductsOptions (idProduct int, idOption int, primary key (idProduct, idOption));";
      $con->query($queryProductsOptions);

      // Create the table.
      $query = "CREATE TABLE Products (id int auto_increment, name varchar(20), price double, description varchar(255), category int, image varchar(100), primary key (id));";
      $con->query($query);

      // Now add some data. We add the categories and options by hand.
      $query =  "INSERT INTO Categories (id, name) VALUES (NULL, 'Cool pictures'), (NULL, 'Cooler pictures');";
      $con->query($query);
      $query =  "INSERT INTO Options (id, name) VALUES (NULL, 'High Rez'), (NULL, 'Ultra Rez!');";
      $con->query($query);

      // We build the product objects and let them store themself.
      $this->addProduct("Picture1", "1.00", "Cute picture", 1, "image1.png"); 
    }
}