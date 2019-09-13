<!-- Titre de la page -->
<?php $title = 'Liste des chapitres'; ?>

<!-- Contenu de la page -->
<?php ob_start(); ?>

<h3>Chapitres précédents :</h3><br />

<?php
while ($post = $posts->fetch())
{
?>
    <article>
        <h4><?= (html_entity_decode($post['title'])) ?></h4>
        <p>Ajouté le <?= $post['added_datetime_fr'] ?></p>
        <!--Limite le nombre de caractères du contenu affichés à l'accueil-->
        <p><?= substr (nl2br(html_entity_decode($post ['content'])), 0, 251) . '...' ?>
        <a href="?controller=PostController&action=showAction&id=<?= $post['id'] ?>" title="Lire le billet" >Lire la suite</a></p>
    </article>
<br />
<?php
}
?> 
        <ul class="pagination">
            <li><a href="?controller=PostController&action=indexAction&p=<?php if($current != '1'){echo $current-1;}else{echo $current;} ?>">&laquo;</a></li>
        <?php
            for($i = 1; $i <= $nbPage; $i++){
                if($i == $current){
        ?>
                    <li class="active"><a href="?controller=PostController&action=indexAction&p=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php
                }
                else{
        ?>
                    <li><a href="?controller=PostController&action=indexAction&p=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php
                }
            }
        ?>
            <li><a href="?controller=PostController&action=indexAction&p=<?php if($current != $nbPage){echo $current+1;}else{echo $current;} ?>">&raquo;</a></li>
        </ul>
<?php
$posts->closeCursor();
?>
<hr>

<?php $content = ob_get_clean(); ?>

<!-- Vue requise -->
<?php require_once('views/template.php'); ?>
