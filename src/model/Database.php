<?php

class Database {

    private $env;
    private $dbConnection;

    public function __construct() {

        $this->env = $this->getWeb1Env();

        // Infos we need to connect to the database.
        $hostname = "";
        $username = "";
        $password = "";
        $database = "";

        // Local docker development environment.
        if ($this->env == "DEV")
        {
            $hostname = getenv('DEV_DB_HOST');
            $username = getenv('DEV_DB_USER');
            $password = getenv("DEV_DB_PASSWORD");
            $database = getenv("DEV_DB_DB");
        } elseif ($this->env == "TEST") { // The travis.ci environment.
            //$hostname = getenv('DEV_DB_HOST'); 
            //$username = getenv('DEV_DB_USER');
            //$password = getenv("DEV_DB_PASSWORD");
            //$database = getenv("DEV_DB_DB");
        } elseif ($this->env == "PROD") {
            $url = getenv('JAWSDB_URL');
            $dbparts = parse_url($url);

            $hostname = $dbparts['host'];
            $username = $dbparts['user'];
            $password = $dbparts['pass'];
            $database = ltrim($dbparts['path'],'/');
        } else {
            die("Could not set database connection parameters!");
        }

        // Create connection
        $this->dbConnection = new mysqli($hostname, $username, $password);
    }

    public function isConnected() {
        return !$this->dbConnection->connect_error;
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
