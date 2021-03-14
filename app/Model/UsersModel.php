<?php

namespace App\Model;

use Core\Table\Table;
use App;

/**
 * Class Utilisateur
 * Accès aux utilisateurs, ressources nécessaire à la page de gestion des users
 * @package App\Model
 */
class UsersModel extends Table
{
    /**
     * @var String $title Titre de la page
     * @var Array $users Les utilisateurs disponibles
     */
    private $title = "Gestion des utilisateurs";
    private $users;

    public function __construct()
    {
        parent::__construct(App::getDb());
    }

    /**
     * @return String Titre de la page
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Array Tableau des utilisateurs disponibles
     */
    public function getUsers()
    {
        if ($this->users === null) {
            $this->users = $this->query("SELECT * FROM `utilisateur` JOIN `compteutilisateur` ON `utilisateur`.`id_user` = `compteutilisateur`.`id_user`");
        }
        return $this->users;
    }

    /**
     * @param String $login Username de l'utilisateur
     * @param String $passwd Mot de passe
     * @param String $nom Nom de l'utilisateur
     * @param String $prenom Prénom de l'utilisateur
     * @param String $date Date de naissance
     * @param String $mail Adresse email
     * @param String $addr Adresse physique
     * @param String $phone Num tel
     * @param String $type Type de l'utilisateur (admin/eleve/parent/enseignant)
     */
    public function addUser($login, $passwd, $nom, $prenom, $date, $mail, $addr, $phone, $type){
        $id_usr = $this->query("INSERT INTO `utilisateur` (`id_user`, `nom_user`, `prenom_user`, `date_naissance`, `adresse_user`, `email_user`, `phone_user`) VALUES (NULL, ?, ?, ?, ?, ?, ?)", null, [$nom, $prenom, $date, $addr, $mail, $type], false, true);
        $this->query("INSERT INTO `compteutilisateur` (`id_compte`, `username`, `hash_passwd`, `type_user`, `id_user`) VALUES (NULL, ?, ?, ?, ?)", null, [$login, $passwd, $type, $id_usr], false, true);
        $this->users=null;
    }

    /**
     * @param Integer $idUser Identifiant de l'utilisateur à supprimer
     */
    public function delUser($idUser){
        $this->query("DELETE FROM `utilisateur` WHERE `utilisateur`.`id_user` = ?", null, [$idUser], false, true);
        $this->query("DELETE FROM `compteutilisateur` WHERE `compteutilisateur`.`id_user` = ?", null, [$idUser], false, true);
        $this->users=null;
    }
}
