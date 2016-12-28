<?php

require("model/Database.php");

$db = new Database();
$db->seed();
echo $db->debug();

?>
