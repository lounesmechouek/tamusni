<?php

namespace Core\Database;

use PDO;

/**
 * Accès unique à la base de donnée
 * Patron singleton appliqué
 */
class Database
{
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name = '', $db_user = '', $db_pass = '', $db_host = '')
    {
        $this->db_name = $db_name;
        $this->db_pass = $db_pass;
        $this->db_user = $db_user;
        $this->db_host = $db_host;
    }

    private function getPDO()
    {
        if ($this->pdo === null) {
            $dsn = 'mysql:dbname=' . $this->db_name . ';host=' . $this->db_host;
            $this->pdo = new PDO($dsn, $this->db_user, $this->db_pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return $this->pdo;
    }

    public function query($statement, $class = null)
    {
        $pdo = $this->getPDO();
        $req = $pdo->query($statement);

        if ($class === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        $data = $req->fetchAll();
        return ($data);
    }

    public function preparedQuery($statement, $attributes, $class = null, $oneElt = false)
    {
        $this->getPDO();
        $req = $this->pdo->prepare($statement);
        $req->execute($attributes);
        if($class === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        if ($oneElt) {
            $data = $req->fetch();
        } else {
            $data = $req->fetchAll();
        }

        return ($data);
    }
}
