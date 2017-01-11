<?php

require_once("helpers/translator.php");
require_once("MainView.php");

class CartView {

   private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
    public function renderCart() {
        MainView::renderMeta("Shopping cart"); // Param is title of the page.
        MainView::renderNavigation("cart");
        $this->renderContent();         
        MainView::renderFooter(); 
    }

    private function renderContent() {

        // Head
        echo '<main>
                <h1>Warenkorb</h1><br/>
                <div class="detail-image">
        <table class="detail-information-image" style="width:100%">
            <tr>
                <th>Product</th>
                <th>Anzahl</th>
                <th>Anzeigen</th>
                <th>Menge</th>
                <th>Entfernen</th>
                <th>Preis</th>
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
                <button onclick="clearCart() "type="button">Warenkorb leeren</button>
                <a href="/checkout/step/1"><button type="button">Warenkorb Bestellen</button></a>
                <br><br>
                </main>';
    }
}
