<?php 

namespace Core;
use Core\Database\Database;

/**
 * Class Auth
 * Permet d'authentifier un utilisateur + Vérifier si une session est déjà en cours
 * @package Core
 */
class Auth{

    /**
     * @var Database $db Instance de la base de données
     */
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * Vérifie qu'il n'y a pas d'erreur de connexion et qu'une session est bien en cours
     */
    public function connected(){
        return (isset($_SESSION['authid']) && isset($_SESSION['error']) && $_SESSION['error'] === false) ;
    }

    /**
     * @param String $username Nom d'utilisateur
     * @param String $password Mot de passe
     * @return Boolean Vrai si l'authentification s'est bien déroulée, Faux sinon 
     */
    public function login($username, $password){
        $user = $this->db->preparedQuery('SELECT * FROM `compteutilisateur` WHERE `username` = ?', [$username], null, true);
        if($user){
            if($user->hash_passwd === sha1($password)){
                $_SESSION['error'] = false;
                $_SESSION['authid'] = $user->id_compte;
                $_SESSION['authtype'] = $user->type_user;
                return true;
            }else{
                $_SESSION['error'] = true;
                return false;
            }
        }
        $_SESSION['error'] = true;
        return false;
    }
}