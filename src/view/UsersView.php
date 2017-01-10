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

    // TODO: Reduce this!
    private function renderLoginSuccessContent($user) {
        echo '<main>';
        echo  '<h1>'.t("welcomeUser").$user->getFirstName().'</h1>';
        echo '<form action="/users/logout" method="post">';
        echo '<input type="submit" value="'.t("logout").'">';
        echo '</form>';
        echo '</main>';
    }

    private function renderLoginContent() {
        echo '<main>';
        echo  '<h1>'.t("login").'</h1>';
        echo '<form action="/users/login" method="post">';
        echo '<label>'.t('username').'</label>';
        echo '<input name="login">';
        echo '<label>'.t("password").'</label>';
        echo '<input type="password" name="password">';
        echo '<input type="submit" value="'.t("login").'">';
        echo '</form>';
        echo '<div class="registerButton"><a href="/users/signup">'.t("registerLink").'</a></div>';
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

        MainView::renderMeta("Register"); // Param is title of the page.
        MainView::renderNavigation("user");
        $this->renderSignUpContent();         
        MainView::renderFooter(); 
    }


    private function renderSignUpContent() {
    
        echo '<main>';
        echo  '<h1>'.t("register").'</h3>';
        echo '<form action="/users/signup" method="post">';
        echo '<label>'.t("username").'</label>';
        echo '<input name="login">';
        echo '<label>'.t("password").'</label>';
        echo '<input type="password" name="password">';
        echo '<label>'.t("firstName").'</label>';
        echo '<input name="firstName">';
        echo '<label>'.t("lastName").'</label>';
        echo '<input name="lastName">';
        echo '<label>'.t("street").'</label>';
        echo '<input name="street">';
        echo '<label>'.t("houseNr").'</label>';
        echo '<input name="houseNumber" type="number">';
        echo '<label>'.t("city").'</label>';
        echo '<input name="city">';
        echo '<label>'.t("zip").'</label>';
        echo '<input name="zip" type="number">';
        echo '<label>'.t("country").'</label>';
        echo '<input name="country">';
        echo '<input type="submit" value="'.t("register").'">';
        echo '</form>';
        echo '</main>';
    
    }

}
