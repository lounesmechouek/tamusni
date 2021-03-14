<?php

namespace App\Controller;

use Core\Controller\Controller;
use App\Model\ContactModel;
use App\View\ContactView;
use App\Controller\TemplateController;
use App;

/**
 * Class ContactController
 * Controlleur de la page de contact
 * @package App\Controller
 */
class ContactController extends Controller{
    /**
     * @var ContactController $instance Les controlleurs publics sont des singletons (créés une seule fois dans l'app)
     * @var ContactModel $contactModel Garder l'instance du modèle
     * @var ContactView $contactView Garde l'instance de la vue
     * @var String $template Le template utilisé pour la vue
     */
    private static $instance;
    private $contactModel;
    private $contactView;
    protected $template = "DefaultView";

    private function __construct()
    {
        if ($this->contactModel === null) {
            $this->contactModel = new ContactModel();
        }
        if ($this->contactView === null) {
            $this->contactView = new ContactView();
        }
    }

    /**
     * @return ContactController Instance du singleton controller
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ContactController();
        }
        return self::$instance;
    }

    /**
     * Effectue les configurations nécessaires puis appelle la méthode d'affichage de la vue
     */
    public function afficherPage()
    {
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle($this->contactController->getTitle());

        //On récupère le corps de la page depuis la vue associée
        $content = $this->contactController->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}