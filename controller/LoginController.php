<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Stagiaire
 */
require_once('f:/wamp/www/blog/services/Message.php');
require_once('f:/wamp/www/blog/services/Upload.php');

class LoginController {
    
    private $manager;
    
    public function __construct(){
        require_once('f:/wamp/www/blog/modules/LoginManager.php');
        $this->manager = new LoginManager($db); 
    }
    
//Inscription membre
    public function inscrireMembre($data) {
        
        //Recuperation de données
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);
        $date = strip_tags(date("Y-m-d H:i:s"));
        $type = "membre";
        $useron = "0";
        
        //Verification de champs de formulaire
        if(isset($login) && !empty($login) && isset($password) && !empty($password)){
            
            //Verifier si le login existe dans la base de données
            $trouveruser = $this->manager->verifIfExist($login);
            
            //Si il n'existe pas l'inscription sera effectuée 
            if(!$trouveruser){
                $this->manager->inscrMembre($login, $password, $date, $type, $useron);
                
                $msg = new Message("success","Votre inscription a été bien effectué ! Veuillez vous vous connecter !");
                header("Location: ../blog/users/connexion.php");
            }
            //Si le login existe, message d'erreur
            else{
                $msg = new Message("error","Identifiants sont déjà utilisés !");
                header("Location: ../blog/users/inscription.php");
            }
        }
        //Si les champs du formulaire ne sont pas rempli correctement, message d'erreur
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header("Location: ../blog/users/inscription.php");
        }
    }
    
//Connexion d'utilisateur
    public function LogIn($data){
        
        //Recuperation de données
        $login = strip_tags($_POST['login']);
        $password = strip_tags($_POST['password']);
        
        //Verification de champs de formulaire
        if(isset($login) && !empty($login) && isset($password) && !empty($password)){
            
            //Recuperation du mot de passe dans la base de données
            $pass = $this->manager->getPass($login);
                            
            //Verification du mot de passe  
            if(password_verify($password, $pass)){
                //Si le mot de passe est correct, connexion
                $identifiant = $this->manager->log($login, $pass);
                
                $_SESSION['id'] = $identifiant->getId();
                $_SESSION['login'] = $identifiant->getLogin();
                $_SESSION['type'] = $identifiant->getType();

                $useronline = $this->manager->updateTokken($_SESSION['id'], 1);

                $msg = new Message("succes","Vous êtes connecté(e) !");
                header("Location: ../blog/users/index.php");
              }
              //Si le mot de passe n'est pas correct, message d'erreur
              else {
                  $msg = new Message("error","Identifiants non trouvés !");
                  header("Location: ../blog/users/connexion.php");
              }     
        }
        //Si les champs du formulaire ne sont pas rempli correctement, message d'erreur
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header("Location: ../blog/users/connexion.php");
        }
    }

//Modifier login
    public function modifierLogin($newlogin, $id) {
        //Recuperation de données
        $login = strip_tags($_POST['login']);
        $newlogin = strip_tags($_POST['newlogin']);
        $conflogin = strip_tags($_POST['conflogin']);
        $id = $_SESSION["id"];
        $login = $_SESSION["login"];
        
        //Recuperation du login actuel
        $log = $this->manager->getAuthor($id);
        
         //Verification de champs de formulaire
        if(isset($login) && !empty($login) && isset($newlogin) && !empty($newlogin) && isset($conflogin) && !empty($conflogin)){
            //Verification d'ancien login
            if($log == $login){
                //Verification de nouveau login
                if($newlogin == $conflogin){
                    //Modification du login
                    if($this->manager->modifLogin($newlogin, $id)){
                        
                        $_SESSION['login'] = $newlogin;
                        //Si la modification a été effectué on affiche un message 
                        $msg = new Message("success","Le login a été modifier avec success !");
                        header("Location: ../blog/users/admin.php");
                    }
                    else{
                        $msg = new Message("error","Un problème est survenu lors la modification du login !");
                        header("Location: ../blog/users/admin.php");
                    }
                }
                else {
                    $msg = new Message("info","Les deux login sont pas pareil !");
                    header("Location: ../blog/users/admin.php");
                }
            }
             else{
                $msg = new Message("info","Verifier votre login actuel  !");
                header("Location: ../blog/users/admin.php");
            }
        }
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header("Location: ../blog/users/admin.php");
        }
    }
    
//Modifier mot de passe
    public function modifierPassword($password, $id) {
        
        //Recuperation de données
        $password = strip_tags($_POST['password']);
        $newpass = strip_tags($_POST['newpass']);
        $confpass = strip_tags($_POST['confpass']);
        $id = $_SESSION["id"];
        $login = $_SESSION["login"];
        
        //Recuperation du mot de passe dans la base de données
        $pass = $this->manager->getPass($login);
        //Verification de champs de formulaire
        if(isset($password) && !empty($password) && isset($newpass) && !empty($newpass) && isset($confpass) && !empty($confpass)){
            //Verification d'ancien mot de passe  
            if(password_verify($password, $pass)){
                //Si c'est bon, verification de nouveau mot de passe 
                if($newpass == $confpass){
                    //Si c'est bon, modification du mot de passe 
                    if($this->manager->modifPass($newpass, $id)){
                        $msg = new Message("success","Le mot de passe a été modifier avec success !");
                        header("Location: ../blog/users/membre.php");
                    }
                    else{
                        $msg = new Message("error","Un problème est survenu lors la modification du mot de passe !");
                        header("Location: ../blog/users/membre.php");
                    }
                }
                else {
                    $msg = new Message("info","Les deux mots de passe sont pas pareil !");
                    header("Location: ../blog/users/membre.php");
                }
            }
            else{
                $msg = new Message("info","Verifier votre mot de passe actuel  !");
                header("Location: ../blog/users/membre.php");
            }
        }
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header("Location: ../blog/users/membre.php");
        }
    }
    
//Insertion d'avatar
    public function uploadAvatar($avatar, $id){
        
        if(isset($_FILES) && !empty($_FILES)){
            
            $files = glob('../blog/uploads/user'.$_SESSION['id'].'/avatar/*'); // get all file names
                foreach($files as $file){ // iterate files
                  if(is_file($file))
                    unlink($file); // delete file
                }
                    
            $up = new Upload($_FILES, '../blog/uploads/user'.$_SESSION['id'].'/avatar/', 'img');
            
            if($up->getsuccess()){
                
                if($this->manager->insertAvatar($up->getNewthumb(), $_SESSION['id'])){
                    $msg = new Message("success","Vous avez changé votre avatar avec success !");
                    if($_SESSION['type']=="membre"){
                        header("Location: ../blog/users/membre.php");
                    }
                    if($_SESSION['type']=="administrateur"){
                        header("Location: ../blog/users/admin.php");
                    }
                }
                else{
                    $msg = new Message("error","Un problème a survenu lors l'insertion du fichier à la base de données !");
                    header("Location: ../blog/users/membre.php");
                }
            }
        }
    }
    
//Afficher l'avatar
    public function showAvatar($id) {
        $avatar = $this->manager->getAvatar($id);
        
        return $avatar;
    }
//Afficher le nom de l'auteur
    public function showAuteur($id) {
        $nom = $this->manager->getAuthor($id);
        
        return $nom;
    }
//Afficher nom du user
    public function showUser($id) {
        $user = $this->manager->getUser($id);
       
        return $user;
    }
//Verification si l'utilisateur est connecté
    public function userConnexion($id){
        
        $user = $this->manager->verifIfConnect($id);
        
        return $user;
    }

//Nombre d'utilisateurs
    public function getNbUsers() {
        $nbtotalusers = $this->manager->nbTotalUsers();
        
        return $nbtotalusers;
    }
//Nobre d'utilisateurs online
    public function getNbUsersOnline() {
        $nbusersonlnine = $this->manager->nbTokken();
        
        return $nbusersonlnine;
        
    }
//Deconnexion
    public function dec($date, $id) {
        
        $useroffline = $this->manager->updateTokken($_SESSION['id'], 0); 
        
        $deconnexion = $this->manager->deconnexion($date, $id);
        
        return $deconnexion;
    } 
}
