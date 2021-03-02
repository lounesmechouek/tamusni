<?php

namespace Core\Table;

use Core\Database\Database;

/**
 * Factory qui servira les classes concrète du modèle
 */
class Table
{
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

    public function query($statement, $class = null, $attributes = null, $one = false)
    {
        if ($attributes) {
            $data = $this->db->preparedQuery(
                $statement,
                $attributes,
                $class,
                $one
            );
        } else {
            $data = $this->db->query(
                $statement,
                $class
            );
        }
        return $data;
    }
}
