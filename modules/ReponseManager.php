<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReponseManager
 *
 * @author Stagiaire
 */
require 'f:/wamp/www/blog/modules/Reponse.php';
require 'f:/wamp/www/blog/services/connection-bdd.php';

class ReponseManager {
    
    private $db; // Instance de PDO
    
    //Connexion bdd
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    public function getAllReponses($idsujet){
        $req = $this->db->query("SELECT * FROM reponses WHERE id_sujet='$idsujet' ORDER BY date_ajout_reponse DESC");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $liste = $req->fetchAll();
        $data = array();
        
        foreach($liste as $reponseToCreate){
            array_push($data, new Reponse($reponseToCreate));
        }
                
        return $data;// data est une collection d'objets
    }
    
    public function getReponsesbyAuteur($id){
        $req = $this->db->query("SELECT * FROM reponses WHERE auteur_reponse='$id'");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $liste = $req->fetchAll();
        $data = array();
        
        foreach($liste as $reponseToCreate){
            array_push($data, new Reponse($reponseToCreate));
        }
                
        return $data;// data est une collection d'objets
    }
    
    public function getOne($id){
        $req = $this->db->query("SELECT * FROM reponses WHERE id_reponse='$id'");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetch();
 
        return new Reponse($data);        
    }
    
    public function numberReponses($id){
        $req = $this->db->query("SELECT * FROM reponses WHERE id_sujet='$id'");
        $data = $req->rowCount();
        
        return $data;
    }
    
    public function numberReponsesbyUser($iduser){
        $req = $this->db->query("SELECT * FROM reponses WHERE auteur_reponse='$iduser'");
        $data = $req->rowCount();
        
        return $data;
    }
    
    public function checkNewReponses($id) {
        $req = $this->db->query("SELECT reponses.id_reponse "
                . "FROM reponses, news, users "
                . "WHERE lu_reponse=0 "
                . "AND reponses.id_sujet = news.id "
                . "AND news.auteur = users.id "
                . "AND users.id = '$id'");
        
        $data = $req->rowCount();
        
        return $data; 
    }
        
    public function updateVuereponse($idart) {
        $req = $this->db->prepare("UPDATE reponses SET lu_reponse = 1 WHERE id_sujet = :idart");
        $req->bindParam(':idart', $idart);
        $req->execute();
        
        return true;
    }
    
    public function ajouterReponse($titre, $reponse, $dateajout, $auteur, $idsujet){
        $req = $this->db->prepare("INSERT INTO reponses(titre_reponse, texte_reponse, date_ajout_reponse, auteur_reponse, id_sujet) "
                                . "VALUES(:titre, :reponse, :dateajout, :auteur, :idsujet)");
        $req->bindParam(':titre', $titre);
        $req->bindParam(':reponse', $reponse);
        $req->bindParam(':dateajout', $dateajout);
        $req->bindParam(':auteur', $auteur);
        $req->bindParam(':idsujet', $idsujet);
        $req->execute();
        
        return true;
    }
    
    public function modifierReponse($titre, $reponse, $datemodif, $auteur, $idsujet, $idreponse){
        $req = $this->db->prepare("UPDATE reponses SET titre_reponse = :titre, texte_reponse = :reponse, date_modif_reponse = :datemodif, auteur_reponse = :auteur, id_sujet = :idsujet "
                . "WHERE id_reponse = :idreponse");
        $req->bindParam(':titre', $titre);
        $req->bindParam(':reponse', $reponse);
        $req->bindParam(':datemodif', $datemodif);
        $req->bindParam(':auteur', $auteur);
        $req->bindParam(':idsujet', $idsujet);
        $req->bindParam(':idreponse', $idreponse);
        $req->execute();
        
        return true;
    }
    
    public function supprimerReponse($id){
        $req = $this->db->prepare("DELETE FROM reponses WHERE id_reponse='$id'");
        
        $req->execute();
        
        return true;
    }
}
