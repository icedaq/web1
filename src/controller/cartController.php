<?php
require_once("model/ShoppingCart.php");
require_once("view/CartView.php");
session_start();

// This class is used to manage the products.
class cartController {

    private $model;
    private $view;
    private $id;
    private $params;

    public function __construct() {
        $this->model = ShoppingCart::load();
        $this->view = new CartView($this->model);
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
            $this->model->updateProduct($this->params['prodId'], $this->params['quantity']);
        }
    }

    public function show() {
        $this->view->renderCart();
    }

    // Empty the cart!
    public function clear() {
        $this->model->clearCart();
    }

}
