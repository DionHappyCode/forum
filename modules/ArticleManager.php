<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of articlesManager
 *
 * @author Stagiaire
 */
require 'f:/wamp/www/blog/modules/Article.php';
require 'f:/wamp/www/blog/services/connection-bdd.php';

class ArticleManager {
    
    private $db; // Instance de PDO
    
//Connexion bdd
    public function __construct($db)
    {
        $this->db = $db;
    }
    
//Affichage tous les articles
    public function getAll(){
        
        $req = $this->db->query("SELECT * FROM news ORDER BY dateajout DESC");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $liste = $req->fetchAll();
        $data = array();
        
        foreach($liste as $articleToCreate){
            array_push($data, new Article($articleToCreate));
        }
        
        return $data;// data est une collection d'objets
    }
//Nombre total des articles
    public function nbTotalArticles() {
        $req = $this->db->query("SELECT COUNT(id) FROM news");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetchColumn();
          
        return $data;
    }
//Affichage tous les articles d'un utilisateur
    public function getAllbyUser($iduser){
        
        $req = $this->db->query("SELECT * FROM news WHERE auteur='$iduser' ORDER BY dateajout DESC");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $liste = $req->fetchAll();
        $data = array();
        
        foreach($liste as $articleToCreate){
            array_push($data, new Article($articleToCreate));
        }
        
        return $data;// data est une collection d'objets
    }
     
//Affichage d'un article
    public function getOne($id){
        $req = $this->db->query("SELECT * FROM news WHERE id='$id'");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetch();
                
        return new Article($data);    
    }

//Nombre d'article par utilisateur
    public function countArticleByUser($iduser){
        $req = $this->db->query("SELECT COUNT(id) FROM news WHERE auteur='$iduser'");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetchColumn();
          
        return $data;
    }

    public function getArticleByNewReponse($iduser) {
        $req = $this->db->query("SELECT DISTINCT news.id, news.titre "
                . "FROM reponses, news, users "
                . "WHERE lu_reponse=0 "
                . "AND reponses.id_sujet = news.id "
                . "AND news.auteur = users.id "
                . "AND users.id = '$iduser'");
        
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $liste = $req->fetchAll();
        $data = array();
        
        foreach($liste as $articleToCreate){
            array_push($data, new Article($articleToCreate));
        }
        
        return $data;// data est une collection d'objets
    }
    
//Insertion d'un article
    public function ajouterArticle($titre, $contenu, $auteur, $dateajout){
        $req = $this->db->prepare("INSERT INTO news(titre, contenu, auteur, dateajout) VALUES(:titre, :contenu, :auteur, :dateajout)");
        $req->bindParam(':titre', $titre);
        $req->bindParam(':contenu', $contenu);
        $req->bindParam(':auteur', $auteur);
        $req->bindParam(':dateajout', $dateajout);
        $req->execute();
        
        return true;
    }
//Suppression d'un article    
    public function supprimerArticle($id){
        $req = $this->db->prepare("DELETE FROM news WHERE id='$id'");
        
        $req->execute();
        
        return true;
    }

//Enregistrer les vues de chaque article
    public function modifierVue($id) {
        $req = $this->db->prepare("UPDATE news SET vues = vues+1 WHERE id = :id");
        $req->bindParam(':id', $id);
        $req->execute();
        
        return true;
    }

//Fonction de retour le nombre de resultat de recherche
    public function nbSearchResults($condition){
        $req = $this->db->query("SELECT COUNT(id) FROM news WHERE $condition");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        $data = $req->fetchColumn();
          
        return $data;
    }
//Requête pour la fonction de recherche
    public function searchTerm($condition){
        $req = $this->db->query("SELECT * FROM news WHERE $condition");
        $req->setFetchMode(PDO::FETCH_ASSOC);
        
        $liste = $req->fetchAll();
        $data = array();
        
        foreach($liste as $articleToCreate){
            array_push($data, new Article($articleToCreate));
        }
        
        return $data;// data est une collection d'objets
    }
}