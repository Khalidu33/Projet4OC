<!-- Titre de la page -->
<?php $title = 'Erreur'; ?>

<!-- Contenu de la page -->
<?php ob_start(); ?>

<h1>Erreur d'acces</h1>
<br />
<h4><a href="index.php" title="Accueil">Revenir à l'accueil du site</a></h4>


<?php $content = ob_get_clean(); ?>

<!-- Vue requise -->
<?php require_once('views/template.php'); ?>
