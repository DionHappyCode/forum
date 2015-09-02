<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginManager
 *
 * @author Stagiaire
 */
require 'f:/wamp/www/blog/modules/Login.php';
require 'f:/wamp/www/blog/services/connection-bdd.php';

class LoginManager {
     private $db; // Instance de PDO
    
    //Connexion bdd
    public function __construct($db){
        $this->db = $db;
    }
    
//Cryptage du mot de passe
    private function hash($password) {
        $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 14]);
        
        return $password;
    }
    
//Inscription d'un utilisateur
    public function inscrMembre($login, $password, $date, $type, $useron) {
        $req = $this->db->prepare("INSERT INTO users(login, password, date_inscr, type, useron)"
                                . "VALUES(:login, :password, :date, :type, :useron)");
        $req->bindParam(':login', $login);
        $req->bindParam(':password', $this->hash($password));
        $req->bindParam(':date', $date);
        $req->bindParam(':type', $type);
        $req->bindParam(':useron', $useron);
        $req->execute();
        
        return true;
    }
    
//Modification du login
    public function modifLogin($newlogin, $id) {
        $req = $this->db->prepare("UPDATE users SET login=:newlogin WHERE id=:id");
        $req->bindParam('newlogin', $newlogin);
        $req->bindParam('id', $id);
        $req->execute();
        
        return true;
        
    }
    
    
//Modifier mot de passe
    public function modifPass($newpass, $id){
        $req = $this->db->prepare("UPDATE users SET password=:newpass WHERE id=:id");
        $req->bindParam('newpass', $this->hash($newpass));
        $req->bindParam('id', $id);
        $req->execute();
        
        return true;
    }
    
//Insertion d'avatar
    public function insertAvatar($avatar, $id) {
        $req = $this->db->prepare("UPDATE users SET avatar=:avatar WHERE id=:id");
        $req->bindParam('avatar', $avatar);
        $req->bindParam('id', $id);
        $req->execute();
        
        return true;
    }
    
//Recuperer l'avatar
    public function getAvatar($id) {
        $req = $this->db->query("SELECT avatar FROM users WHERE id='$id'");
        $data = $req->fetchColumn();
       
        return $data;
    }
    
//Protection par login
    public function log($login, $password){
        
        $req = $this->db->query("SELECT * FROM users WHERE login='$login' AND password='$password'");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetch();
        
        return new Login($data);     
    }
    
//Verifier le login
    public function verifIfExist($login){
        $req = $this->db->query("SELECT login FROM users WHERE login='$login'");
        $data = $req->rowCount();
       
        return $data;
    }
    
//Recuperer le mot de passe
    public function getPass($login){
        $req = $this->db->query("SELECT password FROM users WHERE login='$login'");
        $data = $req->fetchColumn();
       
        return $data;
    }
    
//Recuperer un utilisateur
    public function getUser($id) {
        $req = $this->db->query("SELECT * FROM users WHERE id='$id'");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetch();
       
        return new Login($data);
    }
    
//Recuperer l'auteur
    public function getAuthor($id){
        $req = $this->db->query("SELECT login FROM users WHERE id='$id'");
        $data = $req->fetchColumn();
        
        return $data;
    }
    
//Verifier si un utilisateur est déjà connecté
    public function verifIfConnect($id){
        $req = $this->db->query("SELECT useron FROM users WHERE id='$id'");
        $data = $req->fetchColumn();
        
        return $data;
    }
    
//Jeton qui gerer le status de connexion d'utilisateur
    public function updateTokken($id, $status){
        $req = $this->db->prepare("UPDATE users SET useron=? WHERE id=?");
       
        $req->execute(array($status,$id));
        
        return true;
    }

//Recuperer jetton
    public function nbTokken() {
        $req = $this->db->query("SELECT useron FROM users WHERE useron=1 ");
        $data = $req->rowCount();
       
        return $data;
    }
    
//Nombre d'utilisateurs
    public function nbTotalUsers() {
        $req = $this->db->query("SELECT id FROM users");
        $data = $req->rowCount();
       
        return $data;
    }
    
//Deconnexion
    public function deconnexion($date, $id){
        $req = $this->db->prepare("UPDATE users SET date_deconnexion=:date WHERE id=:id");
        $req->bindParam('date', $date);
        $req->bindParam('id', $id);
        $req->execute();
        
        session_destroy();
        
        return true;
        
    }
}
