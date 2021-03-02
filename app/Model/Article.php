<?php
require_once ROOT . '/app/Controller/AppController.php';
/**
 * Class Article
 * Accès aux articles -- Rmq : faire un extends de Table à l'implémentation
 */

class Article
{
    /**
     * Ajoute un article à la base de données
     * @param string $titreArticle : Le titre de l'article
     * @param string $imageArticle : Nom (optionnel) de l'image, stocké dans public/assets
     * @param string $corpsArticle : L'article en lui-même 
     */
    public function addArticle($titreArticle, $imageArticle = null, $corpsArticle)
    {
    }

    /**
     * Recupère un article depuis la base de données
     * @param int $idArticle : L'id de l'article
     * @return Article
     */
    public function getArticle($idArticle)
    {
    }

    /**
     * Recupère tous les articles depuis la base de données
     * @return array la liste des articles
     */
    public function getAllArticles()
    {
    }

    /**
     * Ajoute un type utilisateur concerné par l'article à la BDD
     * @param string $idType : l'id du type utilisateur
     */
    public function addTypeUserArticle($idType)
    {
    }

    /**
     * Recupère tous les types utilisateurs concernés par cet article
     * @return array : La liste des types utilisateurs
     */
    public function getTypeUsersArticle()
    {
    }

    /**
     * Ajoute un cycle concerné par l'article à la BDD
     * @param string $idCycle : l'id du Cycle
     */
    public function addCycleArticle($idCycle)
    {
    }

    /**
     * Recupère tous les cycles concernés par cet article
     * @return array : La liste des cycles
     */
    public function getCyclesArticle()
    {
    }
}
