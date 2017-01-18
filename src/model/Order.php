<?php
require_once("Mailer.php");

// An order.
class Order {

    private $id;
    private $cart;
    private $user;
    private $shipping;
    private $payment;
    private $gift;
    private $comment; 
    private $commited;

    public function __construct($cart, $user) {
        $this->cart = $cart;
        $this->user = $user;
    }

	public function getId() {
		return $this->itemID;
    }

    public function getUser() {
		return $this->user;
    }

    public function getCart() {
		return $this->cart;
    }

    public function setShipping($shipping) {
        $this->shipping = $shipping;
    }
    
    public function setPayment($payment) {
        $this->payment = $payment;
    }
    
    public function setGift($gift) {
        $this->gift = $gift;
    }
    
    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setCommited() {
        $this->commited = true;
        Mailer::sendMail($this->user->getMail(), 'Thank you for your order!');
    }

}
