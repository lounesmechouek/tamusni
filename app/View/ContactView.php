<?php

namespace App\View;
use App\Controller\ContactController;

/**
 * Class ContactView
 * La vue de la page contact
 * @package App\View
 */
class ContactView{

    /**
     * Permet de récupérer la page sans l'afficher
     * @return Buffer Le code HTML de la page
     */
    public function getViewContent()
    {
        //On lance la bufferisation
        ob_start();
        //On garde le contenu de la page dans le buffer
        
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