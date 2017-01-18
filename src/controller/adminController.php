<?php
require_once("view/AdminView.php");
require_once("model/UserManager.php");
require_once("model/Mailer.php");
session_start();

// This class is used to manage the products.
class adminController {

    private $view;

    public function __construct() {
        $this->view = new AdminView();
    }

    public function show()
    {
        if (UserManager::isAdmin()) {
            $this->view->renderAdmin();
        } else {
            $this->view->renderAdminUnauthorized();
        }
    }
    public function mailtest()
    {
        if (UserManager::isAdmin()) {
            echo "Sending mail!";
            #Mailer::sendMail("test@example.com", 'Thank you for your order!');
        } else {
            $this->view->renderAdminUnauthorized();
        }
    }
}
