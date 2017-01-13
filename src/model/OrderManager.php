<?php
require_once("Order.php");
require_once("Database.php");
require_once("User.php");
require_once("ShoppingCart.php");
session_start();

// This class is used to manage the orders.
class OrderManager {

    private $orders = array(); 

    public function __construct() {
		//$this->load();
    }

    public function addOrder() {
        $cart = ShoppingCart::load();
        $user = $_SESSION['user'];
        $o = new Order($cart, $user);
        array_push($this->orders, $o);
        $_SESSION['order'] = serialize($o);
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

	public function getOrders() {
        return $this->products;
    }

    public function getCurrentOrder() {
        if (isset($_SESSION['order'])) {
            return unserialize($_SESSION['order']);
        }
    }

	public function getOrderByID($id) {
		foreach ($this->orders as $value) {
			if($value->getId() == $id) {
				return $value;
			}
		}
    }

    public function seed() {

    /*  $db = Database::getInstance(); 
      $con = $db->getConnection();

      // Create the table for the categories.
      $queryCategories = "CREATE TABLE Categories (id int auto_increment, name varchar(50), primary key (id));";
      $con->query($queryCategories);

      // Now add some data. We add the categories and options by hand.
      $query =  "INSERT INTO Categories (id, name) VALUES (NULL, 'Animals'), (NULL, 'Persons'), (NULL, 'Landscape'), (NULL, 'Abstract'), (NULL, 'Objects'), (NULL, 'Other');";
      $con->query($query);
    */
    }
}
