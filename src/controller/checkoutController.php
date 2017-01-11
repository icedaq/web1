<?php
require_once("model/OrderManager.php");
require_once("view/CheckoutView.php");
session_start();

// This class is used to manage the products.
class checkoutController {

    private $model;
    private $view;
    private $id; // This is the current step.

    public function __construct() {
        $this->model = new OrderManager();
        $this->view = new CheckoutView($this->model);

    }

    public function setId($id) {
        $this->id =$id;
    }

    public function getId() {
        return $this->id;
    }

    public function step() {
        if ($this->id == null)
        {
            header("Location: /checkout/step/1");
            exit();
        } else {
            $this->view->{"renderStep".$this->getId()}();
        }
    }
}
