<?php

require_once("helpers/translator.php");
require_once("MainView.php");

class CheckoutView {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function renderStep1(){
        MainView::renderMeta("Checkout Step 1"); // Param is title of the page.
        MainView::renderNavigation("cart");
        $this->renderCheckoutStep1Content();         
        MainView::renderFooter(); 
    }
    
    private function renderCheckoutStep1Content() {
        echo "JES!";
    }

}
