<?php 

namespace App\View;
use App\Controller\CycleController;

/**
 * Class CycleView
 * La vue de la page cycles
 * @package App\View
 */
class CycleView{
    /**
     * Code HTML relatif aux cadres (personnalisé pour chaque type d'utilisateur)
     */
    private function cadres($cyc){
?>
<section id="wp-menu">
    <div class='wp-menu-container'>
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
        if(isset($_GET["page"]) && $_GET["page"]!="cycles"){
            $pggy = $_GET["page"];
            $pggy=explode('.', $pggy);
            $this->cadres($pggy[1]);
        }
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page directement
     */
    public function displayView()
    {
    
    }
}