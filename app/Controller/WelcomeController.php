<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Model\WelcomeModel;
use App\View\WelcomeView;
use App\Controller\TemplateController;
use App\View\Template\DefaultView;
use App;

/**
 * Class WelcomeController
 * Affichage de la page d'accueil
 */
class WelcomeController extends Controller
{
    /**
     * @var WelcomeController $instance : Les controlleurs sont des singletons (instanciés une seule fois dans l'app)
     * @var WelcomeModel $welcomeModel : Garder l'instance du modèle
     * @var WelcomeView $welcomeView : Garde l'instance de la vue
     */
    private static $instance;
    private $welcomeModel;
    private $welcomeView;
    protected $template = "DefaultView";



    private function __construct()
    {
        if ($this->welcomeModel === null) {
            $this->welcomeModel = new WelcomeModel();
        }
        if ($this->welcomeView === null) {
            $this->welcomeView = new WelcomeView();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new WelcomeController();
        }
        return self::$instance;
    }

    /**
     * @return String : Le titre de la page
     */
    public function getTitle()
    {
        return $this->welcomeModel->getTitle();
    }

    /**
     * @return Array : Tableau contenant les chemins vers les diapos et leurs titres
     */
    public function getDiapo()
    {
        return $this->welcomeModel->getDiapo();
    }

    public function getMenu()
    {
    }

    public function getBody()
    {
    }

    /**
     * Effectue les configurations nécessaires puis appelle la méthode d'affichage de la vue
     */
    public function afficherPage()
    {
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle($this->welcomeModel->getTitle());

        //On récupère le corps de la page depuis la vue associée
        $content = $this->welcomeView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}
