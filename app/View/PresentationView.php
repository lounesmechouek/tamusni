<?php foreach ($db->preparedQuery('SELECT * FROM `formation` WHERE id = ?', [$_GET['id']], 'App\Table\Formation', true) as $formation) : ?>
    <h2><a href="<?php $formation->getURL(); ?>"><?= $formation->Nom_formation; ?></a></h2>
<?php endforeach; ?>