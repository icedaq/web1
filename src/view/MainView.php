<?php
require_once("helpers/translator.php");
require_once("model/User.php");
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
                        <link rel="icon" href="../favicon.ico" type="image/x-icon">
                        <link rel="stylesheet" href="/css/reset.css">
                        <link rel="stylesheet" href="/css/style.css">
                        <link rel="stylesheet" href="/css/font-awesome.min.css">
                        <link rel="stylesheet" href="/css/jquery-ui.min.css">
                        <script src="//code.jquery.com/jquery-3.1.1.min.js"
                            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
                            crossorigin="anonymous"></script>
                        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
                        <script src="//cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
                        <script src="/js/main.js"></script>            
                        </head>
                        <body>';
    }

    public static function renderNavigation($current)
    {

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

        echo '<div class="siteHeader">
                        <div class="siteHeader__section">
                            <div class="siteHeader__item siteHeaderLogo">
                            <a href="/">
                                <img src="/images/aperture_logo.gif" alt="Logo" style="height:20px;" >
                            </a>
                            </div>
                              <div class="siteHeader__item siteHeaderButton">Action</div>
                                    <div class="siteHeader__item siteHeaderButton ' . $selected[1] . ' "><a href="/catalog/show">' . t("catalog") . '</a></div>
                      <div class="siteHeader__item siteHeaderButton"><label>Search</label> <input id="searchField" type="text">
                                </input></div>
                            <div class="siteHeader__item siteHeaderLogo">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <!-- This section gets pushed to the right side-->
                        <div class="siteHeader__section">
                            <div id="setLanDe" class="siteHeader__item siteHeaderButton">de</div>
                            <div id="setLanEn" class="siteHeader__item siteHeaderButton">en</div>
                            <div class="siteHeader__item siteHeaderLogo ' . $selected[2] . '">
                                <a href="/cart/show"><i class="fa fa-shopping-cart"></i></a>
                            </div>
                            <div class="siteHeader__item siteHeaderLogo '.$selected[3].'">
                                <a href="/users/login"><i class="fa fa-user"></i> <span>'.$username.'</span></a>
                            </div>
                        </div>
                    </div>';
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
