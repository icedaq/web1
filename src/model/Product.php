<?php

// This class represents a single product.

class Product {

    private $id;
    private $price;
    private $name;
    private $description;
    private $category;
    private $image;
    private $sale;

    public function __construct() {

    
	}

    public static function Create($name, $price, $description, $category, $image, $sale=FALSE) {

        $prod = new Product();
        $prod->name = $name;
        $prod->price = $price;
        $prod->description = $description;
        $prod->category = $category;
        $prod->image = $image;
        $prod->sale = $sale;

		$prod->save();

        return $prod;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->name;
    }

	public function getDescription() {
		return $this->description;
    }
    
    public function getSale() {
		return $this->sale;
    }

    public function setSale($sale) {
        $this->sale = $sale;
        $this->save();
    }

    // Return an array with the available option(names) for this product.
	public function getOptions() {

      $options = array();

      $db = Database::getInstance(); 
	  $con = $db->getConnection();
      
      $query = "SELECT Name FROM Options INNER JOIN ProductsOptions ON Options.id = ProductsOptions.idOption WHERE idProduct = ".$this->getId().";";
  
      if ($result = $con->query($query)) {
        	 while ($option = $result->fetch_assoc()) {
			  	array_push($options, $option['Name']);
          	}
          	$result->close();
      }
        
      return $options;
    }

	public function getCategoryName() {
          
      $db = Database::getInstance(); 
	  $con = $db->getConnection();
      
      $query = "SELECT Name FROM Categories WHERE id = ".$this->category.";";
  
      if ($result = $con->query($query)) {
        	$cat = $result->fetch_assoc();
          	$result->close();
      }
        
      return $cat['Name'];
    }


	public function getCategory() {
      return $this->category;
    }

    public function getImage() {
		return $this->image;
    }

	public function getPrice() {
		return $this->price;
    }

    // Sale is 10% off.
    public function getSalePrice() {
        return 0.9*$this->getPrice();
    }

    // Save this object to the database.
    private function save() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      $saleInt = (int)$this->sale;

      $stmt = $con->prepare("REPLACE INTO Products (id, price, name, description, category, image, sale) VALUES (?, ?, ?, ?, ?, ?, ?);");
      $stmt->bind_param("idssisi", $this->id, $this->price, $this->name, $this->description, $this->category, $this->image, $saleInt);

	  $stmt->execute();

	  $this->id = $stmt->insert_id;
    } 
}
