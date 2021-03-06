<?php

// This class represents a single product.

class Product {

    private $id;
    private $price;
    private $name;
    private $description;
    private $category;
    private $options;
    private $image;
    private $sale;

    public function __construct() {

    
	}

    public static function Create($name, $price, $description, $category, $options, $image, $sale=FALSE) {

        $prod = new Product();
        $prod->name = $name;
        $prod->price = $price;
        $prod->description = $description;
        $prod->category = $category;
        $prod->image = $image;
        $prod->sale = $sale;
        $prod->options = $options;

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

    // Sale is 10% off.
    public function getPrice() {
        $price = 0;
        if ($this->getSale()){
            $price = $this->price*0.9;
        } else {
		    $price = $this->price;
        }
        return $price;
    }

    // Delete itself from the database
    public function delete() {
      $db = Database::getInstance(); 
	  $con = $db->getConnection();

      $query = "DELETE FROM Products WHERE id = ".$this->id.";";

      $queryR = $con->query($query);
    }

    // Save this object to the database.
    private function save() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      // Store product.
      $saleInt = (int)$this->sale;

      $stmt = $con->prepare("REPLACE INTO Products (id, price, name, description, category, image, sale) VALUES (?, ?, ?, ?, ?, ?, ?);");
      $stmt->bind_param("idssisi", $this->id, $this->price, $this->name, $this->description, $this->category, $this->image, $saleInt);

	  $stmt->execute();

      $this->id = $stmt->insert_id;

      // Store options for the product.
      foreach ($this->options as $option) {
        $stmt2 = $con->prepare("INSERT INTO ProductsOptions (idProduct, idOption) VALUES (?,?);");
        $stmt2->bind_param("ii", $this->id, $option);      
        $stmt2->execute(); 
      }
    } 
}
