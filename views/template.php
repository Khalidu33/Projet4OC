<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $title ?></title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="public/css/bootstrap.css">

        <!-- Style général de la page -->
        <link rel="stylesheet" href="public/css/style1.css">

        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    </head>

    <body>

        <div class="container-fluid">
            <nav class="navbar navbar-inverse">
                <div class="container-fluid">
                    <!-- Hamburger -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php" title="Accueil" >Accueil</a>
                    </div>
                    <!-- Menu -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav">
                            <li><a href="?controller=PostController&action=indexAction" title="Lire les anciens billets">Liste des chapitres</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            if(empty($_SESSION)) {
                                ?>
                                <li><a href="?controller=UserController&action=registerAction" title="S'incrire">Inscription</a></li>
                                <li><a href="?controller=UserController&action=loginAction" title="Se connecter">Connexion</a></li>
                                <?php
                            }
                            ?>
                            <?php
                            if(isset($_SESSION) && !empty($_SESSION) && (($_SESSION['level'] == 0) || ($_SESSION['level'] == 1)))
                            {
                                ?>
                                <li><a href="?controller=AdminController&action=indexAction" title="Espace d'administration">Administration</a></li>
                                <?php
                            }
                            ?>                    
                            <?php
                            if(isset($_SESSION) && !empty($_SESSION))
                            {
                                ?>
                                <li><a href="?controller=UserController&action=logoutAction" title="Se déconnecter">Déconnexion</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container">
            <!-- Messages d'alerte -->
            <?php require_once ('inc/_alertMessage.php'); ?>

            <!-- Contenu de la page -->
            <?= $content ?>

        </div><!-- /.container -->
        
        <?php require_once ('footer.php') ?>
        
    </body>
</html>
