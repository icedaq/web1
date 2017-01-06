<?php
session_start();

require_once("model/ShoppingCart.php");
require_once("view/CartView.php");

// This class is used to manage the products.
class cartController {

    private $model;
    private $view;
    private $id;
    private $params;

    public function __construct() {
        $this->model = new ShoppingCart();
        $this->view = new CartView();
    }

    public function setId($id) {
        $this->id =$id;
    }

    public function setParams($params) {
        $this->params =$params;
    }

    public function consumeId() {
        $theid = $this->id;
        $this->id = null;
        return $theid;
    }

    public function add() {
        if (isset($this->params['prodId']) && isset($this->params['quantity'])) {
            $this->model->addProduct($this->params['prodId'], $this->params['quantity']);
        }
    }
    
}
