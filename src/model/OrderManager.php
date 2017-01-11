<?php

require_once("Product.php");
require_once("Database.php");

// This class is used to manage the orders.
class OrderManager {

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
      
      $query = "SELECT * FROM Products ORDER by ID DESC";
  
      if ($result = $con->query($query)) {
         	/* fetch object array */
        	 while ($prod = $result->fetch_object("Product")) {
			  	array_push($this->products, $prod);
          	}
          	/* free result set */
          	$result->close();
      }
	}

	public function getProducts() {
        return $this->products;
    }

	public function getProductByID($id) {
		foreach ($this->products as $value) {
			if($value->getId() == $id) {
				return $value;
			}
		}
    }

	public function getCategories() {

      $categories = array();

      $db = Database::getInstance(); 
	  $con = $db->getConnection();
      
      $query = "SELECT id, name FROM Categories;";
  
      if ($result = $con->query($query)) {
        	 while ($cat = $result->fetch_assoc()) {
			  	array_push($categories, ["id"=>$cat['id'], "name"=>$cat["name"]]);
          	}
          	$result->close();
      }
        
      return $categories;
    }

    public function filterProductsByName($term) {

        $result = array();

        foreach ($this->products as $value) {
            $littleHaystack = strtolower($value->getName());
            $littleNeedle = strtolower($term);
            if(strpos($littleHaystack, $littleNeedle) !== false) {
                array_push($result, $value);
			}
        }

        return $result;
	}

    // Product: 20 Products. Options. Categories.
    // Create a default set of products.
    public function seed() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      // Create the table for the categories.
      $queryCategories = "CREATE TABLE Categories (id int auto_increment, name varchar(50), primary key (id));";
      $con->query($queryCategories);

      // Now add some data. We add the categories and options by hand.
      $query =  "INSERT INTO Categories (id, name) VALUES (NULL, 'Animals'), (NULL, 'Persons'), (NULL, 'Landscape'), (NULL, 'Abstract'), (NULL, 'Objects'), (NULL, 'Other');";
      $con->query($query);

    }
}
