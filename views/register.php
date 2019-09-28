<!-- Titre de la page -->
<?php $title = 'Inscription'; ?>

<!-- Contenu de la page -->
<?php ob_start(); ?>

<h1>Inscription</h1>
<br />

<form action="?controller=UserController&action=registerAction" method="POST">

    <div class="form-group">
        <label>Pseudo :</label>
        <input type="text" name="pseudo" class="form-control" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>">
    </div>

    <div class="form-group">
        <label>Mot de passe :</label>
        <input type="password" name="password" placeholder="minimum 8 caractères au moins une lettre minuscule, une lettre majuscule, un chiffre, un caractère spéciale" class="form-control">
    </div>

    <div class="form-group">
        <label>Confirmez le mot de passe :</label>
        <input type="password" name="password_confirm" placeholder="minimum 8 caractères au moins une lettre majuscule, une lettre minuscule, un chiffre, un caractère spéciale" class="form-control">
    </div>

    <div class="form-group">
        <label>Email :</label>
        <input type="email" name="email" placeholder="exemple@hotmail.fr" class="form-control" value="<?php if(isset($email)) { echo $email; } ?>">
    </div>

    <button type="submit" class="btn btn-primary">M'inscrire</button>

</form>
<hr>

<?php $content = ob_get_clean(); ?>

<!-- Vue requise -->
<?php require_once('views/template.php'); ?>
