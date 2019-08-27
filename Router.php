<?php
namespace controllers;
session_start();
// Autoloader de classe
require_once ('vendor/autoload.php');

class Rout{
    public function __construct(){
        try{
            // Si présence d'un controller
            if (isset($_GET['controller'])) {
                // Si présence d'une action
                if (isset($_GET['action'])) {
                    // UserController
                    if ($_GET['controller'] == 'UserController') {
                        // Inscription
                        if ($_GET['action'] == 'registerAction') {
                            // Conditions ternaires
                            $pseudo = isset($_POST['pseudo']) ? strip_tags($_POST['pseudo']) : NULL;
                            $password_hash = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : NULL;
                            $email = isset($_POST['email']) ? strip_tags($_POST['email']) : NULL;
                            $newUserController = new UserController();
                            $newUserController->register($pseudo, $password_hash, $email);
                        }
                        // Connexion
                        elseif ($_GET['action'] == 'loginAction') {
                            // Conditions ternaires
                            $pseudo = isset($_POST['pseudo']) ? strip_tags($_POST['pseudo']) : NULL;
                            $password = isset($_POST['password']) ? strip_tags($_POST['password']) : NULL;
                            $newUserController = new UserController();
                            $newUserController->login($pseudo, $password);
                        }
                        // Déconnexion
                        elseif ($_GET['action'] == 'logoutAction') {
                            require_once ('views/logout.php');
                        }
                        // Si une autre action est tapée dans l'URL
                        else {
                            require_once ('views/error.php');
                        }
                    }
                    
                    // PostController
                    elseif ($_GET['controller'] == 'PostController') {
                        // Affiche la liste des billets en ligne
                        if ($_GET['action'] == 'indexAction') {
                            $newPostController = new PostController();
                            $newPostController->indexAction();
                        }
                        // Affiche le contenu d'un billet et ses commentaires
                        elseif ($_GET['action'] == 'showAction') {
                            if (isset($_GET['id']) && $_GET['id'] > 0) {
                                $newPostController = new PostController();
                                $newPostController->showAction($_GET['id']);
                            } 
                            else {
                                // erreur 404
                                require_once ('views/error.php');
                            }
                        }
                        // Obtenir les informations sur l'auteur
                        elseif ($_GET['action'] == 'about') {
                            require_once 'views/about.php';
                        }
                        elseif (isset($_SESSION) && !empty($_SESSION)){
                            // Publier un commentaire
                            if ($_GET['action'] == 'addCommentAction') {
                                if (isset($_GET['id']) && $_GET['id'] > 0) {
                                    // Conditions ternaires
                                    $author = isset($_POST['author']) ? strip_tags($_POST['author']) : NULL;
                                    $content = isset($_POST['content']) ? strip_tags($_POST['content']) : NULL;
                                    $newCommentController = new CommentController();
                                    $newCommentController->addCommentAction($_GET['id'], $author, $content);
                                } else {
                                    // erreur 404
                                    require_once ('views/error.php');
                                }
                            }
                            // Signaler un commentaire sous un billet
                            elseif ($_GET['action'] == 'alertCommentAction') {
                                if (isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['post_id']) && $_GET['post_id'] > 0) {
                                    $newCommentController = new CommentController();
                                    $newCommentController->alertCommentAction($_GET['id'], $_GET['post_id']);
                                }
                            }
                            // Si une autre action est tapée dans l'URL
                            else {
                                require_once ('views/error.php');
                            }
                        }
                    }
                }
                // Si on tente d'acéder à un autre controller
                else {
                    require_once ('views/error.php');
                }
            }
            else {
                // Page d'accueil du site, affiche le dernier billet publié
                $newPostController = new PostController();
                $newPostController->showLastPostAction();
            }
        }
        catch (Exception $e){

        }
    }
}