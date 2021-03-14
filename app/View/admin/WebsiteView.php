<?php 

namespace App\View\Admin;
use App\Controller\Admin\WebsiteController;

/**
 * Class WebsiteView
 * La vue de la page gestion du site
 * @package App\View\Admin
 */
class WebsiteView{
    /**
     * @var Array $idArticles Tableau des identifiants des articles dispos
     * @var Array $idParagraphes Tableau des identifiants des paragraphes dispos
     */
    private $idArticles = [];
    private $idParagraphes = [];

    /**
     * Code HTML de la partie gestion des articles
     */
    private function getArticles()
    {
?>
<section id="wsp-articles">
    <h1>Gestion des articles</h1>
    <div class="wsp-gestion-btn">
        <a id="add_artc">Ajouter</a>
        <a id="del_artc">Supprimer</a>
    </div>
    <div class="wsp-articles-container">
        <table>
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Titre</a></th>
                </tr>
            </thead>
            <tbody>
<?php
$articles = WebsiteController::getInstance()->getArticles();
$i=0;
foreach($articles as $article){
$this->idArticles[$i]=$article->id_article;
?>
                <tr>
                   <td><?= $article->id_article; ?></td>
                   <td><a class="wsp-article-title"><?php $titre_article = $article->titre_article; $titre_article=str_replace("<h1>", '', $titre_article); $titre_article=str_replace("</h1>", '', $titre_article); echo $titre_article;?></a></td>  
                </tr>
<?php
$i++;
}
?>
            </tbody>
        </table>
    </div>
    <div class="wsp-add-popup">
        <p>Entrez les informations nécessaires</p>
        <form method="post">
            <label for="art_title">Titre de l'article*</label>
            <input type="text" id="art_title" name="art_title">
            <label for="corps_article">Contenu de l'article*</label>
            <input type="textarea" id="corps_article" name="corps_article">
            <label for="link_img">Lien vers l'image de fond</label>
            <input type="text" id="link_img" name="link_img">
            <label for="art_cycle">Utilisateurs concernés*</label>
            <select name="art_cycle[]" id="art_cycle" multiple>
                <option value="Primaire">Primaire</option>
                <option value="Moyen">Moyen</option>
                <option value="Secondaire">Secondaire</option>
                <option value="Parents">Parents</option>
                <option value="Enseignants">Enseignants</option>
            </select>
            <div class="popup-btn" >
                <input type="submit" id="ajoutArticle"  name="ajoutArticle" value="Confirmer">
                <input type="button" id="annulAjout"  name="annulAjout" value="Annuler">
            </div>
        </form>
    </div>
    <div class="wsp-del-popup">
        <form method="post">
            <label for="art_del">id de l'article</label>
            <select name="art_del" id="art_del">
<?php
foreach($this->idArticles as $idArticle){
?>
            <option value="<?= $idArticle ?>"><?= $idArticle ?></option>
<?php
}
?>
            </select>
            <div class="popup-btn" >
                <input type="submit" id="suppArticle"  name="suppArticle" value="Confirmer">
                <input type="button" id="annulsup"  name="annulsup" value="Annuler">
            </div>
        </form>
    </div>
    </section>
<?php
if(isset($_POST["art_title"]) && isset($_POST["corps_article"]) && isset($_POST["art_cycle"])){
    WebsiteController::getInstance()->addArticle($_POST["art_title"], $_POST["corps_article"], $_POST["link_img"], $_POST["art_cycle"]);
}
if(isset($_POST["art_del"])){
    WebsiteController::getInstance()->delArticle($_POST["art_del"]);
}
    }

    /**
     * Code HTML de la partie gestion des présentations
     */
    private function getPresentation(){
?>
        <section id="wsp-presentation">
                <h1>Gestion de la présentation</h1>
                <div class="wsp-gestion-btn">
                    <a id="add_pres">Ajouter</a>
                    <a id="del_pres">Supprimer</a>
                </div>
                <div class="wsp-articles-container">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Paragraphe</a></th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$paragraphes = WebsiteController::getInstance()->getPresentation();
$j=0;
foreach($paragraphes as $paragraphe){
$this->idParagraphes[$j]=$paragraphe->id_paragraphe;
?>
                <tr>
                   <td><?= $paragraphe->id_paragraphe; ?></td>
                   <td><a class="wsp-paragraphe-title"><?php $titre_paragraphe = $paragraphe->titre_paragraphe; $titre_paragraphe=str_replace("<h1>", '', $titre_paragraphe); $titre_paragraphe=str_replace("</h1>", '', $titre_paragraphe); echo $titre_paragraphe;?></a></td>  
                </tr>
<?php
$j++;
}
?>
                        </tbody>
                    </table>
        <div class="wsp-pres-add-popup">
            <p>Entrez les informations nécessaires</p>
            <form method="post">
                <label for="pres_title">Titre de l'élément*</label>
                <input type="text" id="pres_title" name="pres_title">
                <label for="corps_pres">Contenu de l'élément*</label>
                <input type="textarea" id="corps_pres" name="corps_pres">
                <label for="link_pres">Lien vers l'image</label>
                <input type="text" id="link_pres" name="link_pres">
                <div class="popup-btn" >
                    <input type="submit" id="ajoutPres"  name="ajoutPres" value="Confirmer">
                    <input type="button" id="annulPres"  name="annulPres" value="Annuler">
                </div>
            </form>
        </div>
        <div class="wsp-pres-del-popup">
            <form method="post">
                <label for="pres_del">id de l'élément</label>
                <select name="pres_del" id="pres_del">
<?php
foreach($this->idParagraphes as $idParagraphe){
?>
            <option value="<?= $idParagraphe ?>"><?= $idParagraphe ?></option>
<?php
}
?>
                </select>
                <div class="popup-btn" >
                    <input type="submit" id="suppPres"  name="suppPres" value="Confirmer">
                    <input type="button" id="annulSuppPr"  name="annulSuppPr" value="Annuler">
                </div>
            </form>
        </div>
    </section>
<?php
if(isset($_POST["pres_title"]) && isset($_POST["corps_pres"])){
    WebsiteController::getInstance()->addPresentation($_POST["pres_title"], $_POST["corps_pres"], $_POST["link_pres"]);
}
if(isset($_POST["pres_del"])){
    WebsiteController::getInstance()->delParagraphe($_POST["pres_del"]);
}
    }

    public function getContact(){
        
    }

    /**
     * Permet de récupérer la page sans l'afficher
     * @return Buffer Le code HTML de la page
     */
    public function getViewContent()
    {
        //On lance la bufferisation
        ob_start();
        //On garde le contenu de la page dans le buffer
        $this->getArticles();
        $this->getPresentation();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page en elle-même
     */
    public function displayView()
    {
        $this->getArticles();
        $this->getPresentation();
    }
}