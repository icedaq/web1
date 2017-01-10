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
                <h1>Warenkorb Übersicht</h1><br/>
                <p>Auf dieser Seite sehen sie eine Übersicht aller Bildkategorien, welche sie ausgewählt haben. Wenn Sie auf das Plus Symbol klicken erhalten sie eine Detailansicht des gewählten Bildes und sie können es aus ihrem Warenkorb entfernen.</p><br/>
                <div class="detail-image">
        <h2>Informationen im Überblick</h2>
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
                echo '<tr>';
                echo '<td>'.$i->getName().'</td>';
                echo '<td id="amount'.$i->getId().'">'.$i->getAmount().'</td>';
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
                echo '<td id=price"'.$i->getId().'">'.$i->getPrice().'</td>';
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
                <td class="special"><b>'.$this->model->cartPrice().'</b></td>
            </tr>';
        
        // The End.
        echo '</table>
                </div>
                <br><br>
                <button onclick="clearCart() "type="button">Warenkorb leeren</button>
                <button type="button">Bestellung absenden</button>
                <br><br>
                </main>';
    }
}
