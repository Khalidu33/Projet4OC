<?php

namespace models;

class Manager {

    // Connexion à la base de données
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));
        return $db;
    }

}