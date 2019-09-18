<?php

namespace models;

class Manager {

    // Connexion à la base de données
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=db5000151643.hosting-data.io;dbname=dbs146759;charset=utf8', 'dbu137786', 'Khd331996$', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));
        return $db;
    }

}