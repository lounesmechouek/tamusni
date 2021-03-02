<?php

namespace App\Controller;

use App\View\ErrorView;
use App\Controller\Template;

class ErrorController{
    private static $instance;
    private $errorView;

    private function __construct(){
        if($this->errorView === null){
            $this->errorView = new ErrorView();
        }
    }

    public function getInstance(){
        if(self::$instance === null){
            self::$instance = new ErrorController();
        }
        return self::$instance;
    }

    /**
     * Affiche la page de connexion
     */
    public function afficherPage(){
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On récupère le corps de la page depuis la vue associée
        $content = $this->errorView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }

}