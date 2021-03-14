<?php

namespace Core\Table;

use Core\Database\Database;

/**
 * Class Table
 * Factory qui servira les classes model
 * @package Core\Table
 */
class Table
{
    /**
     * @param Database $db Instance de la base (entry point)
     */
    //protected $table;
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
        /*if ($this->table === null) {
            $pts = explode('\\', get_class($this));
            $class_name = end($pts);
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }*/
    }

    /**
     * @param String $statement Requête SQL à effectuer
     * @param String $class Classe concernée
     * @param Array $attributs En cas de requête paramétrée, ce sont les valeurs des ?
     * @param Boolean $one Booléen à vrai si la requête doit renvoyer un seul élément
     * @param Boolean $set Booléen à vrai si la requête doit altérer la base (insertion/suppression..)
     * @return Array $data Résultat de la requête. Les données demandées si c'est un GET, l'id du dernier élément inséré si c'est un SET
     */
    public function query($statement, $class = null, $attributes = null, $one = false, $set=false)
    {
        if ($attributes) {
            $data = $this->db->preparedQuery(
                $statement,
                $attributes,
                $class,
                $one,
                $set
            );
        } else {
            $data = $this->db->query(
                $statement,
                $class,
                $set
            );
        }
        return $data;
    }
}
