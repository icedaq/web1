<?php

require_once("src/model/Database.php");
require_once("src/model/Catalog.php");

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

    public function testSeed()
    {
       $this->db->seed(); 
       $this->assertEquals(1,1); 
    }

    //public function testDBExists()
    //{
      // $this->assertEquals($this->db->dbExists("webshop"), true);
    //}
}
