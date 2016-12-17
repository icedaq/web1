<?php

require("src/model/Database.php");

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    private $db;

    protected function setUp(){
       $this->db = new Database(); 
    }

    public function testConnection()
    {
       $this->assertEquals($this->db->isConnected(), true);
    }

    //public function testDBExists()
    //{
      // $this->assertEquals($this->db->dbExists("webshop"), true);
    //}
}
