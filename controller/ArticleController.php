<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArticleController
 *
 * @author Stagiaire
 */
require_once('f:/wamp/www/blog/services/Message.php');

class ArticleController {
    
    private $manager;
        
    public function __construct(){
        require_once('f:/wamp/www/blog/modules/ArticleManager.php');
        $this->manager = new ArticleManager($db);        
    }
//Afficher tous les articles
    public function recupAllArticles(){
        $articles = $this->manager->getAll();
          
        return $articles;
    }
//Afficher le nombre total des articles
    public function getNbArticles() {
        $nbtotalarticles = $this->manager->nbTotalArticles();
        
        return $nbtotalarticles;
    }
//Afficher les articles d'un utilisateur    
    public function recupArticlesbyUser($iduser){
        $articles = $this->manager->getAllbyUser($iduser);
          
        return $articles;
    }
//Afficher un article        
    public function recupUn($id){
        $article = $this->manager->getOne($id);
        
        return $article;
    }
//Afficher le nombre d'articles d'un utilisateur    
    public function nbArticles($iduser){
        $nb = $this->manager->countArticleByUser($iduser);
        
        return $nb;
    }
    
    public function recupArticleByNewReponse($iduser) {
        $articles = $this->manager->getArticleByNewReponse($iduser);
        
        return $articles;
    }
    
//Creation d'un nouvel article    
    public function newArticle($data) {
        
        $titre = strip_tags($data['titre']);
        $contenu = strip_tags($data['contenu']);
        $auteur = strip_tags($_SESSION['id']);
        $dateajout = strip_tags(date("Y-m-d H:i:s")); 
            
        if(isset($titre) && !empty($titre) && isset($contenu) && !empty($contenu)){
            if($this->manager->ajouterArticle($titre, $contenu, $auteur, $dateajout)){
                $msg = new Message("success","Le nouvel article a été enregistré avec succès !");
                header('Location: ../blog/users/admin.php');
            
            }
             else{
                $msg = new Message("error","Un problème est survenu lors de l'enregistrement de l'article !");
            }
        }
        else{
            $msg = new Message("info","Tous les champs sont requis !");
            header('Location: ../blog/users/new-article.php');
        } 
    }
//Suppression d'un article
    public function deleteArticle($data){
        
        $id = strip_tags($data['id']);
        
        if ($this->manager->supprimerArticle($id)) {
            $msg = new Message("succes", "L'article a été supprimé !");
            
            header('Location: ../blog/users/admin.php');
        } 
        else {
            $msg = new Message("error", "Une erreur a apparu lors la suppression de l'article");
        }
    }
    
// Modifier les vues de chaque article
    public function updateVue($id) {
        $vues = $this->manager->modifierVue($id);
        
        return $vues;
        
    }

}
    

