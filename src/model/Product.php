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

        return $prod;
    }

    // Save this object to the database.
    public function save() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      $stmt = $con->prepare("INSERT INTO Products (id, price, name, description, category, image) VALUES (NULL, ?, ?, ?, ?, ?);");
      $stmt->bind_param("dssis", $this->price, $this->name, $this->description, $this->category, $this->image);
      
      $stmt->execute();

    } 


}
