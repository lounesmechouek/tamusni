<?php

namespace App\Model;

use Core\Table\Table;
use App;

/**
 * Class EdtModel
 * Model relatif à la page de gestion des utilisateurs
 * @package App\Model
 */
class EdtModel extends Table{
    /**
     * @var String $title Titre de la page
     * @var Array $cycles Tableau des cycles d'enseignement dispos
     * @var Array $niveaux Tableau des niveaux dispos
     * @var Array $annees Tableau des années disponibles
     * @var Array $classes Tableau des classes disponibles
     * @var Array $edt 
     */
    private $title = "Gestion des Edt";
    private $cycles;
    private $niveaux;
    private $annees;
    private $classes;
    private $edt;

    public function __construct()
    {
        parent::__construct(App::getDb());
    }

    /**
     * @return String Titre de la page
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return Array Tableau des cycles dispos
     */
    public function getCycles(){
        if($this->cycles===null){
            $this->cycles = $this->query("SELECT * FROM `cycleenseignement`");
        }
        return $this->cycles;
    }

    /**
     * @return Array Tableau des années dispos
     */
    public function getAnnees(){
        if($this->annees === null){
            $this->annees = $this->query("SELECT * FROM `anneescolaire`");
        }
        return $this->annees;
    }

    /**
     * @param Integer $cycle l'identifiant du cycle
     * @return Array Tableau des cycles disposibles pour un cycle donnée (ex: pour le cycle primaire 1P-2P-3P-4P-5P)
     */
    public function getNiveauxCycle($cycle){
        return $this->query("SELECT * FROM `niveauetude` WHERE `niveauetude`.`id_cycle` = ?", null, [$cycle], false, false);
    }

    /**
     * @param Integer $cycle l'identifiant du cycle
     * @param Integer $niveau l'identifiant du niveau
     * @param Integer $année l'identifiant de l'année
     * @return Array Tableau des classes disponibles pour un cycle et un niveau donnés à une année scolaire donnée (ex: les classes de 3e année du primaire en 2021 : 3P1-3P2-3P3)
     */
    public function getClassesNiveau($cycle, $niveau, $annee){
        return $this->query("SELECT * FROM `classe` WHERE `classe`.`id_niveau` = ? && `classe`.`id_cycle` = ?", null, [$niveau, $cycle], false, false);
    }

    /**
     * @param Integer $classe l'identifiant de la classe
     * @param Integer $annee l'identifiant de l'année
     * @return Array Tableau contenant le programme (emploi du temps) de la classe pour l'année scolaire spécifiée 
     *               L'année scolaire est définie par une date début et une date de fin (on peut donc la considérer comme trimestre/semestre)
     */
    public function getEdtClasse($classe, $annee){
        return $this->edt = $this->query("SELECT * FROM `dispenser` JOIN `matiere` WHERE `dispenser`.`id_classe` = ? && `dispenser`.`id_annee` = ? && `dispenser`.`id_matiere` = `matiere`.`id_matiere`", null, [$classe, $annee], false, false);
    }
}