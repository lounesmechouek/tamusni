<?php
namespace App\Controller\Admin;

use App\View\Admin\UsersView;
use App\Model\UsersModel;
use Core\Controller\Controller;
use App\Controller\TemplateController;
use App;

/**
 * Class UsersController
 * Controlleur de la page de gestion des utilisateurs
 * @package App\Controller\Admin
 */
class UsersController extends Controller{
    /**
     * @var UsersController $instance L'instance du singleton UsersController
     * @var UsersView $usersView La vue de la gestion utilisateurs
     * @var UsersModel $usersModel Le model de la gestion utilisateurs
     * @var String $template La vue template à afficher
     */
    private static $instance; 
    private $usersView;
    private $usersModel;
    protected $template = "OnlineView";

    private function __construct(){
        if($this->usersView === null){
            $this->usersView = new UsersView();
        }
        if($this->usersModel === null){
            $this->usersModel = new UsersModel();
        }
    }

    /**
     * @return UsersController L'instance du singleton controlleur
     */
    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new UsersController();
        }
        return self::$instance;
    }

    /**
     * @return Array Tableau des utilisateurs de l'application ainsi que leur compte
     */
    public function getUsers(){
        return $this->usersModel->getUsers();
    }

    /**
     * Insère un utilisateur dans la base
     * @param String $login Username à insérer
     * @param String $passwd Mot de passe
     * @param String $nom Nom de l'utilisateur
     * @param String $prenom Prénom de l'utilisateur
     * @param String $date Date de naissance
     * @param String $mail Adresse email
     * @param String $addr Adresse de l'utilisateur
     * @param String $phone Numéro de téléphone
     * @param String $type Type de l'utilisateur (admin, eleve, enseignant, parent)
     */
    public function addUser($login, $passwd, $nom, $prenom, $date, $mail, $addr, $phone, $type){
        if($login != "" && $passwd != "" && $nom != "" && $prenom != "" && $date != "" && $mail != "" && $type != ""){
            $login = $this->secureInput($login);
            $passwd = $this->secureInput($passwd);
            $passwd = sha1($passwd);
            $nom = $this->secureInput($nom);
            $date = $this->secureInput($date);
            $mail = $this->secureInput($mail);
            $addr = $this->secureInput($addr);
            $phone = $this->secureInput($phone);
            $type = $this->secureInput($type);
            $this->usersModel->addUser($login, $passwd, $nom, $prenom, $date, $mail, $addr, $phone, $type);
        }
    }

    /**
     * Suppression d'un utilisateur
     * @param Integer $idUser L'id de l'utilisateur 
     */
    public function delUser($idUser){
        $this->usersModel->delUser($idUser);
    }

    /**
     * Effectue les configurations nécessaires puis appelle la méthode d'affichage de la vue
     */
    public function afficherPage()
    {
        //On récupère le template depuis le contrôleur des templates
        $view = TemplateController::getInstance()->getTemplate($this->template);
        
        //On modifie le titre de la page (avant de faire le render)
        App::setTitle($this->usersModel->getTitle());

        //On récupère le corps de la page depuis la vue associée
        $content = $this->usersView->getViewContent();

        //On affiche le template en lui donnant la vue en paramètre
        $view->displayView($content);
    }
}