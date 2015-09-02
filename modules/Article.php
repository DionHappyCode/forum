<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Article
 *
 * @author Stagiaire
 */
class Article {
    
    //On defini les variables
    protected $id,
              $titre,
              $contenu,
              $auteur,
              $dateajout,
              $datemodif,
              $vues;
    
    //On crée le constructeur
    public function __construct(array $donnees) 
    {
            $this->hydrate($donnees);
    }

    //Fonction pour alimenter les données
    public function hydrate(array $donnees)
    {
            foreach ($donnees as $key => $value)
            {
                    $method = 'set'.ucfirst($key);

                    if (is_callable([$this, $method]))
                    {
                            $this->$method($value);
                    }				
            }
    }

    //Liste des getters
    public function getId(){ return $this->id; }
    public function getTitre(){ return $this->titre; }
    public function getContenu(){ return $this->contenu; }
    public function getAuteur(){ return $this->auteur; }
    public function getDateajout(){ return $this->dateajout; }
    public function getDatemodif(){ return $this->datemodif; }
    public function getVues(){ return $this->vues; }

    //Liste des setters
    public function setId($id){ $this->id = $id; }
    public function setTitre($titre){ $this->titre = $titre; }
    public function setContenu($contenu){ $this->contenu = $contenu; }
    public function setAuteur($auteur){ $this->auteur = $auteur; }
    public function setDateajout($dateajout){ $this->dateajout = $dateajout; }
    public function setDatemodif($datemodif){ $this->datemodif = $datemodif; }
    public function setVues($vues){ $this->vues = $vues; }
            
}
