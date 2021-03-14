<?php

namespace App\Controller;

use App\View\ErrorView;
use App\Controller\Template;

/**
 * Class ErrorController
 * Gestion de la vue "Erreur"
 * @package App\Controller
 */
class ErrorController{
    /**
     * @var ErrorController $instance Les controlleurs publics sont des singletons (créés une seule fois dans l'app)
     * @var ErrorView $errorView Garde l'instance de la vue
     * @var String $template Le template utilisé pour la vue
     */
    private static $instance;
    private $errorView;
    protected $template = "DefaultView";

    private function __construct(){
        if($this->errorView === null){
            $this->errorView = new ErrorView();
        }
    }

    /**
     * @return ErrorController Instance du singleton controller
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new ErrorController();
        }
        return self::$instance;
    }

    /**
     * Affiche la page d'erreur
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