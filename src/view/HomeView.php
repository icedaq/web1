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
            <h1>'.t("welcomeTo").'</h1>
            <img src="/images/aperture_logo.gif" alt="Logo" style="height:100px;">
          </main>';
    }

}
