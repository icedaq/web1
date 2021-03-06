<?php
require_once("model/UserManager.php");
require_once("view/UsersView.php");
session_start();

// This class is used to manage the products.
class usersController {

    private $model;
    private $view;
    private $id;

    public function __construct() {
        $this->model = new UserManager();
        $this->view = new UsersView();
    }

    public function setId($id) {
        $this->id =$id;
    }

    public function consumeId() {
        $theid = $this->id;
        $this->id = null;
        return $theid;
    }

    public function login() {
        if(isset($_POST['login'])  &&  isset($_POST['password']))
        {
            $login = $_POST["login"];
            $pw = $_POST["password"];
            if ($this->model->checkLogin($login, $pw)) {
                //echo $this->model->getUserByLogin($login);
                $_SESSION["user"] = $this->model->getUserByLogin($login);
                $this->view->renderLoginSuccess($_SESSION["user"]);
            } else {
                $this->view->renderLoginFail();
            }
        } else {
            if (!isset($_SESSION["user"])) {
                $this->view->renderLogin();
            } else {
                $this->view->renderLoginSuccess($_SESSION["user"]);
            }
        }
    }

    public function logout() {
        $_SESSION = [];
        setcookie(session_name(),'',1);
        header("location:/users/login");
    }

    public function signup() {
        if(isset($_POST['login'])  
            &&  isset($_POST['password'])
            &&  isset($_POST['firstName'])
            &&  isset($_POST['lastName'])
            &&  isset($_POST['email'])
            &&  isset($_POST['street'])
            &&  isset($_POST['houseNumber'])
            &&  isset($_POST['city'])
            &&  isset($_POST['zip'])
            &&  isset($_POST['country']))
        {
            // TODO: Validate
            $this->model->addUser($_POST['login'], $_POST['password'], $_POST['email'], 
                $_POST['firstName'],$_POST['lastName'], $_POST['street'], 
                $_POST['houseNumber'], $_POST['city'], $_POST['zip'], $_POST['country'], false);
            header("Location: /users/login");
            die();    
        } else {
            $this->view->renderSignUp();
        }
    }

}
