<?php

namespace App\Model;

use Core\Table\Table;
use App;

/**
 * Class PresentationModel
 * Ressource nécessaire à la page présentation
 * @package App\Model
 */
class PresentationModel extends Table{
    /**
     * @var String $title Titre de la page
     * @var Array $presentation Liste des paragraphes disponibles
     */
    private $title = "Présentation";
    private $presentation;

    public function __construct()
    {
        parent::__construct(App::getDb());
    }

    /**
     * @return String Le titre de la page
     */
    public function getTitle(){
        return $this->title;
    }

    /**
     * @return Array Tableau des présentation disponibles
     */
    public function getPresentation(){
        if($this->presentation === null){
            $this->presentation=$this->query("SELECT * FROM `paragraphepresentation`");
        }
        return $this->presentation;
    }
}