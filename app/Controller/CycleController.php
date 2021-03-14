<?php

namespace App\Controller;
use Core\Controller\Controller;
use App\View\CycleView;
use App\View\Template\DefaultView;
use App\Model\CycleModel;

use App\Controller\TemplateController;
use App;

/**
 * Class CycleController
 * Controlleur de la page de cycles
 * @package App\Controller
 */
class CycleController extends Controller{
    /**
     * @var CycleController $instance Les controllers publics sont des singletons (créés une seule fois dans l'app)
     * @var CycleModel $cycleModel Garder l'instance du modèle
     * @var CycleView $cycle View Garde l'instance de la vue
     * @var String $template Le template utilisé pour la vue
     */
    private static $instance;
    private $cycleView;
    private $cycleModel;
    protected $template = "DefaultView";

    /**
     * Constructeur privé (singleton)
     */
    private function __construct(){
        if($this->cycleView === null){
            $this->cycleView = new CycleView();
        }
        if($this->cycleModel === null){
            $this->cycleModel = new CycleModel();
        }
    }

    /**
     * On implémente le patron singleton 
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new CycleController();
        }
        return self::$instance;
    }

    /**
     * Affiche la page de connexion si l'utilisateur n'est pas déjà connecté
     */
    public function afficherPage(){
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);

        //On modifie le titre de la page
        App::getInstance()->setTitle($this->cycleModel->getTitle());
            
        //On récupère le corps de la page depuis la vue associée
        $content = $this->cycleView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}