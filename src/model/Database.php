<?php

require_once("Catalog.php");
require_once("UserManager.php");

class Database {

    private static $db = NULL;

    private $env;
    private $dbConnection;
	private $isEmpty;

    private $hostname;
    private $username;
    private $password;
    private $database;

    static function getInstance() {
        if (NULL == self::$db) {
           self::$db = new Database();
		}

        return self::$db;
    }

    public function __construct() {

        $this->env = $this->getWeb1Env();

        // Infos we need to connect to the database.
        $this->database = "webshop";

        // Local docker development environment.
        if ($this->env == "DEV")
        {
            $this->hostname = getenv('DEV_DB_HOST');
            $this->username = getenv('DEV_DB_USER');
            $this->password = getenv("DEV_DB_PASSWORD");
        } elseif ($this->env == "TEST") { // The travis.ci environment.
            $this->hostname = "localhost"; 
            $this->username = "travis";
            $this->password = "";
        } elseif ($this->env == "PROD") {
            $url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);

            $this->hostname = $dbparts['host'];
            $this->username = $dbparts['user'];
            $this->password = $dbparts['pass']; // On heroku the DB name is fixed.
            $this->database = ltrim($dbparts['path'],'/');
        } else {
            die("Could not set database connection parameters!");
        }

        // Create connection
        $this->dbConnection = new mysqli($this->hostname, $this->username, $this->password);

        if (($this->dbExists($this->database)) && ($this->tableExists("Products"))) {
            $this->dbConnection->select_db($this->database);
		} else {
			$this->isEmpty = true;
		}
    }

    public function isConnected() {
        return !$this->dbConnection->connect_error;
    }

    public function getConnection() {
        return $this->dbConnection;
	}

	public function isEmpty() {
		return $this->isEmpty;
	}

    // Let us put some data in the database.
    public function seed() {

        $db = $this->database;

        if ($this->env != "PROD")
        {
            $this->dropDB($db); 
            $this->createDB($db);
        } else {
            $this->dropAllTables();
        }

        $this->dbConnection->select_db($db);

        // Seed the product catalog.
        $catalog = new Catalog();
        $catalog->seed();

        // Seed the users.
        $users = new UserManager();
        $users->seed();

		$this->isEmpty = false;
    }

    private function dropAllTables() {
            $this->dbConnection->query("DROP TABLE Products, Categories, Options, ProductsOptions, Users");
    }

    private function dropDB($dbName) {
        $this->dbConnection->query("DROP DATABASE ".$dbName);
    }

    private function createDB($dbName) {
        $this->dbConnection->query("CREATE DATABASE ".$dbName);
    }

    public function tableExists($tableName) {
        // statement to execute
        $sql = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME="'.$tableName.'"';

        // execute the statement
        $query = $this->dbConnection->query($sql);
        if ($query === false) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }

        // extract the value
        $row = $query->fetch_object();
        return (bool) $row->exists; 
    }

    public function dbExists($dbName) {
        // statement to execute
        $sql = 'SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME="'.$dbName.'"';

        // execute the statement
        $query = $this->dbConnection->query($sql);
        if ($query === false) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }

        // extract the value
        $row = $query->fetch_object();
        return (bool) $row->exists; 
    }

    public function debug() {
        $query = $this->dbConnection->query("SELECT * FROM Products");
        if ($query === false) {
            throw new Exception($mysqli->error, $mysqli->errno);
        }

        // extract the value
        $row = $query->fetch_assoc();
        //return "Hi!";
        return $row['name']; 
    }

    private function getWeb1Env() {

        $env = getenv('WEB1_ENV');
        if ( $env != "") {
            return $env; 
        } else {
            die("WEB1_ENV environment variable is not set!");
        }
    }
}
