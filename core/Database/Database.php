<?php

namespace Core\Database;

use PDO;

/**
 * Class Database
 * Manipule PDO et accède explicitement à la base
 * @package Core\Database
 */
class Database
{
    /**
     * @var String $db_name Nom de la base
     * @var String $db_user Identifiant de la base
     * @var String $db_pass Mot de passe
     * @var String $db_host IP de la base
     * @var PDO pdo pour l'accès à la base
     */
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

    /**
     * @return PDO Effectue une connexion la base et renvoie le PDO
     */
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

    /**
     * Effectue une requête non paramétrée
     * @param String $statement Requête SQL à exécuter
     * @param String $class Classe concernée (Représente une classe du modèle correspondant à un concept de la bdd : Note, Matière, Utilisateur...etc)
     * @param Boolean $set Booléen à vrai si la requête à exécuter doit altérer la base (insertion/suppression/update...etc)
     */
    public function query($statement, $class = null, $set=false)
    {
        $data=null;
        $pdo = $this->getPDO();
        try{
            $req = $pdo->query($statement);
        }catch(Exception $e){
            echo "Erreur lors de l'ajout à la base";
            return $e;
        }

        if ($class === null) {
            $req->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $req->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        if(!$set){
            $data = $req->fetchAll();
        }
        return ($data);
    }

    /**
     * Effectue une requête paramétrée
     * @param String $statement Requête SQL à exécuter
     * @param Array $attributes Les paramètres de la requête
     * @param String $class Classe concernée (Représente une classe du modèle correspondant à un concept de la bdd : Note, Matière, Utilisateur...etc)
     * @param Boolean $oneElt Booléen à vrai si la requête doit renvoyer un seul résultat
     * @param Boolean $set Booléen à vrai si la requête à exécuter doit altérer la base (insertion/suppression/update...etc)
     * @return Array Les données demandées si c'est un GET, l'id du dernier élément inséré si c'est un SET
     */
    public function preparedQuery($statement, $attributes, $class = null, $oneElt = false, $set=false)
    {
        $data=null;
        $this->getPDO();
        try{
            $req = $this->pdo->prepare($statement);
            $res = $req->execute($attributes);
        }catch(Exception $e){
            echo "Une erreur s'est produite durant l'ajout à la base";
        }
        if($class === null){
            $req->setFetchMode(PDO::FETCH_OBJ);
        }else{
            $req->setFetchMode(PDO::FETCH_CLASS, $class);
        }

        if($set === false){
            if ($oneElt) {
                $data = $req->fetch();
            } else {
                $data = $req->fetchAll();
            }
        }else{
            $data = $this->pdo->lastInsertId();
        }
        return ($data);
    }
}
