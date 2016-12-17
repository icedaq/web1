<?php

require("src/model/Database.php");

use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testConnection()
    {
       $db = new Database(); 
       $this->assertEquals($db->isConnected(), true);
    }
}
