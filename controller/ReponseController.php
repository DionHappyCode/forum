<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReponseController
 *
 * @author Stagiaire
 */
require_once('f:/wamp/www/blog/services/Message.php');

class ReponseController {
    
    private $manager;
        
    public function __construct(){
        require_once('f:/wamp/www/blog/modules/ReponseManager.php');
        $this->manager = new ReponseManager($db);        
    }
    
    public function recupReponses($idsujet){
        $reponses = $this->manager->getAllReponses($idsujet);
                
        return $reponses;
    }
    
    public function recupReponsesbyAuteur($id){
        $reponses = $this->manager->getReponsesbyAuteur($id);
                
        return $reponses;
    }
    
    public function recupUn($id){
        $reponse = $this->manager->getOne($id);
        
        return $reponse;
    }
    
    public function nbReponses($id){
        $nb = $this->manager->numberReponses($id);
        
        return $nb;
    }
    
    public function nbReponsesbyUser($iduser){
        $nb = $this->manager->numberReponsesbyUser($iduser);
        
        return $nb;
    }
    
    public function getNbReponses($id){
        $nbrep = $this->manager->checkNewReponses($id);
        
        return $nbrep;
    }
    
    public function modifierVuereponse($idart) {
        $this->manager->updateVuereponse($idart);
        
        return true;
    }
    
    public function newReponse($data){
       
        $titre = strip_tags($data['titre_reponse']);
        $reponse = strip_tags($data['texte_reponse']);
        $dateajout = strip_tags(date("Y-m-d H:i:s")); 
        $auteur = strip_tags($_SESSION['id']);
        $idsujet = strip_tags($_SESSION['articleid']);
        
        if(isset($titre) && !empty($titre) && isset($reponse) && !empty($reponse)){
            if($this->manager->ajouterReponse($titre, $reponse, $dateajout, $auteur, $idsujet)){
                $msg = new Message("success","La nouvelle reponse a été enregistré avec succès !");
                header('Location: ../blog/users/article.php?id='.$_SESSION['articleid']);
            
            }            
            else{
                $msg = new Message("error","Un problème est survenu lors de l'enregistrement de la reponse !");
            }            
        }
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header('Location: ../blog/users/article.php?id='.$_SESSION['articleid']);
        } 
    }
    
    public function updateReponse($data){
        
        $titre = strip_tags($data['titre_reponse']);
        $reponse = strip_tags($data['texte_reponse']);
        $datemodif = strip_tags(date("Y-m-d H:i:s")); 
        $auteur = strip_tags($_SESSION['id']);
        $idsujet = strip_tags($_SESSION['articleid']);
        $idreponse = strip_tags($_SESSION['reponseid']);
        
        if(isset($titre) && !empty($titre) && isset($reponse) && !empty($reponse)){
            if($this->manager->modifierReponse($titre, $reponse, $datemodif, $auteur, $idsujet, $idreponse)){
                $msg = new Message("success","La reponse a été modifié avec succès !");
                header('Location: ../blog/users/article.php?id='.$_SESSION['articleid']);
            }            
            else{
                $msg = new Message("error","Un problème est survenu lors de la modification de la reponse !");
            }            
        }
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header('Location: ../blog/users/reponse.php?articleid='.$_SESSION['id_article']);
        } 
    }
    
    public function deleteReponse($data){
        
        $id = strip_tags($data['id']);
        
        if ($this->manager->supprimerReponse($id)) {
            $msg = new Message("succes", "La reponse a été supprimé !");
            header('Location: ../blog/users/article.php?id='.$_SESSION['articleid']);
        } 
        else {
            $msg = new Message("error", "Une erreur a apparu lors la suppression de la reponse");
        }
    }
}
