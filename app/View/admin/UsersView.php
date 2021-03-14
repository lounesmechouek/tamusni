<?php

namespace App\View\Admin;
use App\Controller\Admin\UsersController;

/**
 * Class UsersView
 * La vue de la page gestion users
 * @package App\View\Admin
 */
class UsersView{
    /**
     * @var Array $idUsers Tableau des id des utilisateurs
     */
    private $idUsers = [];

    /**
     * Code HTML de la partie gestion des utilisateurs
     */
    private function getUsers(){
?>
<section id="up-usrs">
    <h1>Gestion Utilisateurs</h1>
    <div class="wsp-gestion-btn">
        <a id="add_usr">Ajouter</a>
        <a id="del_usr">Supprimer</a>
    </div>
    <div class="up-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nom</a></th>
                    <th scope="col">Prénom</a></th>
                    <th scope="col">Login</a></th>
                    <th scope="col">Type</a></th>
                </tr>
            </thead>
            <tbody>
<?php
$i=0;
$users=UsersController::getInstance()->getUsers();
foreach($users as $usr){
$this->idUsers[$i]=$usr->id_user;
?>
            <tr>
                <td><?= $usr->id_user; ?></td>
                <td><?= $usr->nom_user; ?></td>
                <td><?= $usr->prenom_user; ?></td>
                <td><?= $usr->username; ?></td>
                <td><?= $usr->type_user; ?></td>
            </tr>
<?php
$i++;
}
?>
            </tbody>
        </table>
    </div>
    <div class="up-usrs-add">
            <p>Entrez les informations nécessaires</p>
            <form method="post">
                <label for="usrname">Login*</label>
                <input type="text" id="usrname" name="usrname">
                <label for="passwd">Mot de passe*</label>
                <input type="password" id="passwd" name="passwd">
                <label for="nameusr">Nom*</label>
                <input type="text" id="nameusr" name="nameusr">
                <label for="prenomusr">Prénom*</label>
                <input type="text" id="prenomusr" name="prenomusr">
                <label for="birthdate">Date Naissance*</label>
                <input type="date" id="birthdate" name="birthdate">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email">
                <label for="address">Adresse</label>
                <input type="text" id="address" name="address">
                <label for="phone">Téléhpone</label>
                <input type="number" id="phone" name="phone">
                <label for="usr_type">Type*</label>
                <select name="usr_type" id="usr_type">
                    <option value="admin">admin</option>
                    <option value="eleve">eleve</option>
                    <option value="enseignant">enseignant</option>
                    <option value="parent">parent</option>
                </select>
                <div class="popup-btn" >
                    <input type="submit" id="ajoutUsr"  name="ajoutUsr" value="Confirmer">
                    <input type="button" id="annulUsr"  name="annulUsr" value="Annuler">
                </div>
            </form>
        </div>
        <div class="up-usrs-del">
            <form method="post">
                <label for="usr_del">id de l'utilisateur</label>
                <select name="usr_del" id="usr_del">
<?php
foreach($this->idUsers as $idUser){
?>
            <option value="<?= $idUser ?>"><?= $idUser ?></option>
<?php
}
?>
                </select>
                <div class="popup-btn" >
                    <input type="submit" id="suppUsr"  name="suppUsr" value="Confirmer">
                    <input type="button" id="annulSuppUsr"  name="annulSuppUsr" value="Annuler">
                </div>
            </form>
        </div>
</section>
<?php
if(isset($_POST["usrname"]) && isset($_POST["passwd"]) && isset($_POST["nameusr"]) && isset($_POST["prenomusr"]) && isset($_POST["birthdate"]) && isset($_POST["email"]) && isset($_POST["usr_type"])){
    UsersController::getInstance()->addUser($_POST["usrname"], $_POST["passwd"], $_POST["nameusr"], $_POST["prenomusr"], $_POST["birthdate"], $_POST["email"], $_POST["address"], $_POST["phone"], $_POST["usr_type"]);
}
if(isset($_POST["usr_del"])){
    UsersController::getInstance()->delUser($_POST["usr_del"]);
}
    }
    
    /**
     * Permet de récupérer la page sans l'afficher
     * @return Buffer Le code HTML de la page
     */
    public function getViewContent()
    {
        //On lance la bufferisation
        ob_start();
        //On garde le contenu de la page dans le buffer
        $this->getUsers();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page en elle-même
     */
    public function displayView()
    {
        $this->getUsers();
    }
}
