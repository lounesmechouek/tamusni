<?php

namespace App\Controller\Admin;

use App\View\Admin\DashboardView;
use Core\Controller\Controller;
use App\Controller\TemplateController;
use App;


/**
 * Class DashboardController
 * Controlleur de la page dashboard
 * @package App\Controller\Admin
 */
class DashboardController extends Controller{
    /**
     * @var DashboardController $instance Instance du singleton DashboardController
     * @var DashboardView $dashboardView Vue du dashboard
     * @var String $template La vue template à afficher
     */
    private static $instance;
    private $dashboardView;
    protected $template = "OnlineView";

    private function __construct(){
        if($this->dashboardView === null){
            $this->dashboardView = new DashboardView();
        }
    }

    /**
     * @return DashboardController Instance du singleton DashboardController
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new DashboardController;
        }
        return self::$instance;
    }

    /**
     * Fait appel à la vue pour l'affichage du dashboard
     */
    public function afficherPage(){
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle("Panneau de configuration");

        //On récupère le corps de la page depuis la vue associée
        $content = $this->dashboardView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}