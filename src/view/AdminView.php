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
        MainView::renderMeta("Admin"); // Param is title of the page.
        MainView::renderNavigation("Admin");
        $this->renderContent();
        MainView::renderFooter();
    }
    
    public function renderAdminUnauthorized() {
        MainView::renderMeta("Admin"); // Param is title of the page.
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
                <h1>Adminbereich</h1>
                <h2>Produkte</h2>
                <form action="/catalog/add" id="addProduct" style="min-width: 20em;">
                    <label style="font-weight: bold;" form="person">Produkte-Erfassung</label>
                    <label>Name</label>
                    <input type="text" name="name" required>

                    <label>Price</label>
                    <input type="number" name="price" required>

                    <label>Description</label>
                    <input type="text" name="description">
            
                    <label form="image">Image</label>
                    <input type="text" name="image" id="imagepfad" maxlength="80">
            
                    <label form="categorie">Category</label>
                    '.$this->renderCategorySelect().'
                    <label form="option">Options</label>
                    '.$this->renderProductOptions().'
                    <button style="min-width: 20em;" type="submit">Produkt speichern</button>
                </form>
                <h2>Sale</h2>
                <form action="/catalog/sale" id="setSale" method="POST">
                    <label style="font-weight: bold;" form="person">Product on sale</label>
            
                    '.$this->renderProductsSelect().'
                    <button style="min-width: 20em;" type="submit">Save</button>
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
