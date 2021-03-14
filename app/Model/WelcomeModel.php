<?php

namespace App\Model;

use App;
use Core\Table\Table;

/**
 * Class WelcomeModel
 * Model permettant l'accès aux données concernant la homepage
 * @package App\Model
 */
class WelcomeModel extends Table
{
    /**
     * @var String $title Titre de la page
     * @var Array $diapo Diapos disponibles
     * @var Array $articles Articles disponibles
     */
    private $title = "Bienvenue !";
    private $diapo;
    private $articles;

    public function __construct()
    {
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
     * @return Array Tableau des objets diapos disponibles
     */
    public function getDiapo()
    {
        if ($this->diapo === null) {
            $this->diapo = $this->query("SELECT `imageDiapo`, `textOverlay` FROM `diapoelement`");
        }
        return $this->diapo;
    }

    /**
     * @return Array Tableau des objets articles disponibles
     */
    public function getArticles(){
        if($this->articles === null){
            $this->articles = $this->query("SELECT * FROM `article`");
        }
        return $this->articles;
    }
}
