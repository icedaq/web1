<?php

require_once("helpers/translator.php");

// This class contains commonly used html stuff.
class MainView {

    // Renders the meta stuff of the page.
    public static function renderMeta($title) {
      echo         '<!DOCTYPE html>
                    <html lang="de">
                        <head>
                        <meta charset="UTF-8">
                        <title>ApertureLab - '.$title.'</title>
                        <link rel="icon" href="../favicon.ico" type="image/x-icon">
                        <link rel="stylesheet" href="../css/reset.css">
                        <link rel="stylesheet" href="../css/style.css">
                        <link rel="stylesheet" href="../css/font-awesome.min.css">
                        <script   src="https://code.jquery.com/jquery-3.1.1.min.js"
                            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
                            crossorigin="anonymous"></script>        
                        <script src="/js/main.js"></script>            
                        </head>
                        <body>';
    }

    public static function renderNavigation($current) {

        $selected = array();
        $selectedHtml = "is-site-header-item-selected";
        switch($current) {
            case "catalog":
                $selected[1] = $selectedHtml;
                break;
            case "cart":
                $selected[2] = $selectedHtml;
                break;
        }
        
        echo       '<div class="siteHeader">
                        <div class="siteHeader__section">
                            <div class="siteHeader__item siteHeaderLogo">
                            <a href="/">
                                <img src="../images/aperture_logo.gif" alt="Logo" style="height:20px;" >
                            </a>
                            </div>
                              <div class="siteHeader__item siteHeaderButton">Action</div>
                                    <div class="siteHeader__item siteHeaderButton '.$selected[1].' "><a href="/catalog/show">'.t("catalog").'</a></div>
                      <div class="siteHeader__item siteHeaderButton"><label>Search</label> <input type="text">
                                </input></div>
                            <div class="siteHeader__item siteHeaderLogo">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <!-- This section gets pushed to the right side-->
                        <div class="siteHeader__section">
                            <div id="setLanDe" class="siteHeader__item siteHeaderButton">de</div>
                            <div id="setLanEn" class="siteHeader__item siteHeaderButton">en</div>
                            <div class="siteHeader__item siteHeaderLogo '.$selected[2].'">
                                <a href="/cart/show"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                            <div class="siteHeader__item siteHeaderLogo">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                    </div>'; 
    }

    public static function renderFooter() {
    echo        '<div class="formFooter">
                    <p>&copy; 2017 by Pascal Liniger and Louis Siegrist</p>
                </div>
                </body>
                </html>';
    }
}
