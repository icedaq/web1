<?php

require_once("src/model/UserManager.php");

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
     protected function setUp(){
         $db = Database::getInstance();
         $db->seed();
    }

    public function testAdminLogin()
	{
        $um = new UserManager();
        $isValid = $um->checkLogin("admin", "admin");

		$this->assertEquals(true, $isValid);
    }
    public function testAdminLoginFail()
	{
        $um = new UserManager();
        $isValid = $um->checkLogin("admin", "notThePassword");

		$this->assertEquals(false, $isValid);
    }

}
