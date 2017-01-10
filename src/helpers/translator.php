<?php
if (isset($_GET['language'])) {
    setcookie("language", $_GET['language'], time()+60*60*24*30, "/");
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

        'catalog' => array(
        'de'=>'Katalog',
        'en'=>'Catalog' ),
        
        'category' => array(
        'de'=>'Kategorie',
        'en'=>'Category' ),
        
        'price' => array(
        'de'=>'Preis',
        'en'=>'Price' ),
        
        'description' => array(
        'de'=>'Beschreibung',
        'en'=>'Description' ),
    
        'content' => array(
        'de'=>'Willkommen auf der Seite ',
        'en'=>'Welcome to the page '));
        return isset($texts[$key][$language])
        ? $texts[$key][$language]
        : "[$key]";
}
