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

    public function renderCatalogContent() {

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
            echo '<i class="fa fa-plus"></i>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }

        echo '</main>';

    }

}
