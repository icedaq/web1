<?php
require_once("model/ShoppingCart.php");
require_once("helpers/translator.php");
require_once("model/User.php");
require_once("model/Catalog.php");
session_start();

// This class contains commonly used html stuff.
class MainView
{

    // Renders the meta stuff of the page.
    public static function renderMeta($title)
    {
        echo '<!DOCTYPE html>
                    <html lang="de">
                        <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
                        <title>ApertureLab - ' . $title . '</title>
                        <link rel="icon" href="/favicon.ico" type="image/x-icon">
                        <link rel="stylesheet" href="/css/reset.css">
                        <link rel="stylesheet" href="/css/style.css">
                        <link rel="stylesheet" href="/css/font-awesome.min.css">
                        <link rel="stylesheet" href="/css/jquery-ui.min.css">
                        <script src="//code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
                        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
                        <script src="//cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
                        <script src="/js/main.js"></script>            
                        </head>';
    }

    public static function renderNavigation($current)
    {

       // $cart = new ShoppingCart();
        $cart = ShoppingCart::load();
        $catalog = new Catalog();
        $saleProduct = $catalog->getProductOnSale();
        
        $username = "Login";
        if (isset($_SESSION['user'])) {
            $username = $_SESSION['user']->getName();
        }

        $selected = array();
        $selectedHtml = "is-site-header-item-selected";
        switch ($current) {
            case "catalog":
                $selected[1] = $selectedHtml;
                break;
            case "cart":
                $selected[2] = $selectedHtml;
                break;
            case "user":
                $selected[3] = $selectedHtml;
                break;
        }

        echo '<body>
              <header>
                  <div class="siteHeader_section">
                      <div class="siteHeader_item_left siteHeaderLogo">
                          <a href="/"><img src="/images/aperture_logo.gif" alt="Logo" style="height:20px;" ></a>
                      </div>
                      <div class="siteHeader_item_left siteHeaderButton ' . $selected[1] . ' ">
                          <a href="/catalog/show">' . t("catalog") . '</a>
                      </div>
                      <div class="siteHeader_item">
                          <input id="searchField" type="text"></input>&nbsp<i class="fa fa-search"></i>
                      </div>
                  </div>
                  <div class="siteHeader_section" id="saleBanner">
                      <div class="siteHeader_item">'.t('sale').': <a href="/catalog/show/'.$saleProduct->getId().'">'.$saleProduct->getName().'</a></div>
                  </div>
                  <div class="siteHeader_section">
                      <div id="setLanDe" class="siteHeader_item_lang_left siteHeaderButton">de</div>&nbsp/&nbsp<div id="setLanEn" class="siteHeader_item_lang_right siteHeaderButton"> en</div>
                      <div class="siteHeader_item_right siteHeaderLogo ' . $selected[2] . '">
                          <a href="/cart/show"><i class="fa fa-shopping-cart"></i> <span id="menuCartCount">'.$cart->cartCount().'</span></a>
                      </div>
                      <div class="siteHeader_item_right siteHeaderLogo '.$selected[3].'">
                          <a href="/users/login"><i class="fa fa-user"></i> <span>'.$username.'</span></a>
                      </div>
                  </div>
              </header>';
    }

    public static function renderFooter()
    {
        echo '<footer class="mainFooter">
                 <p>&copy; 2017 by ApertureLab, 10 Downing Street, London SW1A 2AA, UK</p>
              </footer>
              </body>
              </html>';
    }
}
