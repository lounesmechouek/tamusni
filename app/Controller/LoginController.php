<?php
namespace App\Controller;
use App\View\LoginView;
use App\View\Template\DefaultView;
use App\Model\LoginModel;

use App\Controller\TemplateController;
use Core\Controller\Controller;

use Core\Auth;
use App;

/**
 * Class LoginController
 * Controlleur de la page d'authentification ainsi que les espaces parent/eleve
 * @package App\Controller
 */
class LoginController extends Controller{
    /**
     * @var LoginController $instance Instance du singleton
     * @var LoginView $loginView La vue à afficher aux utilisateurs (toujours la même)
     * @var LoginModel $loginModel Model de la page login (pour l'accès aux articles parents/eleves)
     * @var String $template Redéfinition du template de la classe parent
     */
    private static $instance;
    private $loginView;
    private $loginModel;
    protected $template = "DefaultView";

    /**
     * Constructeur privé (singleton)
     */
    private function __construct(){
        if($this->loginView === null){
            $this->loginView = new LoginView();
        }
        if($this->loginModel === null){
            $this->loginModel = new LoginModel();
        }
    }

    /**
     * On implémente le patron singleton 
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new LoginController();
        }
        return self::$instance;
    }

    /**
     * Échappe les chaînes de caractères puis fait appel à la fonction login de la classe Auth
     * @param String $username Pseudo de l'utilisateur
     * @param String $password Mot de passe de l'utilisateur
     */
    public function login($username, $password){
        //Contrôles sur les données entrées :
        $username = $this->secureInput($username);
        $password = $this->secureInput($password);

        //On appelle la fonction login de la classe Auth
        $auth = new Auth(\App::getInstance()->getDb());
        $status = $auth->login($username, $password);

        if($status){
            header("Location: ?page=" . $_SESSION["authtype"] .".dashboard");
            return true;
        }else{
            $this->loginView->loginError();
            return false;
        }
    }

    /**
     * Permet de récupérer les articles relatifs à un type d'utilisateur
     * @param String $type Type de l'utilsateur (eleve/parent)
     */
    public function getArticles($type){
        return $this->loginModel->getArticles($type);
    }

    /**
     * Affiche la page de connexion si l'utilisateur n'est pas déjà authentifié
     * Si l'utilisateur est déjà authentifié, il est redirigé vers son dashboard (selon le type de l'utilisateur)
    */
    public function afficherPage(){
        $auth = new Auth(\App::getInstance()->getDb());

        //Si l'utilisateur est déjà connecté, on l'envoie à son dashboard
        if($auth->connected()){
            header("Location: ?page=" . $_SESSION["authtype"] .".dashboard");
        }else{
            //On récupère le template depuis le contrôleur des templates
            $view = TemplateController::getInstance()->getTemplate($this->template);

            //On modifie le titre de la page
            App::getInstance()->setTitle($this->loginModel->getTitle());
            
            //On récupère le corps de la page depuis la vue associée
            $content = $this->loginView->getViewContent();

            //On affiche le template en lui donnant la vue en paramètre
            $view->displayView($content);
        }
    }
}