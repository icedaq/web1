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

    private function renderContent() {
        echo '<main>
                <h1>Adminbereich</h1>
                <h2>Produkte</h2>
                <br/><br/>
                <p style="width: 100%;">In dieser Ansicht können sie die weitere Produkte hinzufügen.</p>
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
                <br/><br/>
                <h2>Aktionen</h2>
                <br/><br/>
                ToDo
                <br/><br/>
                <h2>Bestellungen</h2>
                <br/><br/>
                ToDo
               </main>';
    }

}
