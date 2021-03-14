<?php

namespace App\View\Admin;
use App\Controller\Admin\EdtController;

/**
 * Class EdtView
 * La vue de la page de gestion des Edt
 * @package App\View\Admin
 */
class EdtView{
    /**
     * Code HTML de la partie EDT
     */
    private function getEdt(){
    $edt = null;
    $nivchoisi = null;
    $cyclechoisi = null;
    $annchoisi = null;
    $jours = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi"];
    $heures = [1, 2, 3, 4, 5, 6, 7, 8];
?>
<section id="edp-edt">
    <div class="edt-container">
        <h1>Emplois du temps</h1>
        <div class="stgs-container">
            <form method="post">
                <label for="cyc_edt">Cycle d'étude</label>
                <select name="cyc_edt" id="cyc_edt">
<?php
$cycles = EdtController::getInstance()->getCycles();
foreach($cycles as $cycle){
?>
                <option value="<?= $cycle->id_cycle . ' - ' . $cycle->titre_cycle?>"><?= $cycle->titre_cycle?></option>
<?php
}
?>
                </select>
                <input type="submit" id="btn-cyc-edt" name="btn-cyc-edt" value="Rechercher">
            </form>
<?php
if(isset($_POST["cyc_edt"])){
    $cyclechoisi=$_POST["cyc_edt"];
    $niveaux = EdtController::getInstance()->getNiveaux($_POST["cyc_edt"]);
    $annees = EdtController::getInstance()->getAnnees();
}
?>
            <form id="scnd-frm" method="post">
                <input name="svg_cyc" style="display:none" value="<?= $cyclechoisi ?>">
                <label for="niv_edt">Niveau d'étude</label>
                <select name="niv_edt" id="niv_edt">
<?php
if($niveaux){
    foreach($niveaux as $niveau){
?>
                <option value="<?= $niveau->id_niveau . " - " . $niveau->titre_niveau ?>"><?= $niveau->titre_niveau ?></option>
<?php
    }
}
?>
                </select>
                <label for="ann_edt">Année scolaire</label>
                <select name="ann_edt" id="ann_edt">
<?php
if($annees){
    foreach($annees as $annee){
?>
                <option value="<?= $annee->id_annee . " - " . $annee->DateFin ?>"><?= substr($annee->DateFin,0,4); ?></option>
<?php
    }
}
?>
                </select>
                <input type="submit" id="def-edt" name="def-edt" value="Rechercher">
            </form>
<?php
if(isset($_POST["svg_cyc"]) && isset($_POST["niv_edt"]) && isset($_POST["ann_edt"])){
$cyclechoisi = $_POST["svg_cyc"];
$nivchoisi = $_POST["niv_edt"];
$annchoisi = $_POST["ann_edt"];
$classes = EdtController::getInstance()->getClasses($_POST["svg_cyc"] , $_POST["niv_edt"], $_POST["ann_edt"]);
}
?>
            <form id="thrd-frm" method="post">
                <input name="svg_cys" style="display:none" value="<?= $cyclechoisi ?>">
                <input name="svg_niv" style="display:none" value="<?= $nivchoisi ?>">
                <input name="svg_ann" style="display:none" value="<?= $annchoisi ?>">
                <label for="cls_edt"></label>
                <select name="cls_edt" id="cls_edt">
<?php
if($classes){
    foreach($classes as $classe){
?>
            <option value="<?= $classe->id_classe . " - " . $classe->nom_classe ?>"><?= $classe->nom_classe ?></option>
<?php
    }
}
?>
                </select>
                <input type="submit" id="dis-edt" name="dis-edt" value="Afficher">
            </form>
<?php
if(isset($_POST["svg_cys"]) && isset($_POST["svg_niv"]) && isset($_POST["svg_ann"]) && isset($_POST["cls_edt"])){
$edt=EdtController::getInstance()->getEdt($_POST["cls_edt"], $_POST["svg_ann"]);
}
?>
        </div>
        <div class="disp-edt">
            <table>
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Dimanche</a></th>
                    <th scope="col">Lundi</a></th>
                    <th scope="col">Mardi</a></th>
                    <th scope="col">Mercredi</a></th>
                    <th scope="col">Jeudi</a></th>
                </tr>
            </thead>
            <tbody>
                   
<?php
foreach($heures as $heure){
?>
    <tr>
        <th scope="row"><?= $heure ?></th>
<?php
    foreach($jours as $jour){
        if($edt){
            foreach($edt as $chreno){
                if($chreno->jour_seance === $jour && $chreno->heure_seance == $heure){
?>
                        <td><?= $chreno->nom_matiere; ?></td>
<?php
                    
                }
            }
        }
    }
?>
    </tr>
<?php
}
?>
            </tbody>
            </table>
        </div>
    </div>
</section>
<?php
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
        $this->getEdt();
        //On retourne le contenu de la page sans l'afficher
        return ob_get_clean();
    }

    /**
     * Permet d'afficher la page en elle-même
     */
    public function displayView()
    {
        $this->getEdt();
    }
}