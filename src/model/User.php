<?php

// This class represents a user.

class User {

    private $login;
    private $password;
    private $email;
    private $firstName;
    private $lastName;
    private $street;
    private $houseNumber;
    private $city;
    private $country;
    private $zip;
    private $isAdmin;
    
    public function __construct() {

    
	}

    public static function Create($login, $password, $email, $firstName, $lastName, $street, $houseNumber, $city, $zip, $country, $isAdmin) {
    
        $user = new User(); 
        $user->login = $login;
        // PHP password_hash is already hashed and salted. Just how we like it.
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->email = $email;
        $user->firstName = $firstName;
        $user->lastName = $lastName;
        $user->street = $street;
        $user->houseNumber = $houseNumber;
        $user->city = $city;
        $user->zip = $zip;
        $user->country = $country;
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
    
    public function getMail() {
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
    
    public function getCountry() {
		return $this->country;
    }
    
    public function isAdmin() {
		return $this->isAdmin;
    }

    // Save this object to the database.
    private function save() {

      $isAdminInt = (int)$this->isAdmin;

      $db = Database::getInstance(); 
      $con = $db->getConnection();
      $stmt = $con->prepare("INSERT INTO Users (id, login, password, email, firstName, lastName, street, houseNumber, city, zip, country, isAdmin) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
      
      $stmt->bind_param("ssssssisisi", $this->login, $this->password, $this->email, $this->firstName, $this->lastName, $this->street, $this->houseNumber, $this->city, $this->zip, $this->country, $isAdminInt);
	  $stmt->execute();

	  $this->id = $stmt->insert_id;
    } 
}
