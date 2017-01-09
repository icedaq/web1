<?php

require_once("helpers/translator.php");
require_once("MainView.php");

class HomeView {

    public function renderHome() {

        MainView::renderMeta("Home"); // Param is title of the page.
        MainView::renderNavigation("home");
        $this->renderContent();         
        MainView::renderFooter(); 
    }

    private function renderContent() {
    echo '<main>
            <h1>Home</h1>
                <br/><br/>
                <p>Welcome to the Webpage! Wir hoffen dass sie alles was sie suchen finden und wir ihnen zum perfekten Bild verhelfen können! Geniessen sie die gelungenen Werke!</p>
          </main>';
    }

}
