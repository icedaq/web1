<?php
require_once("model/ShoppingCart.php");
require_once("model/OrderManager.php");
require_once("model/UserManager.php");
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


            if (($this->id == 1) && (!UserManager::isLoggedIn()))
            {
                header("Location: /users/login");
                exit();
            } else {
                $this->model->addOrder();
            }

            // Second step
            if (($this->id == 2) && (UserManager::isLoggedIn()))
            {
                if(isset($_POST['deliveryMethod']) 
                    &&  isset($_POST['paymentMethod'])
                    &&  isset($_POST['giftbox'])) {
                    
                    $order = $this->model->getCurrentOrder();
                    $order->setShippment($_POST['deliveryMethod']); 
                    $order->setPayment($_POST['paymentMethod']); 
                    $order->setGift($_POST['giftbox']); 
                }
            }

            // Third step
            if (($this->id == 3) && (UserManager::isLoggedIn()))
            {
                if(isset($_POST['comment'])) {
                    $order = $this->model->getCurrentOrder();
                    $order->setComment($_POST['comment']);
                    $order->setCommited(); 
                }
            }

            $this->view->{"renderStep".$this->getId()}();
        }
    }
}
