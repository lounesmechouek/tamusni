<?php
namespace App\Controller;
use App\View\LoginView;
use App\View\Template\DefaultView;

use App\Controller\TemplateController;
use Core\Controller\Controller;

use Core\Auth;
use App;

class LoginController extends Controller{
    /**
     * @var LoginController $instance Instance du singleton
     * @var LoginView $loginView La vue à afficher aux utilisateurs (toujours la même)
     * @var String $template Redéfinition du template de la classe parent
     */
    private static $instance;
    private $loginView;
    protected $template = "DefaultView";

    /**
     * Constructeur privé (singleton)
     */
    private function __construct(){
        if($this->loginView === null){
            $this->loginView = new LoginView();
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
     * Affiche la page de connexion si l'utilisateur n'est pas déjà connecté
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
            App::getInstance()->setTitle("Connexion");
            
            //On récupère le corps de la page depuis la vue associée
            $content = $this->loginView->getViewContent();

            //On affiche le template en lui donnant la vue en paramètre
            $view->displayView($content);
        }
    }
}