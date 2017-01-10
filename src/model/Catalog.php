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
      $query =  "INSERT INTO Categories (id, name) VALUES (NULL, 'Animals'), (NULL, 'Persons'), (NULL, 'Landscape'), (NULL, 'Abstract'), (NULL, 'Objects'), (NULL, 'Other');";
      $con->query($query);

      $query =  "INSERT INTO Options (id, name) VALUES (NULL, 'High Rez'), (NULL, 'Ultra Rez!');";
      $con->query($query);

      $query =  "INSERT INTO ProductsOptions (idProduct, idOption) VALUES (1, 1), (1, 2), (2, 1), (3, 1), (4, 2), (5, 1), (5, 2), (6, 1), (7, 1), (8, 1), (8, 2), (9, 1), (10, 1), (11, 2), (12, 1), (12, 2), (13, 1), (14, 1), (15, 1), (15, 2), (16, 1), (17, 1), (18, 1), (19, 2), (20, 1), (20, 2);";
      $con->query($query);

      // We build the product objects and let them store themself.
      $this->addProduct("Cat!", "1.00", "Super cute cat picture.", 1, "/images/image1.png"); 
      $this->addProduct("Photographer", "0.70", "Picture of a guy taking a picture.", 2, "/images/image2.png"); 
      $this->addProduct("Small train", "1.50", "Picture of a small train or something.", 5, "/images/image3.png"); 
      $this->addProduct("Bird", "1.20", "A bird on some rope.", 1, "/images/image4.png"); 
      $this->addProduct("Radio", "1.00", "Buttons of a old radio.", 5, "/images/image5.png"); 
      $this->addProduct("Watch", "0.80", "Picture of a beatiful watch.", 5, "/images/image6.png"); 
      $this->addProduct("Piano", "0.90", "The keys of a piano.", 5, "/images/image7.png"); 
      $this->addProduct("Recording tape", "1.00", "Some ancient recording tape.", 5, "/images/image8.png"); 
      $this->addProduct("Fire!", "1.50", "A though fireman walking out of a fire.", 2, "/images/image9.png"); 
      $this->addProduct("iMac", "0.40", "Picture of an iMac.", 5, "/images/image10.png"); 
      $this->addProduct("Nice room", "1.50", "An old fancy room.", 6, "/images/image11.png"); 
      $this->addProduct("Flowers", "1.00", "Some beautiful flowers.", 3, "/images/image12.png"); 
      $this->addProduct("Beer", "2.00", "A nice delicous beer!", 6, "/images/image13.png"); 
      $this->addProduct("Tired fox", "1.20", "Picture of a tired fox.", 1, "/images/image14.png"); 
      $this->addProduct("Desert", "1.60", "Nice picture of a desert or something.", 3, "/images/image15.png"); 
      $this->addProduct("Blur", "1.00", "Picture of some nicely blured lights.", 4, "/images/image16.png"); 
      $this->addProduct("Stones", "0.50", "Beatiful stones in a landscape.", 3, "/images/image17.png"); 
      $this->addProduct("Skydivers", "1.70", "People skydiving!", 2, "/images/image18.png"); 
      $this->addProduct("Spider", "0.50", "A nice big spiderbro!", 1, "/images/image19.png"); 
      $this->addProduct("Lights", "1.25", "Long exposure shot of some lights.", 4, "/images/image20.png"); 
        
    
    }
}
