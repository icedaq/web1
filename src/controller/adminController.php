<?php
require_once("view/AdminView.php");

// This class is used to manage the products.
class adminController {

    private $view;

    public function __construct() {
        $this->view = new AdminView();
    }

    public function show() {
        $this->view->renderAdmin();
    }
}
