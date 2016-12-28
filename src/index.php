<?php

require("model/Database.php");

$db=Database::getInstance();
$db->seed();
echo $db->debug();

?>
