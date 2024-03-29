<?php

namespace controllers;

use models\Message;
use models\UserManager;

class UserController {

    // Enregistrer un utilisateur
    public function register($pseudo, $password, $email)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $newMessage = new Message();
            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']))
            {
                // Si la longueur du pseudo excède 50 caractères
                $pseudoLength = strlen($pseudo);
                if ($pseudoLength <= 50)
                {
                    // Vérifie la syntaxe de l'adresse mail
                    if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email))
                    {
                        // Lettres minuscules/majuscules et chifres autorisés seulement
                        if(preg_match("#^[a-zA-Z0-9]+$#", $pseudo))
                        {
                            $newUserManager = new UserManager();
                            $newUserManager->checkUserPseudo($pseudo);
                            $checkedUserPseudo = $GLOBALS['checkedUserPseudo'];
                            if ($checkedUserPseudo == 0)
                            {
                                $newUserManager = new UserManager();
                                $newUserManager->checkUserEmail($email);
                                $checkedUserEmail = $GLOBALS['checkedUserEmail'];
                                if ($checkedUserEmail == 0)
                                {
                                    
                                    
                                    if ($_POST['password'] == $_POST['password_confirm'])
                                    {                                         
                                        if (preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['password']))
                                        {
                                            $newUserManager->addUser($pseudo, $password, $email);
                                            $newMessage->setSuccess("<p>Votre compte a bien été crée ! <a href='?controller=UserController&action=loginAction'>Me connecter</a></p>");
                                        }
                                        else
                                        {
                                            $newMessage->setError("<p>Votre mot de passe doit contenir un minimum de 8 caractères!<br/>
                                            au moins une lettre majuscule!<br/>
                                            au moins une lettre minuscule!<br/>
                                            au moins un chiffre!<br/>
                                            au moins un caractère spéciale!</p>");
                                        }
                                    }
                                    else
                                    {
                                        $newMessage->setError("<p>Vos mots de passe sont différents !</p>");
                                    }
                                }
                                else
                                {
                                    $newMessage->setError("<p>Cette adresse email est déjà utilisée !</p>");
                                }
                            }
                            else
                            {
                                $newMessage->setError("<p>Ce pseudo est déjà pris !</p>");
                            }
                        }
                        else
                        {
                            $newMessage->setError("<p>Votre pseudo n'est pas valide !</p>");
                        }
                    }
                    else
                    {
                        $newMessage->setError("<p>Votre adresse email n'est pas valide !</p>");
                    }
                }
                else
                {
                    $newMessage->setError("<p>Votre pseudo ne doit pas dépasser 50 caractères !</p>");
                }
            }
            else
            {
                $newMessage->setError("<p>Tous les champs doivent être rempli !</p>");
            }
        }
        // Vue
        require_once ('views/register.php');
    }

    // Se connecter avec des identifiants en base
    public function login($pseudo, $password)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $newMessage = new Message();
            if (!empty($_POST['pseudo']) && !empty($_POST['password']))
            {
                $newUserManager = new UserManager();
                $newUserManager->checkUserParams($_POST['pseudo']);
                $checkedUserParams = $GLOBALS['checkedUserParams'];
                $isPasswordCorrect = password_verify($_POST['password'], $checkedUserParams['password']);
                if ($isPasswordCorrect == true)
                {
                    $_SESSION['id'] = $checkedUserParams['id'];
                    $_SESSION['pseudo'] = $checkedUserParams['pseudo'];
                    $_SESSION['email'] = $checkedUserParams['email'];
                    $_SESSION['level'] = $checkedUserParams['level'];

                    // Redirection vers la page souhaitée après connexion
                    header('Location: index.php');
                } else {
                    $newMessage->setError("<p>Vos identifiants ne sont pas bons !</p>");
                }
            } else {
                $newMessage->setError("<p>Tous les champs doivent être rempli !</p>");
            }
        }
        // Vue
        require_once ('views/login.php');
    }
}