<?php

namespace App\View;
use App\Controller\PresentationController;

/**
 * Class PresentationView
 * La vue de la page de de présentation
 * @package App\View
 */
class PresentationView{
    /**
     * Code HTML relatif à la page
     */
    public function Presentation(){
?>
    <section id="pr-container">
        <div class="lp-separator">
            <img src="../../public/assets/material/large-separator.svg" />
        </div>
        <div class="pr-para-container">
<?php
$parag = PresentationController::getInstance()->getPresentation();
foreach($parag as $par){
?>
            <div class="pr-para">
                <?= $par->titre_paragraphe ?><?= $par->contenu_paragraphe ?>
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
        $this->Presentation();
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