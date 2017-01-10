<?php

require_once("helpers/translator.php");

class UsersView {

    public function renderLogin() {
        MainView::renderMeta("Login"); // Param is title of the page.
        MainView::renderNavigation("cart");
        $this->renderContent();         
        MainView::renderFooter(); 
        echo '<!DOCTYPE html>';
        echo '<body>';
        echo  '<h3>Please Login</h3>';
        echo '<form action="/users/login" method="post">';
        echo '<p>';
        echo '<label>Login</label>';
        echo '<input name="login">';
        echo '</p>';
        echo '<p>';
        echo '<label>Password</label>';
        echo '<input type="password" name="password">';
        echo '</p>';
        echo '<p>';
        echo '<input type="submit" value="Login">';
        echo '</p>';
        echo '</form>';
        echo '</body>';
    }

    public function renderSignUp() {

        // Just a test.
        //setcookie("language", "de");

        echo '<!DOCTYPE html>';
        echo '<body>';
        echo  '<h3>Please fill out:</h3>';
        echo '<form action="/users/signup" method="post">';
        echo '<p>';
        echo '<label>Login</label>';
        echo '<input name="login">';
        echo '</p>';
        echo '<p>';
        echo '<label>Password</label>';
        echo '<input type="password" name="password">';
        echo '</p>';
        echo '<p>';
        echo '<label>First name</label>';
        echo '<input name="firstName">';
        echo '</p>';
        echo '<p>';
        echo '<label>Last name</label>';
        echo '<input name="lastName">';
        echo '</p>';
        echo '<p>';
        echo '<label>Street</label>';
        echo '<input name="street">';
        echo '</p>';
        echo '<p>';
        echo '<label>'.t("houseNr").'</label>';
        echo '<input name="houseNumber">';
        echo '</p>';
        echo '<p>';
        echo '<label>City</label>';
        echo '<input name="city">';
        echo '</p>';
        echo '<p>';
        echo '<label>Zip code</label>';
        echo '<input name="zip">';
        echo '</p>';
        echo '<p>';
        echo '<input type="submit" value="Login">';
        echo '</p>';
        echo '</form>';
        echo '</body>';
    }

}
