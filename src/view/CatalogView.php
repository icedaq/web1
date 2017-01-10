<?php

require_once("helpers/translator.php");
require_once("MainView.php");

class CatalogView {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
    public function renderCatalog() {
        MainView::renderMeta("Catalog"); // Param is title of the page.
        MainView::renderNavigation("catalog");
        $this->renderCatalogContent();         
        MainView::renderFooter(); 
    }

    public function renderProduct($id) {
        MainView::renderMeta("Product"); // Param is title of the page.
        MainView::renderNavigation("catalog");
        $this->renderProductContent($id);         
        MainView::renderFooter(); 
    } 

    private function renderCatalogContent() {

        // Head
        echo '<main>
        <h1>Katalog Übersicht</h1><br/>
        <p>Auf dieser Seite sehen sie eine Übersicht aller Bildkategorien, welche unsere Webseite führt. Wenn Sie auf das Plus Symbol klicken erhalten sie eine Detailansicht des gewählten Bildes und sie können es ihrem Warenkorb hinzufügen.</p><br/>';

       $products = $this->model->getProducts();
        foreach ($products as $p) {
            echo '<div class="item-wrapper ">';
            echo '<div class="item relative">';
            echo '<div class="item-header text-center">';
            echo $p->getName();
            echo '</div>';
            echo '<div class="item-body">';
            echo '<img src="../images/aperture_logo.gif" alt="Firmen Logo" style="height:80px;" >';
            echo '</div>';
            echo '<div class="add-icon">';
            echo '<a href="/catalog/show/'.$p->getId().'"><i class="fa fa-plus"></i></a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '</main>';
    }

    // Show details of one product.
    private function renderProductContent($id) {
        // Head
        echo '<main>
                <h1>Produkt Details</h1><br/>
                <p>Nun erfahren sie mehr zu dem ausgewählten Bild. Wir hoffen ihne gefällt ihre Wahl. Um den Kauf abzuschliessen müssen sie das Produkt dem Warenkorb zufügen.</p><br/>';

        $product = $this->model->getProductByID($id);
        echo '<div class="item-body">
                <img src="'.$product->getImage().'" alt="Firmen Logo" style="width:400px;" >
             </div>
                <div class="detail-image">
                    <h2>Informationen im Überblick</h2>
                    <p><br/>'.$product->getName().'</p>
            <table class="detail-information-image" style="width:100%">
            <tr>
                <td>'.t("description").'</td>
                <td>'.$product->getDescription().'</td>
            </tr>
            <tr>
                <td>'.t(category).'</td>
                <td>'.$product->getCategoryName().'</td>
            </tr>
            <tr>
                <td>'.t("price").'</td>
                <td>'.$product->getPrice().' CHF</td>
            </tr>
        </table>
    </div>

    <button onclick="addToCart('.$product->getId().')" type="button">'.t("buy").'</button>
    </main>';
        
    }

}
