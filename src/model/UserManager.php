<?php
require_once("User.php");
require_once("Database.php");
session_start();

// This class is used to manage the products.
class UserManager {

    private $users = array(); 

    public function __construct() {
        $this->load();
    }

    // TODO: Add country.

    public function addUser($login, $password, $firstName, $lastName, $street, $houseNumber, $city, $zip, $isAdmin) {
		User::Create($login, $password, $firstName, $lastName, $street, $houseNumber, $city, $zip, $isAdmin);
    }

    // Load all the users from the database.
    private function load() {

      $db = Database::getInstance(); 
	  $con = $db->getConnection();
      
      $query = "SELECT * FROM Users ORDER by ID DESC";
  
      if ($result = $con->query($query)) {
         	/* fetch object array */
        	 while ($user = $result->fetch_object("User")) {
			  	array_push($this->users, $user);
          	}
          	/* free result set */
          	$result->close();
      }
	}

	public function getUserByID($id) {
		foreach ($this->users as $value) {
			if($value->getId() == $id) {
				return $value;
			}
		}
    }
    
    public function getUserByLogin($login) {
		foreach ($this->users as $value) {
			if($value->getName() == $login) {
				return $value;
			}
		}
    }

    public function checkLogin($login, $password) {

      $db = Database::getInstance(); 
      $con = $db->getConnection();
      $stmt = $con->prepare("SELECT password FROM Users WHERE login=?;");
      $stmt->bind_param("s", $login);

	  $stmt->execute();

      if ($stmt === false) {
       throw new Exception($mysqli->error, $mysqli->errno);
      }

      $stmt->bind_result($pw);
      $stmt->fetch();

      return password_verify($password, $pw);
    }

    // Check if the currently logged in user is an admin.
    public static function isAdmin() {
        if (isset($_SESSION["user"]) && $_SESSION["user"]->isAdmin()) {
            return true;
        } else {
            return false;
        }
    }
    // Create a default set of users.
    public function seed() {

      $db = Database::getInstance(); 
      $con = $db->getConnection();

      // Maybe add an index on the login column.

      // Create the table.
      $query = "CREATE TABLE Users (id int auto_increment, login varchar(255), password varchar(255), firstName varchar(255), lastName varchar(255), street varchar(255), houseNumber int, city varchar(255), zip int, isAdmin bool, primary key (id));";
      $con->query($query);

      // We build the user objects and let them store themself.
      $this->addUser("admin", "admin", "Chuck", "Norris", "Awesomeave", 5, "Roundhouse Town", 1337, true); 
    }
}
