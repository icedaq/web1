<?php
require_once("helpers/translator.php");
require_once("MainView.php");
require_once("model/Order.php");
require_once("model/User.php");

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

    public function renderStep2(){
        MainView::renderMeta("Checkout Step 2"); // Param is title of the page.
        MainView::renderNavigation("cart");
        $this->renderCheckoutStep2Content();         
        MainView::renderFooter(); 
    }

    public function renderStep3(){
        MainView::renderMeta("Order confirmation"); // Param is title of the page.
        MainView::renderNavigation("cart");
        $this->renderCheckoutStep3Content();         
        MainView::renderFooter(); 
    }

    private function renderCheckoutStep1Content() {
        echo '<main>';
        echo '<h1>'.t("checkoutTitle1").'</h1>';
        echo '<form id="checkout1" action="/checkout/step/2" method="post">';
        echo '<label><b>'.t("deliveryMethod").'</b></label>';
        echo '<div class="line"><input type="radio" name="deliveryMethod" value="normal" required>Normal';
        echo '<input type="radio" name="deliveryMethod" value="express" required>Express</div>';
        echo '<label><b>'.t("paymentMethod").'</b></label>';
        echo '<div class="line"><input type="radio" name="paymentMethod" value="prepaid">'.t("prepaid");
        echo '<input type="radio" name="paymentMethod" value="invoice" required>'.t("invoice").'</div>';
        echo '<label><b>'.t("options").'</b></label>';
        echo '<div class="line"><input type="checkbox" name="giftbox" value="giftbox">'.t("giftbox").'</div>';
        echo '<input type="submit" value="'.t("next").'">';
        echo '</form>';
        echo '</main>';
    }

    private function renderCheckoutStep2Content() {

        $user = $this->model->getCurrentOrder()->getUser();

        echo '<main>';
        echo '<h1>'.t("checkoutTitle2").'</h1>';
        echo '<form id="checkout2" action="/checkout/step/3" method="post">';
        echo '<label><b>'.t("shippingAddress").'</b></label>';
        echo '<div class="line">'.$user->getLastName().' '.$user->getFirstName().'<br>'.$user->getStreet().' '.$user->getHouseNumber().'<br>'.$user->getZip().' '.$user->getCity().'</div>';
        echo '<label><b>'.t("comment").'</b></label>';
        echo '<textarea rows="5" cols="20" name="comment" ></textarea>';
        echo '<button type="button" onclick="confirmOrder()">'.t("placeOrder").'</button>';
        echo '</form>';
        echo '</main>';
        // Some html for the confirmation dialog.
        echo '<div id="dialog-confirm" title="Place order?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>This is a binding contract. Do you really want to place this order?</p>
</div>';

    }

    private function renderCheckoutStep3Content() {
        echo '<main>';
        echo '<h1>'.t("checkoutTitle3").'</h1>';
        echo '<p>Thank you for your order! You will receive an email confirmation shortly!</p>';
        echo '</main>';
    }

}
