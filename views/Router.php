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
                }
                // Si on tente d'acéder à un autre controller
                else {
                    require_once ('views/error.php');
                }
            }
            else {
              require_once ('views/login.php');
            }
        }
        catch (Exception $e){

        }
    }
}