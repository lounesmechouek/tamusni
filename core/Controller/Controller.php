<?php

namespace Core\Controller;
use App;

/**
 * Class Controller
 * Classe mère dont dérivent les controlleurs concrets, permet de définir les méthodes et attributs génériques
 * @package Core\Controller
 */
class Controller
{
    /**
     * @var String $viewPath Chemin vers le dossier des vues
     * @var String $template Template utilisé par la vue du controlleur
     */
    protected $viewPath = ROOT . "\\app\\View\\";
    protected $template;

    /**
     * @param String $data Chaîne entrée par l'utilisateur
     * @return String Chaîne échappée et sécurisée
     */
    protected function secureInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    /* Fonction en construction : Automatisation de l'affichage des vues
    public function render($view)
    {
        ob_start();
        require $this->viewPath . $view . '.php';
        $content = ob_get_clean();
        var_dump($content);
        require_once $this->viewPath . '\\' . 'templates\\' . $this->template . '.php';
    }
  */

}
