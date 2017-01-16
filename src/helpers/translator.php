<?php
if (isset($_GET['language'])) {
    setcookie("language", '', 1, "/");
    setcookie("language", $_GET['language'], time() + 60 * 60 * 24 * 30, "/");
}

function t($key)
{

    if (isset($_COOKIE['language'])) {
        $language = $_COOKIE['language'];
    } else {
        $language = "en";
    }

    $texts = array(
        'page' => array(
            'de' => 'Seite',
            'en' => 'Page'),

        'sale' => array(
            'de' => 'AKTION',
            'en' => 'Sale'),

        'firstName' => array(
            'de' => 'Vorname',
            'en' => 'First name'),

        'lastName' => array(
            'de' => 'Nachname',
            'en' => 'Last name'),

        'email' => array(
            'de' => 'E-Mail Adresse',
            'en' => 'Email address'),

        'street' => array(
            'de' => 'Strasse',
            'en' => 'Street'),

        'houseNr' => array(
            'de' => 'Hausnummer',
            'en' => 'House number'),

        'city' => array(
            'de' => 'Stadt',
            'en' => 'City'),

        'zip' => array(
            'de' => 'Postleitzahl',
            'en' => 'Zip code'),

        'country' => array(
            'de' => 'Land',
            'en' => 'Country'),

        'countryCH' => array(
            'de' => 'Schweiz',
            'en' => 'Switzerland'),

        'countryDE' => array(
            'de' => 'Deutschland',
            'en' => 'Germany'),

        'countryAT' => array(
            'de' => 'Österreich',
            'en' => 'Austria'),

        'catalog' => array(
            'de' => 'Katalog',
            'en' => 'Catalog'),

        'category' => array(
            'de' => 'Kategorie',
            'en' => 'Category'),

        'price' => array(
            'de' => 'Preis',
            'en' => 'Price'),

        'login' => array(
            'de' => 'Anmelden',
            'en' => 'Login'),

        'registerLink' => array(
            'de' => 'jetzt registrieren!',
            'en' => 'register now!'),

        'register' => array(
            'de' => 'Registrieren',
            'en' => 'Register'),

        'logout' => array(
            'de' => 'Abmelden',
            'en' => 'Logout'),

        'username' => array(
            'de' => 'Benutzername',
            'en' => 'Username'),

        'welcomeUser' => array(
            'de' => 'Hallo, ',
            'en' => 'Hi, '),

        'loginFailed' => array(
            'de' => 'Login fehlgeschlagen!',
            'en' => 'Login failed!'),

        'password' => array(
            'de' => 'Passwort',
            'en' => 'Password'),

        'description' => array(
            'de' => 'Beschreibung',
            'en' => 'Description'),

        'buy' => array(
            'de' => 'Jetzt kaufen!',
            'en' => 'Buy now!'),

        'selectCategory' => array(
            'de' => 'Kategorie auswählen:',
            'en' => 'Select category:'),

        'options' => array(
            'de' => 'Optionen',
            'en' => 'Options'),

        'checkoutTitle1' => array(
            'de' => 'Checkout Schritt 1',
            'en' => 'Checkout step 1'),

        'checkoutTitle2' => array(
            'de' => 'Checkout Schritt 2',
            'en' => 'Checkout step 2'),

        'checkoutTitle3' => array(
            'de' => 'Bestellbestätigung',
            'en' => 'Order confirmation'),

        'welcomeTo' => array(
            'de' => 'Willkommen bei',
            'en' => 'Welcome to'),

        'shippingAddress' => array(
            'de' => 'Versandadresse',
            'en' => 'Shipping address'),

        'deliveryMethod' => array(
            'de' => 'Versandart',
            'en' => 'Delivery method'),

        'paymentMethod' => array(
            'de' => 'Bezahlmethode',
            'en' => 'Payment method'),

        'prepaid' => array(
            'de' => 'Vorauskasse',
            'en' => 'Prepaid'),

        'invoice' => array(
            'de' => 'Rechnung',
            'en' => 'Invoice'),

        'giftbox' => array(
            'de' => 'Geschenkbox',
            'en' => 'Gift box'),

        'next' => array(
            'de' => 'Weiter',
            'en' => 'Next'),

        'comment' => array(
            'de' => 'Kommentar',
            'en' => 'Comment'),

        'placeOrder' => array(
            'de' => 'Bestellen!',
            'en' => 'Order!'),

        'product' => array(
            'de' => 'Produkt',
            'en' => 'Product'),

        'products' => array(
            'de' => 'Produkte',
            'en' => 'Products'),

        'admin' => array(
            'de' => 'Adminbereich',
            'en' => 'Admin'),
        
        'productId' => array(
            'de' => 'Produkte ID',
            'en' => 'Product ID'),

        'productAdd' => array(
            'de' => 'Produkte-Erfassung',
            'en' => 'Adding product'),
        
        'productRemove' => array(
            'de' => 'Produkt entfernen',
            'en' => 'Delete product'),

        'productSave' => array(
            'de' => 'Produkt speichern',
            'en' => 'Product save'),

        'productOnSale' => array(
            'de' => 'Produkt in Aktion',
            'en' => 'Product on sale'),

        'save' => array(
            'de' => 'speichern',
            'en' => 'save'),

        'name' => array(
            'de' => 'Name',
            'en' => 'name'),

        'cart' => array(
            'de' => 'Warenkorb',
            'en' => 'Shopping cart'),

        'emptyCart' => array(
            'de' => 'Warenkorb leeren',
            'en' => 'empty cart'),

        'amount' => array(
            'de' => 'Menge',
            'en' => 'Amount'),

        'count' => array(
            'de' => 'Anzahl',
            'en' => 'Count'),

        'delete' => array(
            'de' => 'Entfernen',
            'en' => 'Delete'),

        'show' => array(
            'de' => 'Anzeigen',
            'en' => 'View'),

        'image' => array(
            'de' => 'Bild',
            'en' => 'Image'),

        'checkoutConfermation' => array(
            'de' => 'Vielen Dank für Ihre Bestellung! Sie erhalten in kürze ein Bestätigungs-Email.',
            'en' => 'Thank you for your order! You will receive an email confirmation shortly!'),

        'checkoutContract' => array(
            'de' => 'Dies ist eine verbindliche Bestellung. Möchten Sie fortfahren?',
            'en' => 'This is a binding contract. Do you really want to place this order?'),

        'content' => array(
            'de' => 'Willkommen auf der Seite ',
            'en' => 'Welcome to the page '));
    return isset($texts[$key][$language])
        ? $texts[$key][$language]
        : "[$key]";
}
