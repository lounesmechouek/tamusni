<?php

namespace App\View\Template;

use App;

/**
* Class OnlineView
* Définit le template pour les pages authentifiées
* @package App\View\Template
*/
class OnlineView{

    /**
     * Code HTML relatif à la barre latérale
     */
    private function getSideBar(){
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="pragma" content="no-cache" />
   
    <link rel="stylesheet" type="text/css" href="../../public/src/generated_css/styles.css">

    <title><?= App::getTitle(); ?></title>
</head>
<body>
<section id="online-sb">
    <div class="sb-container">
        <div class="sb-logo-container">
            <img src="../../public/assets/default/logo-alternatif.svg" />
        </div>
        <div class="sb-separator-container">
            <img src="../../public/assets/material/separator.svg" />
        </div>
        <div class="sb-nav-container">
            <!--<div class="sb-elt-container">
            </div>-->
        </div>
        <div class="sb-separator-container">
            <img src="../../public/assets/material/separator.svg" />
        </div>
        <a href="<?= "?page=" . $_SESSION["authtype"] . ".settings" ?>" class="sb-elt-container">
            <img src="../../public/assets/material/parametres-icon.svg"/>
            <p>Paramètres</p>
        </a>
    </div>
</section>

<?php
    }
    private function getHeader(){
?>
<section id="online-header">
    <div class="header-container">
        <h1>Bienvenue <?= ucfirst($_SESSION["authtype"]) ?> </h1>
        <a href="<?= "?page=" . $_SESSION["authtype"] . ".profile" ?>" class="usr-container">
            <img src="../../public/assets/users/usr-pic.svg" />
            <p><?= ucfirst($_SESSION["authtype"]) ?></p>
        </a>
    </div>
</section>
<?php
    }
    /**
     * Code HTML relatif à la partie principale
     * Chaque contrôleur y fait un appel en spécifiant le contenu de la page "$content"
     */
    private function getCorps($content){
?>

<p><?= $content ?></p>

<?php
    }
    /**
     * Code HTML relatif au pied de page
     */
    private function getFooter(){
?>
<p id="typeuser" style="display:none"><?= $_SESSION["authtype"]; ?></p>
<p id="actualpage" style="display:none"><?= $_GET["page"]; ?></p>
</body>
<script type="text/javascript" src="../../public/src/js/jquery.js"></script>
<script type="text/javascript" src="../../public/src/js/online-menu.js"></script>
<script type="text/javascript" src="../../public/src/js/features.js"></script>
<script type="text/javascript" src="../../public/src/js/popup.js"></script>
</html>

<?php
    }

    /**
     * Affichage de toute la page
     */
    public function displayView($content){
        $this->getSideBar();
        if($_GET["page"] === "admin.dashboard"){
            $this->getHeader();
        }
        $this->getCorps($content);
        $this->getFooter();
    }
}