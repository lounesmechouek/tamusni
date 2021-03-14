<?php
namespace App\Model;
use App;
use Core\Table\Table;

/**
 * Class CycleModel
 * Model permettant l'accès aux données concernant la page des cycles
 * @package App\Model
 */
class CycleModel extends Table{
    /**
     * @var String $titre Titre de la page
     */
    private $title = "Cycles d'enseignement";

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
}