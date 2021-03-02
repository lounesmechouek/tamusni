<?php

namespace App\Controller\Admin;

use App\View\Admin\DashboardView;
use Core\Controller\Controller;
use App\Controller\TemplateController;
use App;

class DashboardController extends Controller{
    private $dashboardView;
    protected $template = "OnlineView";

    public function __construct(){
        if($this->dashboardView === null){
            $this->dashboardView = new DashboardView();
        }
    }

    public function afficherPage(){
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle("Panneau de configuration");

        //On récupère le corps de la page depuis la vue associée
        $content = "aa"; //$this->dashboardView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}