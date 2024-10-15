<?php

class UserModel {
    private $db;

    function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=catalogo_peliculas;charset=utf8', 'root', '');
    }
 
    function getUser($usuario) {    
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $query->execute([$usuario]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}