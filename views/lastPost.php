<!-- Titre de la page -->
<?php $title = 'Dernier chapitre'; ?>

<!-- Contenu de la page -->
<?php ob_start(); ?>

<div class="presentation">
    <h2>Bienvenue !</h2>
    <p>Je vous souhaite la bienvenue sur ce blog spécialement créé pour mon nouveau roman "Billet simple pour l'Alaska".
    J'ai décidé de publié ce nouveau roman par étapes que vous pourrez suivre régulièrement ici. Je vous souhaite une bonne lecture.
    </p>
    <p>- Jean Forteroche -</p>
</div>

<br/>

<h3>Dernier chapitre publié :</h3>
<br />
<article>
    <h4><?php echo $lastPost['title'] ?></h4>
    <br />
    <p>Paru le : <?php echo $lastPost['added_datetime_fr'] ?> <br />
    <p><?= substr (nl2br(html_entity_decode($lastPost ['content'])), 0, 300) . '...' ?>
    <a href="?controller=PostController&action=showAction&id=<?= $lastPost['id'] ?>" title="Lire le billet" >Lire la suite</a></p>
</article>
<hr>

<?php $content = ob_get_clean(); ?>

<!-- Vue requise -->
<?php require_once('views/template.php'); ?>
