<?php

namespace App\View\Template;

use App;

class OnlineView{

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
        <div class="sb-elt-container">
            <img src="../../public/assets/material/parametres-icon.svg"/>
            <p>Paramètres</p>
        </div>
    </div>
</section>

<?php
    }
    private function getHeader(){
?>
<section id="online-header">
    <div class="header-container">
        <h1>Bienvenue <?= $_SESSION["authtype"] ?> </h1>
        <div class="usr-container">
            <img src="" />
            <p><?= ucfirst($_SESSION["authtype"]) ?></p>
        </div>
    </div>
<section>
<?php
    }
    private function getCorps($content){
?>

<p><?= $content ?></p>

<?php
    }
    private function getFooter(){
?>
</body>
<script type="text/javascript" src="../../public/src/js/jquery.js"></script>
<script type="text/javascript" src="../../public/src/js/script.js"></script>
</html>

<?php
    }

    public function displayView($content){
        $this->getSideBar();
        $this->getHeader();
        $this->getCorps($content);
        $this->getFooter();
    }
}