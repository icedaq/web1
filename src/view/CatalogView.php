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
            echo '<img src="'.$p->getImage().'" alt="Firmen Logo" style="height:80px;" >';
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

        // data
        $product = $this->model->getProductByID($id);

        // Head
        echo '<main>
                <h1>'.$product->getName().'</h1>';

        echo '<div class="item-body">
                <img src="'.$product->getImage().'" alt="'.$product->getName().'" style="width:400px;" >
             </div>
                <div class="detail-image">
            <table class="detail-information-image" style="width:100%">
            <tr>
                <td><b>'.t("description").'</b></td>
                <td>'.$product->getDescription().'</td>
            </tr>
            <tr>
                <td><b>'.t(category).'</b></td>
                <td>'.$product->getCategoryName().'</td>
            </tr>
            <tr>
                <td><b>'.t("price").'</b></td>
                <td>'.$product->getPrice().' CHF</td>
            </tr>
            <tr>
                <td><b>'.t("options").'</b></td>
                <td>'.$this->renderProductOptions($product).'</td>
            </tr>
        </table>
    </div>

    <button id="addToCart" onclick="addToCart('.$product->getId().')" type="button">'.t("buy").'</button>
    </main>';
        
    }

    private function renderProductOptions($p) {
        $output = '<select name="option">'; 
        foreach ($p->getOptions() as $o) {
            $output = $output.'<option value="'.$o.'">'.$o.'</option>';
        }
        $output = $output.'</select>';
        
        return $output; 
    }

}
