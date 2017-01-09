<?php
session_start();

require_once("model/Catalog.php");
require_once("view/CatalogView.php");

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
            // TODO: Show only one product.
            echo "Showing product number: ".$id;
        }
    }

    
}
