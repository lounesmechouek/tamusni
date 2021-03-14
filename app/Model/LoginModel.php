<?php
namespace App\Model;
use Core\Table\Table;
use App;

/**
 * Class LoginModel
 * Permet de gérer l'accès aux ressources nécessaires pour les espaces parent et élève
 * @package App\Model
 */
class LoginModel extends Table{
    /**
     * @var String $title Titre de la page
     * @var Array $articles Tableau des articles disponibles
     */
    private $title = "Espace de connexion";
    private $articles;

    public function __construct(){
        parent::__construct(App::getDb());
    }

    /**
     * @return String Le titre de la page
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $typeusr Type de l'utilisateur (parent/élève)
     * @return Array Tableau des articles qui intéressent ce type d'utilisateur
     */
    public function getArticles($typeusr){
        if($this->articles === null){
            $this->articles = $this->query("SELECT * FROM `concerner2` JOIN `article` WHERE `article`.id_article = `concerner2`.id_article && `concerner2`.type_user = ?", null, [$typeusr], false, false);
        }
        return $this->articles;
    }

}