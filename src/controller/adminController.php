<?php
require_once("view/AdminView.php");

// This class is used to manage the products.
class adminController {

    private $view;

    public function __construct() {
        $this->view = new AdminView();
    }

    public function editProduct($id) {
        $this->view->renderAdminEditProduct($id);
    }

    public function addProduct() {
        $this->view->renderAdminAddProduct();
    }

    public function sales() {
        $this->view->renderAdminSales();
    }
}
