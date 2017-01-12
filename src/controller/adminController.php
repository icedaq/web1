<?php
require_once("view/AdminView.php");

// This class is used to manage the products.
class adminController {

    private $view;

    public function __construct() {
        $this->view = new AdminView();
    }

    public function editProduct($id) {
        $this->view->renderEditProductAdmin();
    }
    public function addProduct() {
        $this->view->renderAddProductAdmin();
    }
}
