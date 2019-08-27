<?php

namespace models;

class UserManager extends Manager {

    // Ajouter un utilisateur à la base de données
    public function addUser($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $request = $db->prepare('INSERT INTO users (pseudo, password, email, level) VALUES (?, ?, ?, 2)');
        $request->execute(array($pseudo, $password, $email));
    }

    // Vérifier si le pseudo existe en base (fonction inscription)
    public function checkUserPseudo($pseudo)
    {
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $request->execute(array($pseudo));
        global $checkedUserPseudo;
        $checkedUserPseudo = $request->rowCount();
        return $checkedUserPseudo;
    }

    // Vérifier si l'email existe en base
    public function checkUserEmail($email)
    {
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE email = ?');
        $request->execute(array($email));
        global $checkedUserEmail;
        $checkedUserEmail = $request->rowCount();
        return $checkedUserEmail;
    }


    // Vérifie si le pseudo existe en base (fonction connexion)
    public function checkUserParams($pseudo)
    {
        $db = $this->dbConnect();
        $request = $db->prepare('SELECT * FROM users WHERE pseudo = ?');
        $request->execute(array($pseudo));
        global $checkedUserParams;
        $checkedUserParams = $request->fetch();
        return $checkedUserParams;
    }

}