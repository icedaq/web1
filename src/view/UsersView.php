<?php
require_once("helpers/translator.php");
require_once("MainView.php");

class UsersView {

    public function renderLogin() {
        MainView::renderMeta("Login"); // Param is title of the page.
        MainView::renderNavigation("user");
        $this->renderLoginContent();         
        MainView::renderFooter(); 
    }

    public function renderLoginFail() {
        MainView::renderMeta("Login"); // Param is title of the page.
        MainView::renderNavigation("user");
        $this->renderLoginFailContent();         
        MainView::renderFooter(); 
    }

    public function renderLoginSuccess($user) {
        MainView::renderMeta("Login"); // Param is title of the page.
        MainView::renderNavigation("user");
        $this->renderLoginSuccessContent($user);         
        MainView::renderFooter(); 
    }

    private function renderLoginSuccessContent($user) {
        echo '<main>';
        echo  '<h1>'.t("welcomeUser").$user->getFirstName().'</h1>';
        echo '</main>';
    }

    private function renderLoginContent() {
        echo '<main>';
        echo  '<h1>'.t("login").'</h1>';
        echo '<form action="/users/login" method="post">';
        echo '<div class="loginElement"><label>'.t('username').'</label></br>';
        echo '<input name="login"></div>';
        echo '<label>'.t("password").'</label>';
        echo '<input type="password" name="password">';
        echo '<input type="submit" value="'.t("login").'">';
        echo '</form>';
        echo '</main>';
    }

    private function renderLoginFailContent() {
        echo '<main>';
        echo  '<h1>'.t("login").'</h1>';
        echo '<h2>'.t("loginFailed").'</h2>';
        echo '<form action="/users/login" method="post">';
        echo '<div class="loginElement"><label>'.t('username').'</label></br>';
        echo '<input name="login"></div>';
        echo '<label>'.t("password").'</label>';
        echo '<input type="password" name="password">';
        echo '<input type="submit" value="'.t("login").'">';
        echo '</form>';
        echo '</main>';
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
