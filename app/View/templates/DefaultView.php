<?php
    
    namespace App\View\Template;
    use App;

    /**
     * Class DefaultView
     * Définit le template par défaut (pour les pages non-authentifiées)
     * @package App\View\Template
     */
    class DefaultView{
        /**
         * Code HTML de l'entête
         */
        private function getHeader(){ 
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
    <section id="default-header">
        <div class="dh-container">
            <div class="dh-logo-container">
                <a href="?page=welcome"><img class="dh-logo" src="../../public/assets/default/logo-principal.svg"/></a>
                <!--<a href="#" class="dh-logo-txt">Tamusni</a>-->
            </div>
            <div class="dh-social">
                <div class="dh-social-elt">
                    <a href="https://facebook.com">
                        <img class="dh-social-img" src="../../public/assets/material/facebook-icon.svg" />
                    </a>
                </div>
                <div class="dh-social-elt">
                    <a href="https://twitter.com">
                        <img class="dh-social-img" src="../../public/assets/material/twitter-icon.svg" />
                    </a>
                </div>
                <div class="dh-social-elt">
                    <a href="https://instagram.com">
                        <img class="dh-social-img" src="../../public/assets/material/instagram-icon.svg" />
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php }
        /**
         * Code HTML de la partie centrale
         * C'est le contrôleur de la page concernée qui fait un appel dynamiquement en spécifiant $contenu
         */
    private function getCorps($content){
?>
    <p><?= $content ?></p>
<?php }
        /**
         * Code HTML du bas de page
         */
    private function getFooter(){
?>
    <section id="default-footer">
        <div class="df-container">
            <div class="df-column">
                <ul>
                    <li><a href="?page=welcome">Accueil</a></li>
                    <li><a href="?page=presentation">L'École</a></li>
                    <li><a href="?page=contact">Contact</a></li>
                </ul>
            </div>
            <div class="df-logo-container">
                <img class="df-logo" src="../../public/assets/default/logo-alternatif.svg"/>
                
            </div>
            <div class="df-column">
                <ul>
                    <li>Espaces
                        <ul>
                            <li><a href="?page=login.parent">Espace Parents</a></li>
                            <li><a href="?page=login.eleve">Espace Élèves</a></li>
                        </ul>
                    </li>
                    <li>Cycles
                        <ul>
                            <li><a href="?page=cycles.primaire">Primaire</a></li>
                            <li><a href="?page=cycles.moyen">Moyen</a></li>
                            <li><a href="?page=cycles.secondaire">Secondaire</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </section> 
<p id="info" style="display:none"><?= $_GET["page"]; ?><p>   
</body>
<script type="text/javascript" src="../../public/src/js/jquery.js"></script>
<script type="text/javascript" src="../../public/src/js/script.js"></script>

</html>
<?php }

    /**
     * Fonction pour afficher la page 
     */
    public function displayView($content){
        $this->getHeader();
        $this->getCorps($content);
        $this->getFooter();
    }
}

?>