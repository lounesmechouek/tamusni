<?php
namespace App\Model;
use Core\Table\Table;
use App;

/**
 * Class WebsiteModel
 * Accès aux informations concernant la page de gestion du site
 * @package App\Model
 */
class WebsiteModel extends table{
    /**
     * @var String $title Titre de la page 
     * @var Array $article Tableau des articles disponibles
     * @var Array $presentation Tableau des paragraphes disponibles 
     */
    private $title = "Gestion du site";
    private $article;
    private $presentation;

    public function __construct(){
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
     * @return Array Les articls disponibles
     */
    public function getArticles()
    {
        if ($this->article === null) {
            $this->article = $this->query("SELECT * FROM `article`");
        }
        return $this->article;
    }

    /**
     * @return Array Les paragraphes disponibles
     */
    public function getPresentation(){
        if ($this->presentation === null) {
            $this->presentation = $this->query("SELECT * FROM `paragraphepresentation`");
        }
        return $this->presentation;
    }

    /**
     * @param String $titre Titre de l'article
     * @param String $contenu Contenu de l'article
     * @param String $img Lien de l'image de l'article
     * @param String $typeUsr Le type de l'utilisateur concerné par cet article (parent/eleve/cycle primaire/moyen/secondaire)
     */
    public function addArticle($titre, $contenu, $img=null, $typeUsr){
        $id_ar = $this->query("INSERT INTO `article` (`id_article`, `titre_article`, `corps_article`, `image_article`) VALUES (NULL, ?, ?, ?)", null, [$titre, $contenu, $img], false, true);
        $this->article = null;

        foreach($typeUsr as $type){
           if($type === "Primaire" || $type === "Moyen" || $type === "Secondaire"){
                $type = "Cycle" . " " . $type;
                $id_tp = $this->query("SELECT `id_cycle` FROM `cycleenseignement` WHERE `titre_cycle` = ?", null, [$type], true, false);
                $this->query("INSERT INTO `traiter` (`id_article`, `id_cycle`) VALUES (?, ?)", null, [$id_ar ,$id_tp->id_cycle], false, true);
           }else{
                $type = substr($type, 0, -1);
                $type=strtolower($type); 
                $this->query("INSERT INTO `concerner2` (`id_article`, `type_user`) VALUES (?, ?)", null, [$id_ar, $type], false, true);
           }
        }

    }

    /**
     * @param Integer $idArticle Identifiant de l'article à supprimer
     */
    public function delArticle($idArticle){
        $this->query("DELETE FROM `article` WHERE `article`.`id_article` = ?", null, [$idArticle], false, true);
        $this->article = null;

        $this->query("DELETE FROM `concerner2` WHERE `concerner2`.`id_article` = ?", null, [$idArticle], false, true);
        $this->query("DELETE FROM `traiter` WHERE `traiter`.`id_article` = ?", null, [$idArticle], false, true);
    }

    /**
     * @param String $titre Titre du paragraphe
     * @param String $contenu Contenu de paragraphe
     * @param String $img Lien de l'image
     */
    public function addPresentation($titre, $contenu, $img=null){
        $id_pres = $this->query("INSERT INTO `paragraphepresentation` (`id_paragraphe`, `titre_paragraphe`, `contenu_paragraphe`, `image_paragraphe`) VALUES (NULL, ?, ?, ?)", null, [$titre, $contenu, $img], false, true);
        $this->presentation = null;
    }

    /**
     * @param Integer idParagraphe Identifiant du paragraphe à supprimer 
     */
    public function delParagraphe($idParagraphe){
        $this->query("DELETE FROM `paragraphepresentation` WHERE `paragraphepresentation`.`id_paragraphe` = ?", null, [$idParagraphe], false, true);
        $this->presentation = null;
    }
}