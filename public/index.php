<?php

use App\Controller\WelcomeController;
use Core\Auth;

define('ROOT', dirname(__DIR__));

require_once ROOT . '/app/App.php';

App::load(); //On charge l'autoloader
$auth = new Auth(App::getInstance()->getDb());

if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page = 'welcome';
}

$page = explode('.', $page);
if($page[0] == 'admin'){
    $controller = 'App\\Controller\\Admin\\' . ucfirst($page[1]) . 'Controller';
}else{
    $controller = 'App\\Controller\\' . ucfirst($page[0]) . 'Controller';
}


if($page[0] == 'admin'){
    try{
        $controller = new $controller();
    }catch(Exception $e){
        echo "Page introuvable !";
        die();
    }
}else{
    try{
        $controller = $controller::getInstance();
    }catch(Exception $e){
        echo "Page introuvable !";
        die();
    }
}

$controller->afficherPage();

