<?php 
namespace App\Controller;
use App\View\Template\DefaultView;
use App\View\Template\OnlineView;

/**
 * Class TemplateController
 * Permet de gérer les vues "template"
 * @package App\Controller
 */
class TemplateController{
    /**
     * @var TemplateController $instance Les controllers publics sont des singletons (créés une seule fois dans l'app)
     * @var DefaultView $defaultView Instance de la vue propre au template pour les pages publiques
     * @var OnlineView $onlineView Instance de la vue propre au template pour les pages après connexion (admin/parent/eleve/enseignant)
     * @var String $currentUsedTemplate Template actuellement utilisé
     */
    private static $instance;
    private static $defaultView;
    private static $onlineView;
    private static $currentUsedTemplate = "DefaultView";

    private function __construct(){
        if(self::$defaultView === null){
            self::$defaultView = new DefaultView();
        }
        if(self::$onlineView === null){
            self::$onlineView = new OnlineView();
        }
    }

    /**
     * Implémentation du patron singleton
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new TemplateController();
        }
        return self::$instance;
    }

    /**
     * @param String $currentTmp Le nouveau contrôleur
     */
    public static function setCurrentTemplate($currentTmp){
        self::$currentUsedTemplate = $currentTmp;
    }

    /**
     * @param String $templateName Nom du template à afficher
     */
    public static function getTemplate($templateName){
        if($templateName === "DefaultView"){
            self::setCurrentTemplate($templateName);
            return self::$defaultView;
        }elseif($templateName === "OnlineView"){
            self::setCurrentTemplate($templateName);
            return self::$onlineView;
        }
    }
}