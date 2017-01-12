<?php
require_once("view/HomeView.php");

// This class is used to manage the products.
class homeController {

    private $model;
    private $view;

    public function __construct() {
        $this->view = new HomeView();
    }

    public function home() {
        $this->view->renderHome();
    }
}
