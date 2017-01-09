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
                        </head>
                        <body>';
    }

    // Todo: Highlight current menu item.
    //is-site-header-item-selected"
    public static function renderNavigation($current) {
      echo       '<div class="siteHeader">
                        <div class="siteHeader__section">
                            <div class="siteHeader__item siteHeaderLogo">
                                <img src="../images/aperture_logo.gif" alt="Firmen Logo" style="height:20px;" >
                            </div>';

            if ($current == "catalog") {
            echo '                  <div class="siteHeader__item siteHeaderButton">Action</div>
                                    <div class="siteHeader__item siteHeaderButton is-site-header-item-selected ">Catalog</div>';
            } else {
            echo '                  <div class="siteHeader__item siteHeaderButton">Action</div>
                                    <div class="siteHeader__item siteHeaderButton">Catalog</div>';
            }
            echo '                <div class="siteHeader__item siteHeaderButton"><label>Search</label> <input type="text">
                                </input></div>
                            <div class="siteHeader__item siteHeaderLogo">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <!-- This section gets pushed to the right side-->
                        <div class="siteHeader__section">
                            <div class="siteHeader__item siteHeaderButton">de</div>
                            <div class="siteHeader__item siteHeaderButton">en</div>
                            <div class="siteHeader__item siteHeaderLogo is-site-header-item-selected">
                                <i class="fa fa-shopping-cart"></i>
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
