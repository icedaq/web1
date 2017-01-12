<?php
require_once("model/ShoppingCart.php");
require_once("model/Catalog.php");
require_once("view/CatalogView.php");
require_once("model/UserManager.php");
session_start();

// This class is used to manage the products.
class catalogController {

    private $model;
    private $view;
    private $id;

    public function __construct() {
        $this->model = new Catalog();
        $this->view = new CatalogView($this->model);

        // Make sure there is some data in the database.
        $db = Database::getInstance(); 
        if ($db->isEmpty()) {
            $db->seed();
        }
    }

    public function setId($id) {
        $this->id =$id;
    }

    public function consumeId() {
        $theid = $this->id;
        $this->id = null;
        return $theid;
    }

    // For the jquery UI autocomplete.
    public function search() {

        if(isset($_POST['term'])) {

            $products = $this->model->filterProductsByName($_POST['term']);

            $result = array();
		    foreach ($products as $value) {
                array_push($result,array('label'=>$value->getName(),'value'=>$value->getId()));
            }

            echo(json_encode($result));
        }  
    }

    public function show() {
        if ($this->id == null)
        {
            $this->view->renderCatalog();
        } else {
            $id = $this->consumeId();
            $this->view->renderProduct($id);
        }
    }

    // Add a new product to the catalog.
    //public function addProduct($name, $price, $description, $category, $image, $sale=FALSE) {
    public function add() {
        if (UserManager::isAdmin()) {
            if(isset($_POST['name'])  
                &&  isset($_POST['price'])
                &&  isset($_POST['description'])
                &&  isset($_POST['category'])
                &&  isset($_POST['image'])
                &&  isset($_POST['sale'])) {
            }   
        } 
    }

    public function seed() {
        $db = Database::getInstance(); 
        $db->seed();
    }

    
}
