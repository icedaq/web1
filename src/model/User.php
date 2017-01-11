<?php

// This class represents a user.

class User {

    private $login;
    private $password;
    private $firstName;
    private $lastName;
    private $street;
    private $houseNumber;
    private $city;
    private $zip;
    private $isAdmin;
    
    public function __construct() {

    
	}

    // TODO: Add country
    public static function Create($login, $password, $firstName, $lastName, $street, $houseNumber, $city, $zip, $isAdmin) {
    
        $user = new User(); 
        $user->login = $login;
        // PHP password_hash is already hashed and salted. Just how we like it.
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->street = $street;
        $user->houseNumber = $houseNumber;
        $user->city = $city;
        $user->zip = $zip;
        $user->isAdmin = $isAdmin;

		$user->save();

        return $user;
	}

	public function getId() {
		return $this->id;
	}

	public function getName() {
		return $this->login;
    }

	public function getFirstName() {
		return $this->firstName;
    }

	public function getLastName() {
		return $this->lastName;
    }
    
    public function getStreet() {
		return $this->street;
    }
    
    public function getHouseNumber() {
		return $this->houseNumber;
    }

    public function getCity() {
		return $this->city;
    }
    
    public function getZip() {
		return $this->zip;
    }

    // Save this object to the database.
    private function save() {

      $isAdminInt = (int)$this->isAdmin;

      $db = Database::getInstance(); 
      $con = $db->getConnection();
      $stmt = $con->prepare("INSERT INTO Users (id, login, password, firstName, lastName, street, houseNumber, city, zip, isAdmin) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
      
      $stmt->bind_param("sssssisii", $this->login, $this->password, $this->firstName, $this->lastName, $this->street, $this->houseNumber, $this->city, $this->zip, $isAdminInt);
	  $stmt->execute();

	  $this->id = $stmt->insert_id;
    } 
}
