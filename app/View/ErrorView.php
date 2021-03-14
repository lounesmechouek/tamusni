<?php 

namespace App\View;

/**
 * Class ErrorView
 * La vue de la page d'erreur
 * @package App\View
 */
class ErrorView{
    /**
     * Type de page : Accès refusé
     */
    private function accessDenied(){
?>
<section id="ep-ad">
    <div class="ep-ad-container" style="margin:13.5%">
        <p style="font-size:20px">Désolé, une erreur s'est produite lors de votre tentative d'accès à cette page. Elle n'est pas disponible pour le moment, ou vous ne disposez peut-être pas des droits nécessaires pour y accéder.</p>
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
        $this->accessDenied();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Affichage de la page en elle-même
     */
    public function displayView(){
        $this->accessDenied();
    }
}