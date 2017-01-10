<?php
if (isset($_GET['language'])) {
    setcookie("language",'',1,"/");
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

        'firstName' => array(
        'de'=>'Vorname',
        'en'=>'First name' ),
        
        'lastName' => array(
        'de'=>'Nachname',
        'en'=>'Last name' ),
        
        'email' => array(
        'de'=>'E-Mail Adresse',
        'en'=>'Email address' ),
        
        'street' => array(
        'de'=>'Strasse',
        'en'=>'Street' ),

        'houseNr' => array(
        'de'=>'Hausnummer',
        'en'=>'House number' ),
        
        'city' => array(
        'de'=>'Stadt',
        'en'=>'City' ),
        
        'zip' => array(
        'de'=>'Postleitzahl',
        'en'=>'Zip code' ),
        
        'country' => array(
        'de'=>'Land',
        'en'=>'Country' ),
        
        'countryCH' => array(
        'de'=>'Schweiz',
        'en'=>'Switzerland' ),
        
        'countryDE' => array(
        'de'=>'Deutschland',
        'en'=>'Germany' ),
        
        'countryAT' => array(
        'de'=>'Österreich',
        'en'=>'Austria' ),
        
        'catalog' => array(
        'de'=>'Katalog',
        'en'=>'Catalog' ),
        
        'category' => array(
        'de'=>'Kategorie',
        'en'=>'Category' ),
        
        'price' => array(
        'de'=>'Preis',
        'en'=>'Price' ),
        
        'login' => array(
        'de'=>'Anmelden',
        'en'=>'Login' ),
        
        'registerLink' => array(
        'de'=>'jetzt registrieren!',
        'en'=>'register now!' ),
        
        'register' => array(
        'de'=>'Registrieren',
        'en'=>'Register' ),
        
        'logout' => array(
        'de'=>'Abmelden',
        'en'=>'Logout' ),

        'username' => array(
        'de'=>'Benutzername',
        'en'=>'Username' ),
        
        'welcomeUser' => array(
        'de'=>'Hallo, ',
        'en'=>'Hi, ' ),

        'loginFailed' => array(
        'de'=>'Login fehlgeschlagen!',
        'en'=>'Login failed!' ),

        'password' => array(
        'de'=>'Passwort',
        'en'=>'Password' ),
        
        'description' => array(
        'de'=>'Beschreibung',
        'en'=>'Description' ),

        'buy' => array(
        'de'=>'Jetzt kaufen!',
        'en'=>'Buy now!' ),
        
        'options' => array(
        'de'=>'Optionen',
        'en'=>'Options' ),

        'content' => array(
        'de'=>'Willkommen auf der Seite ',
        'en'=>'Welcome to the page '));
        return isset($texts[$key][$language])
        ? $texts[$key][$language]
        : "[$key]";
}
