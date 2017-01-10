<?php

// This class represents a single product.

class Product {

    private $id;
    private $price;
    private $name;
    private $description;
    private $category;
    private $image;
    
    public function __construct() {

    
	}

    public static function Create($name, $price, $description, $category, $image) {

        $prod = new Product();
        $prod->name = $name;
        $prod->price = $price;
        $prod->description = $description;
        $prod->category = $category;
        $prod->image = $image;

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
    
    public function getImage() {
		return $this->image;
    }

	public function getPrice() {
		return $this->price;
	}

    // Save this object to the database.
    private function save() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      $stmt = $con->prepare("INSERT INTO Products (id, price, name, description, category, image) VALUES (NULL, ?, ?, ?, ?, ?);");
      $stmt->bind_param("dssis", $this->price, $this->name, $this->description, $this->category, $this->image);

	  $stmt->execute();

	  $this->id = $stmt->insert_id;
    } 
}
