<?php

class Database {

    private $env;
    private $dbConnection;

    private $hostname;
    private $username;
    private $password;
    private $database;

    public function __construct() {

        $this->env = $this->getWeb1Env();

        // Infos we need to connect to the database.
        $this->database = DBNAME;

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
            $this->password = $dbparts['pass'];
            //$database = ltrim($dbparts['path'],'/');
        } else {
            die("Could not set database connection parameters!");
        }

        // Create connection
        $this->dbConnection = new mysqli($this->hostname, $this->username, $this->password);
        $this->seedDB();
    }

    public function isConnected() {
        return !$this->dbConnection->connect_error;
    }

    // Let us put some data in the database.
    private function seedDB() {

        $db = $this->database;

        if ($this->dbExists($db)) {
            $this->dropDB($db);
        } 
        $this->createDB($db);

        $this->dbConnection->select_db($db);
    }

    private function dropDB($dbName) {
        $this->dbConnection->query("DROP DATABASE ".$dbName);
    }

    private function createDB($dbName) {
        $this->dbConnection->query("CREATE DATABASE ".$dbName);
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

    private function getWeb1Env() {

        $env = getenv('WEB1_ENV');
        if ( $env != "") {
            return $env; 
        } else {
            die("WEB1_ENV environment variable is not set!");
        }
    }
}
