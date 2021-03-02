<?php

namespace App\View;

use App\Controller\WelcomeController;

define('ASSETS', '..\\..\\public\\assets\\');

/**
 * Class WelcomeView
 * Il s'agit de la vue de la page d'accueil
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
<p id="info" style="display:none">Accueil<p>
<?php
    }

    /**
     * Permet d'afficher le corps de la page
     */
    private function Cadres(){

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
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page directement
     */
    public function displayView()
    {
        $this->Diapo();
    }
}
?>