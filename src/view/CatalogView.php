<?php
require_once("helpers/translator.php");
require_once("MainView.php");

class CatalogView {

    private $model;

    public function __construct($model) {
        $this->model = $model;
    }
    
    public function renderCatalog() {
        MainView::renderMeta(t("catalog")); // Param is title of the page.
        MainView::renderNavigation("catalog");
        $this->renderCatalogContent();         
        MainView::renderFooter(); 
    }

    public function renderProduct($id) {
        MainView::renderMeta(t("product")); // Param is title of the page.
        MainView::renderNavigation("catalog");
        $this->renderProductContent($id);         
        MainView::renderFooter(); 
    } 

    private function renderCatalogContent() {

        // Head
        echo '<main>
        <h1>' . t("catalog") . '</h1>
        <div id="catSelect">' . t("selectCategory") . ' ' . $this->renderCategorySelect().'</div>';

       $products = $this->model->getProducts();
        foreach ($products as $p) {
            echo '<div class="item-wrapper" category="'.$p->getCategory().'">';
            echo '<a href="/catalog/show/'.$p->getId().'"><div class="item relative">';
            echo '<div class="item-header text-center">';
            echo $p->getName();
            echo '</div>';
            echo '<div class="item-body">';
            echo '<img src="/helpers/images.php?size=thumb&path='.urlencode($p->getImage()).'" alt="'.$p->getName().'">';
            echo '</div></a>';
            echo '<div class="add-icon" onclick="increaseCartItem('.$p->getId().')">';
            echo '<i class="fa fa-plus"></i>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</main>';
    }

    private function renderCategorySelect() {
        $output = '<select id="categorySelect" onchange="filterProducts()" name="category">';
        $output = $output.'<option value="0">All</option>';
        foreach ($this->model->getCategories() as $c) {
            $output = $output.'<option value="'.$c["id"].'">'.$c["name"].'</option>';
        }
        $output = $output.'</select>';
        
        return $output; 
    }

    // Show details of one product.
    private function renderProductContent($id) {

        // data
        $product = $this->model->getProductByID($id);

        // If the product is on sale, we adjust the price line.
        // string number_format ( float $number , int $decimals = 0 , string $dec_point = "." , string $thousands_sep = "," )
        $saleLine = '<td>'.number_format($product->getPrice(), 2, '.', "'").' CHF</td>';
        if ($product->getSale()) {
            $saleLine = '<td><span class="saleOld">'.number_format($product->getPrice(), 2, '.', "'").'</span> <span class="sale">'.number_format($product->getSalePrice(), 2, '.', "'").' CHF</sale></td>';
        }

        // Head
        echo '<main>
                <h1>'.$product->getName().'</h1>';
        echo '
                <img src="/helpers/images.php?size=medium&path='.urlencode($product->getImage()).'" alt="'.$product->getName().'">
                <div class="detail-image">
            <table class="detail-information-image" style="width:100%">
            <tr>
                <td><b>'.t("description").'</b></td>
                <td>'.$product->getDescription().'</td>
            </tr>
            <tr>
                <td><b>'.t("category").'</b></td>
                <td>'.$product->getCategoryName().'</td>
            </tr>
            <tr>
                <td><b>'.t("price").'</b></td>
                '.$saleLine.'
            </tr>
            <tr>
                <td><b>'.t("options").'</b></td>
                <td>'.$this->renderProductOptions($product).'</td>
            </tr>
        </table>
    </div>

    <button id="addToCart" onclick="increaseCartItem('.$product->getId().')" type="button">'.t("buy").'</button>
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
