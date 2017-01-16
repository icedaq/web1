<?php
require_once("helpers/translator.php");
require_once("MainView.php");

class AdminView
{

    private $catalog;

    public function __construct() {
        $this->catalog = new Catalog();
    }

    public function renderAdmin() {
        MainView::renderMeta(t("admin")); // Param is title of the page.
        MainView::renderNavigation("Admin");
        $this->renderContent();
        MainView::renderFooter();
    }
    
    public function renderAdminUnauthorized() {
        MainView::renderMeta(t("admin")); // Param is title of the page.
        MainView::renderNavigation("Admin");
        $this->renderUnauthorizedContent();
        MainView::renderFooter();
    }

    private function renderUnauthorizedContent() {
        echo '<main>';
        echo '<h1>You are unauthorized to view this page!</h1>';
        echo '</main>';
    }


    //public function $category, $image, $sale=FALSE) {
    private function renderContent() {

        echo '<main>
                <h1>'.t("admin").'</h1>
                <h2>'.t("products").'</h2>
                <form action="/catalog/add" id="addProduct" method="POST" style="min-width: 20em;">
                    <label style="font-weight: bold;" form="person">'.t("productAdd").'</label>
                    <label>'.t("name").'</label>
                    <input type="text" name="name" required>

                    <label>'.t("price").'</label>
                    <input type="number" name="price" required>

                    <label>'.t("description").'</label>
                    <input type="text" name="description">
            
                    <label form="image">'.t("image").'</label>
                    <input type="text" name="image" id="imagepfad" maxlength="80">
            
                    <label form="categorie">'.t("category").'</label>
                    '.$this->renderCategorySelect().'
                    <label form="option">'.t("options").'</label>
                    '.$this->renderProductOptions().'
                    <button style="min-width: 20em;" type="submit">'.t("productSave").'</button>
                </form>
                <form action="/catalog/delete" id="deleteProduct" method="POST" style="min-width: 20em;">
                    <label style="font-weight: bold;" form="person">'.t("productRemove").'</label>
                    <label>'.t("productId").'</label>
                    <input type="text" name="name" required>
                    <button style="min-width: 20em;" type="submit">'.t("productSave").'</button>
                </form>
                <h2>Sale</h2>
                <form action="/catalog/sale" id="setSale" method="POST">
                    <label style="font-weight: bold;" form="person">'.t("productOnSale").'</label>
            
                    '.$this->renderProductsSelect().'
                    <button style="min-width: 20em;" type="submit">'.t("save").'</button>
                </form>
               </main>';
    }

    private function renderProductsSelect() {
        $output = '<select name="productId">'; 
        foreach ($this->catalog->getProducts() as $p) {
            $output = $output.'<option value="'.$p->getId().'">'.$p->getName().'</option>';
        }
        $output = $output.'</select>';
        
        return $output; 
    }


    private function renderProductOptions() {
        $output = '<select multiple name="options">'; 
        foreach ($this->catalog->getOptions() as $o) {
            $output = $output.'<option value="'.$o.'">'.$o.'</option>';
        }
        $output = $output.'</select>';
        
        return $output; 
    }

    private function renderCategorySelect() {
        $output = '<select id="categorySelect" name="category">';
        foreach ($this->catalog->getCategories() as $c) {
            $output = $output.'<option value="'.$c["id"].'">'.$c["name"].'</option>';
        }
        $output = $output.'</select>';
        
        return $output; 
    }
}
