<?php 

namespace App\View;
use App\Controller\LoginController;

/**
 * Class LoginView
 * La vue de la page de connexion
 */
class LoginView{
    /**
     * Permet d'afficher le formulaire de connexion
     */
    private function formConnexion(){
?>
<section id="lp-form">
    <div class="lp-separator">
        <img src="../../public/assets/material/large-separator.svg" />
    </div>
    <h1>Connexion</h1>
    <div class="lp-form-container">
        <form id="lp-form" action="" method="post">
            <div class="input-container">
                <label class="text-input" for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="usrname" placeholder="hakim12">
            </div>
            <div class="input-container">
                <label class="text-input" for="passwd">Mot de passe</label>
                <input type="password" id="passwd" name="passwd" placeholder="******">
            </div>
            <input type="submit" id="submitButton"  name="submitButton" value="Se Connecter">
        </form>
    </div>
</section>
<p id="info" style="display:none">Espace<p>
<?php
        if( isset($_POST["usrname"]) && isset($_POST["passwd"])){
            $loginController = LoginController::getInstance();
            $loginController->login($_POST["usrname"], $_POST["passwd"]);
        }
    }   
    
    /**
     * Permet d'afficher un message d'erreur
     * Appelée depuis le LoginController
     * Vérifie $_SESSION['error'] pour n'afficher le message que pour le client concerné  
     * */ 
    public function loginError(){ 
        if(isset($_SESSION['error']) && $_SESSION['error'] === true) {
?>
    <div class="lp-error">
        <p>Désolé, une erreur s'est produite, veuillez ré-essayer</p>
    </div>
<?php
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
        $this->formConnexion();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page en elle-même
     */
    public function displayView(){
        $this->formConnexion();
    }
} 
?>