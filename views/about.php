<!-- Titre de la page -->
<?php $title = 'A propos de moi'; ?>

<!-- Contenu de la page -->
<?php ob_start(); ?>

<h1>A propos de moi</h1>
<br/>
<br/>
<br/>
<p>
    Jean Forteroche est né en 1966 sur l'île Adak, en Alaska, et y a passé une partie de son enfance avant de
    s'installer en France avec sa mère et sa sœur.
    Il a rédigé son premier roman LES NAUFRAGES lors d'un voyage en mer.
</p>
<p>
    Après avoir parcouru plus de 40 000 milles sur les océans, il échoue lors de sa tentative de tour du monde en
    solitaire sur un trimaran qu'il a dessiné et construit lui-même.
    En 2013, il publie LE DERNIER MILE récit de son propre naufrage dans les Caraïbes lors de son voyage de noces
    quelques années plus tôt.
</p>
<p>
    Ce livre fait partie de la liste des best-sellers du Figaro. Publié en France en janvier 2010, LES NAUFRAGES
    remporte immédiatement un immense succès. Il remporte le prix Médicis et s'est vendu à plus de 300 000 exemplaires.
    Porté par son succès, Jean Forteroche est aujourd'hui traduit en dix-huit langues dans plus de soixante pays. Une
    adaptation cinématographique par une société de production française est en cours.
    En 2017, il décide de publier en ligne chapitre par chapitre sur son propre site, son dernier roman : BILLET SIMPLE
    POUR L'ALASKA.
</p>
<hr>

<?php $content = ob_get_clean(); ?>

<!-- Vue requise -->
<?php require_once('views/template.php'); ?>
