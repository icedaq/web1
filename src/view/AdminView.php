<?php
require_once("helpers/translator.php");
require_once("MainView.php");

class AdminView
{

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

    private function renderContent() {
        echo '<main>
                <h1>Adminbereich</h1>
                <h2>Produkte</h2>
                    <p>In dieser Ansicht können sie die weitere Produkte hinzufügen.</p>
                <form action="$save new Produkt" id="produkt" style="min-width: 20em;">
                    <label style="font-weight: bold;" form="person">Produkte-Erfassung</label>
                    <label form="description">Beschreibung</label>
                    <input type="text" name="description" id="description" maxlength="120">
            
                    <label form="image">Bildpfad</label>
                    <input type="text" name="imagepfad" id="imagepfad" maxlength="80">
            
                    <label form="categorie">Kategorie</label><select>
                    <option value="Landscape">Landscape</option>
                    <option value="$categorie">$categorie</option>
                    <option value="$categorie">$categorie</option>
                    <option value="$categorie">$categorie</option>
                    <option value="$categorie">$categorie</option>
                </select>
                    <label form="price">Preis</label>
                    <input type="number" name="price" id="price" maxlength="20">
                    <label form="option">Option</label><select>
                    <option value="$option">Beispiel Option</option>
                    <option value="$option">$option</option>
                    <option value="$option">$option</option>
                    <option value="$option">$option</option>
                    <option value="$option">$option</option>
                </select>
                    <button style="min-width: 20em;" type="submit">Produkt speichern</button>
                </form>
               </main>';
    }

    private function renderEditProductContent($id) {

        $product = $this->model->getProductByID($id);


        echo '<main>
                <h1>'.t("adminProduct").'</h1>
                <h2>'.t("adminProductEdit").'</h2>
                <br/><br/>
                <form action="$save new Produkt" id="produkt" style="min-width: 20em;">
                    <label style="font-weight: bold;" form="person">Produkte-Erfassung</label>
                    <label form="description">Beschreibung</label>
                    <input type="text" name="description" id="description" maxlength="120">
            
                    <label form="image">Bildpfad</label>
                    <input type="text" name="imagepfad" id="imagepfad" maxlength="80">
            
                    <label form="categorie">Kategorie</label><select>
                    <option value="Landscape">Landscape</option>
                    <option value="$categorie">$categorie</option>
                    <option value="$categorie">$categorie</option>
                    <option value="$categorie">$categorie</option>
                    <option value="$categorie">$categorie</option>
                </select>
                    <label form="price">Preis</label>
                    <input type="number" name="price" id="price" maxlength="20">
                    <label form="option">Option</label><select>
                    <option value="$option">Beispiel Option</option>
                    <option value="$option">$option</option>
                    <option value="$option">$option</option>
                    <option value="$option">$option</option>
                    <option value="$option">$option</option>
                </select>
                    <button style="min-width: 20em;" type="submit">Produkt speichern</button>
                </form>
               </main>';
    }

    private function renderSaleContent() {
        echo '<main>
                <h1>'.t("adminSale").'</h1>
                <br/><br/>
                ToDo
               </main>';
    }

    private function renderOrdersContent() {
        echo '<main>
                <h1>'.t("adminOrders").'</h1>
                <br/><br/>
                ToDo
               </main>';
    }

}
