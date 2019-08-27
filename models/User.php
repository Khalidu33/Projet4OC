<?php

namespace model;

class User {

    /* Attributs */
    private $id;
    private $pseudo;
    private $password;
    private $email;
    private $level;

    /* Constantes */

    /* Constructeur */
    public function __contruct ($id, $pseudo, $password, $email) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->email = $email;
        $this->level = $level;
    }

    /* Getters */
    public function getId() {
        return $this->id;
    }
    public function getPseudo() {
        return $this->pseudo;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getLevel() {
        return $this->level;
    }

    /* Setters */
    public function setId($id) {
        $this->id = $id;
    }
    public function setPseudo($pseudo) {
        $this->id = $pseudo;
    }
    public function setPassword($password) {
        $this->id = $password;
    }
    public function setEmail($email) {
        $this->id = $email;
    }
    public function setLevel($level) {
        $this->id = $level;
    }
}