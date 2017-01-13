<?php

require_once("helpers/translator.php");
require_once("MainView.php");

class CartView {

   private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
    public function renderCart() {
        MainView::renderMeta(t("cart")); // Param is title of the page.
        MainView::renderNavigation("cart");
        $this->renderContent();         
        MainView::renderFooter(); 
    }

    private function renderContent() {

        // Head
        echo '<main>
                <h1>'.t("cart").'</h1><br/>
                <div class="detail-image">
        <table class="detail-information-image" style="width:100%">
            <tr>
                <th>'.t("product").'</th>
                <th>'.t("count").'</th>
                <th>'.t("show").'</th>
                <th>'.t("amount").'</th>
                <th>'.t("delete").'</th>
                <th>'.t("price").'</th>
            </tr>';

        // Per item
        $cart = $this->model->getCart();
        foreach ($cart as $i) {
            if ($i->getAmount() > 0 )
            { 
                echo '<tr class="cartitem" id="'.$i->getId().'">';
                echo '<td>'.$i->getName().'</td>';
                echo '<td class="amount">'.$i->getAmount().'</td>';
                echo '<td><div class="item_list">';
                echo '<a href="/catalog/show/'.$i->getId().'"><i class="fa fa-info"></i></a>';
                echo '</div></td>';
                echo ' <td><div class="item_list">';
                echo '<i onclick="increaseCartItem('.$i->getId().')" class="fa fa-plus"></i>  </a>';
                echo '<i onclick="decreaseCartItem('.$i->getId().')" class="fa fa-minus"></i></a>';
                echo '</div></td>';
                echo '<td><div class="item_list">';
                echo '<i onclick="removeCartItem('.$i->getId().')" class="fa fa-trash-o"></i></a>';
                echo '</div></td>';
                echo '<td class="price">'.$i->getPrice().'</td>';
                echo '</tr>';
            }
        }

        // Total
        echo '<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="cartPrice" class="special"><b>'.$this->model->cartPrice().'</b></td>
            </tr>';
        
        // The End.
        echo '</table>
                </div>
                <br><br>
                <button onclick="clearCart() "type="button">'.t("emptyCart").'</button>
                <a href="/checkout/step/1"><button type="button">'.t("placeOrder").'</button></a>
                <br><br>
                </main>';
    }
}
