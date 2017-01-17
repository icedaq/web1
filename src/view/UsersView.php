<?php
require_once("helpers/translator.php");
require_once("MainView.php");
require_once("model/UserManager.php");

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

        // Admins get a link to the admin page.
        $adminLink = "";
        if (UserManager::isAdmin())
        {
            $adminLink = '<h2><a href="/admin/show">Go to Admin Page!</a></h2>';
        }

        echo '<main>';
        echo  '<h1>'.t("welcomeUser").$user->getFirstName().'</h1>';
        echo $adminLink;
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

        MainView::renderMeta(t("register")); // Param is title of the page.
        MainView::renderNavigation("user");
        $this->renderSignUpContent();         
        MainView::renderFooter(); 
    }


    private function renderSignUpContent() {
    
        echo '<main>';
        echo  '<h1>'.t("register").'</h1>';
        echo '<form id="register" action="/users/signup" method="post">';
        echo '<label><b>'.t("username").'</b></label>';
        echo '<input name="login" required>';
        echo '<label><b>'.t("password").'</b></label>';
        echo '<input type="password" name="password" required>';
        echo '<label><b>'.t("firstName").'</b></label>';
        echo '<input name="firstName" required>';
        echo '<label><b>'.t("lastName").'</b></label>';
        echo '<input name="lastName" required>';
        echo '<label><b>'.t("email").'</b></label>';
        echo '<input name="email" required>';
        echo '<label><b>'.t("street").'</b></label>';
        echo '<input name="street" required>';
        echo '<label><b>'.t("houseNr").'</b></label>';
        echo '<input name="houseNumber" type="number" required>';
        echo '<label><b>'.t("city").'</b></label>';
        echo '<input name="city">';
        echo '<label><b>'.t("zip").'</b></label>';
        echo '<input name="zip" type="number">'; // 4-5
        echo '<label><b>'.t("country").'</b></label>';
        echo '<select name="country">';
        echo '  <option value="ch">'.t("countryCH").'</option>';
        echo '  <option value="de">'.t("countryDE").'</option>';
        echo '  <option value="at">'.t("countryAT").'</option>';
        echo '</select>'; 
        echo '<input type="submit" value="'.t("register").'">';
        echo '</form>';
        echo '</main>';
        echo '<script> setupValidation(); </script>'; // Setup the validation for this form.
    
    }

}
