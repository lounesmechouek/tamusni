<?php

namespace App\View;

use App\Controller\WelcomeController;

define('ASSETS', '..\\..\\public\\assets\\');

/**
 * Class LoginView
 * La vue de la page d'accueil
 * @package App\View
 */
class WelcomeView
{
    /**
     * Permet d'afficher le diaporama d'images
     */
    private function Diapo()
    {      
?>
<section id="wp-diapo">
    <div class="wp-diapo-container">
        <div class="wp-diapo-scroll-container">
            <a onclick="Avancement(-1)">
                <img class="wp-diapo-scroll" src="../../public/assets/material/previous-icon.svg" />
            </a>
        </div>
<?php
    $diapos = WelcomeController::getInstance()->getDiapo();
    foreach ($diapos as $diapo) {
?>
        <div class="wp-diapo-img-container">
            <img class="wp-diapo-img appear" src="<?= ASSETS . $diapo->imageDiapo ?>"  />
            <p class="wp-diapo-txt"></p>
        </div>
<?php
    }
?>
        <div class="wp-diapo-scroll-container">
            <a onclick="Avancement(1)">
                <img class="wp-diapo-scroll" src="../../public/assets/material/next-icon.svg" />
            </a>
        </div>
    </div>
</section>
<section id="wp-menu">
    <div class='wp-menu-container'>
    </div>
</section>
<?php
    }

    /**
     * Permet d'afficher le corps de la page
     */
    private function Cadres(){
?>
<section id="wp-cadres">
    <h1>Nos articles récents</h1>
    <div class="articles-container">
<?php
$articles=WelcomeController::getInstance()->getArticles();
$i=0;
$j=0;
$k=0;

foreach($articles as $article){
    if($i===0 && $j<2){
?>
        <div class="wp-articles-row">
<?php
    }
    if($j<2){
?>
        <div class="wp-article">
            <img src="<?= $article->image_article; ?>">
            <?= $article->titre_article; ?>
            <?= substr($article->corps_article,0,20); ?>
            <a href="?page=articles.<?= $article->id_article; ?>">Voir plus...</a>
        </div>
<?php
    }
    $i++;
    if($i>3 || $j>=2){
        if($j<2){
?>
            </div>
<?php
        $j++;
        $i=0;
        }else{
            if($k===0){
?>
            <div class="wp-articles-end">
            <p>Découvrir également : </p>
<?php
            }
            if($k<4){
?>
            <div class="wp-art-en">
                <a href="?page=articles.<?= $article->id_article; ?>"><?= $article->titre_article; ?></a>
            </div>
<?php
            }
            $k++;
        }

    }
}
?>      
<?php
    if($k!=0){
 ?>
            <a href="?page=articles">Voir plus...</a>
            </div>
 <?php       
    }
?>  
    </div>
</section>
<?php
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
        $this->Diapo();
        $this->Cadres();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page directement
     */
    public function displayView()
    {
        $this->Diapo();
        $this->Cadres();
    }
}
?>