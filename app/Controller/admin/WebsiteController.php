<?php

namespace App\Controller\Admin;

use App\View\Admin\WebsiteView;
use App\Model\WebsiteModel;
use Core\Controller\Controller;
use App\Controller\TemplateController;
use App;

/**
 * Class WebsiteController
 * Controlleur de la page Gestion du site
 * @package App\Controller\Admin
 */
class WebsiteController extends Controller{
     /**
     * @var WebsiteController $instance L'instance du singleton WebsiteController
     * @var WebsiteView $websiteView La vue de la gestion du site
     * @var WebsiteModel $websiteModel Le model de la gestion du site
     * @var String $template La vue template à afficher
     */
    private static $instance; 
    private $websiteView;
    private $websiteModel;
    protected $template = "OnlineView";

    private function __construct(){
        if($this->websiteView === null){
            $this->websiteView = new WebsiteView();
        }
        if($this->websiteModel === null){
            $this->websiteModel = new WebsiteModel();
        }
    }

    /**
     * @return WebsiteController L'instance du singleton controlleur
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new WebsiteController();
        }
        return self::$instance;
    }


    /**
     * @return Array Tableau des articles disponibles
     */
    public function getArticles(){
        return $this->websiteModel->getArticles();
    }

    /**
     * @param String $titre Titre de l'article à insérer
     * @param String $contenu Contenu de l'article
     * @param String $img Lien vers l'image de couverture (../../public/assets/...)
     */
    public function addArticle($titre, $contenu, $img=null, $typeUsr){
        if($titre != "" && $contenu != ""){
            $titre = $this->secureInput($titre);
            $contenu = $this->secureInput($contenu);
            $img = $this->secureInput($img);
            $this->websiteModel->addArticle($titre, $contenu, $img, $typeUsr);
        }
    }

    /**
     * @param Integer $idArticle Identifiant de l'article à supprimer
     */
    public function delArticle($idArticle){
        $this->websiteModel->delArticle($idArticle);
    }

    /**
     * @return Array Tableau des paragraphes de la page présentation
     */
    public function getPresentation(){
        return $this->websiteModel->getPresentation();
    }

    /**
     * Insère un nouveau paragraphe dans la page présentation
     * @param String $titre Titre du paragraphe à insérer
     * @param String $contenu Contenu du paragraphe à insérer
     * @param String $img Lien de l'image à insérer (../../public/assets/...)
     */
    public function addPresentation($titre, $contenu, $img=null){
        if($titre != "" && $contenu != ""){
            $titre = $this->secureInput($titre);
            $contenu = $this->secureInput($contenu);
            $img = $this->secureInput($img);
            $this->websiteModel->addPresentation($titre, $contenu, $img);
        }
    }

    /**
     */
    public function delParagraphe($idParagraphe){
        $this->websiteModel->delParagraphe($idParagraphe);
    }

    /**
     * Effectue les configurations nécessaires puis appelle la méthode d'affichage de la vue
     */
    public function afficherPage()
    {
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle($this->websiteModel->getTitle());

        //On récupère le corps de la page depuis la vue associée
        $content = $this->websiteView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }


}