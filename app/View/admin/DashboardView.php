<?php

namespace App\View\Admin;

/**
 * Class DashboardView
 * La vue de la page Dashboard
 * @package App\View\Admin
 */
class DashboardView {

    /**
     * Code HTML des cadres de l'administrateur
     */
    private function getCadres(){
?>
<section id="addh-cadres">
    <div class="addh-container">

    </div>
</section>
<?php
    }

    /**
     * Code HTML de la partie statistiques
     */
    private function getStats(){
?>

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
        $this->getCadres();
        $this->getStats();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page en elle-même
     */
    public function displayView(){
        $this->getCadres();
        $this->getStats();
    }
}