<?php
if (isset($_GET['language'])) {
    setcookie("language", $_GET['language']);
}

function t($key) {
    
    if (isset($_COOKIE['language'])) {
        $language = $_COOKIE['language'];  
    } else {
        $language = "en";
    }

    $texts = array(
        'page' => array(
        'de'=>'Seite',
        'en'=>'Page' ),
        
        'houseNr' => array(
        'de'=>'Hausnummer',
        'en'=>'House number' ),

        'content' => array(
        'de'=>'Willkommen auf der Seite ',
        'en'=>'Welcome to the page '));
        return isset($texts[$key][$language])
        ? $texts[$key][$language]
        : "[$key]";
}
