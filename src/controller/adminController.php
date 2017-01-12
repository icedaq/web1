<?php
require_once("view/AdminView.php");
require_once("model/UserManager.php");
session_start();

// This class is used to manage the products.
class adminController {

    private $view;

    public function __construct() {
        $this->view = new AdminView();
    }

    public function show() {
        if (UserManager::isAdmin())
        {
            $this->view->renderAdmin();
        } else {
            $this->view->renderAdminUnauthorized();
        }
}
