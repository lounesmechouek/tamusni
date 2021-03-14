<?php
namespace App\Controller\Admin;

use App\View\Admin\EdtView;
use App\Model\EdtModel;
use Core\Controller\Controller;
use App\Controller\TemplateController;
use App;

/**
 * Class EdtController
 * Controlleur du gestionnaire d'emplois du temps
 * @package App\Controller\Admin
 */
class EdtController extends Controller{
    /**
     * @var EdtController $instance L'instance du singleton EdtController
     * @var EdtView $edtView La vue de l'edt
     * @var EdtModel $edtModel Le model de l'edt
     * @var String $template La vue template à afficher
     */
    private static $instance; 
    private $edtView;
    private $edtModel;
    protected $template = "OnlineView";

    private function __construct(){
        if($this->edtView === null){
            $this->edtView = new EdtView();
        }
        if($this->edtModel === null){
            $this->edtModel = new EdtModel();
        }
    }

    /**
     * @return EdtController L'instance du singleton controlleur
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new EdtController();
        }
        return self::$instance;
    }

    /**
     * @return Array Tableau d'objets cycles
     */
    public function getCycles(){
        return($this->edtModel->getCycles());
    }

    /**
     * @param String $cycle Chaine de caractère représentant l'id et le titre du cycle ex. (1 - Primaire)
     * @return Array Tableau d'objets niveaux appartenants au cycle spécifié
     */
    public function getNiveaux($cycle){
        //On ne garde que l'id du cycle
        $cycle = (int)substr($cycle, 0, 1);
        return($this->edtModel->getNiveauxCycle($cycle));
    }

    /**
     * @return Array Tableau d'objets année
     */
    public function getAnnees(){
        return($this->edtModel->getAnnees());
    }

    /**
     * @param String $cycle Chaine de caractère représentant l'id et le titre du cycle ex. (1 - Primaire)
     * @param String $niveau Chaine de caractère représentant l'id et le titre du niveau ex. (1 - 1P)
     * @param String $annee Chaine de caractère représentant l'id et la date de fin de l'année ex. (1 - 2021-06-03)
     * @return Array Tableau des classes du cycle et du niveau spécifié à l'année scolaire correspondant
     */
    public function getClasses($cycle, $niveau, $annee){
        $cycle = (int)substr($cycle, 0, 1);
        $niveau = (int)substr($niveau, 0, 1);
        $annee = (int)substr($annee, 0, 1);
        return($this->edtModel->getClassesNiveau($cycle, $niveau, $annee));
    }

    /**
     * @param String $classe Chaine de caractère représentant l'id et le titre de la classe ex. (1 - 1P1)
     * @param String $annee Chaine de caractère représentant l'id et la date de fin de l'année ex. (1 - 2021-06-03)
     * @return Array Tableau des horaires d'enseignements pour la classe à l'année scolaire spécifiée avec les matières correspondant 
     */
    public function getEdt($classe, $annee){
        $classe = (int)substr($classe, 0, 1);
        $annee = (int)substr($annee, 0, 1);
        return($this->edtModel->getEdtClasse($classe, $annee));
    }

    /**
     * Effectue les configurations nécessaires puis appelle la méthode d'affichage de la vue
     */
    public function afficherPage()
    {
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle($this->edtModel->getTitle());

        //On récupère le corps de la page depuis la vue associée
        $content = $this->edtView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }

}