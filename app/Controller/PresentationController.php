<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Model\PresentationModel;
use App\View\PresentationView;
use App\Controller\TemplateController;
use App;

/**
 * Class PresentationController
 * Controlleur de la page de présentation de l'école
 * @package App\Controller
 */
class PresentationController extends Controller{
    /**
     * @var PresentationController $instance Les controlleurs publics sont des singletons (créés une seule fois dans l'app)
     * @var PresentationModel $presentationModel Garder l'instance du modèle
     * @var PresentationView $presentationView Garder l'instance de la vue
     * @var String $template Le template utilisé pour la vue
     */
    private static $instance;
    private $presentationView;
    private $presentationModel;
    protected $template = "DefaultView";

    /**
     * Constructeur privé (singleton)
     */
    private function __construct(){
        if($this->presentationView === null){
            $this->presentationView = new PresentationView();
        }
        if($this->presentationModel === null){
            $this->presentationModel = new PresentationModel();
        }
    }

    /**
     * On implémente le patron singleton 
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new PresentationController();
        }
        return self::$instance;
    }

    /**
     * @return Array Tableau des paragraphes disponibles
     */
    public function getPresentation(){
        return $this->presentationModel->getPresentation();
    }

    /**
     * Affiche la page présentation
     */
    public function afficherPage(){
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);

        //On modifie le titre de la page
        App::getInstance()->setTitle($this->presentationModel->getTitle());
            
        //On récupère le corps de la page depuis la vue associée
        $content = $this->presentationView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}