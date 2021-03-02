<?php 

namespace App\View;

class ErrorView{
    private function accessDenied(){
?>
<section id="ep-ad">
    <div class="ep-ad-container">
        <p>Désolé, une erreur s'est produite lors de votre tentative d'accès à cette page. Vous ne disposez peut-être pas des droits nécessaires.</p>
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

    public function displayView(){
        $this->accessDenied();
    }
}