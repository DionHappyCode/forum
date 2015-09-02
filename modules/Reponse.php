<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reponse
 *
 * @author Stagiaire
 */
class Reponse {
    //On defini les variables
    protected $id_reponse,
              $titre_reponse,
              $texte_reponse,
              $date_ajout_reponse,
              $date_modif_reponse,
              $auteur_reponse,
              $id_sujet,
              $lu_reponse;
    
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
    public function getId(){ return $this->id_reponse; }
    public function getTitre(){ return $this->titre_reponse; }
    public function getTexte(){ return $this->texte_reponse; }
    public function getDateajout(){ return $this->date_ajout_reponse; }
    public function getDatemodif(){ return $this->date_ajout_reponse; }
    public function getAuteur(){ return $this->auteur_reponse; }
    public function getIdsujet(){ return $this->id_sujet; }
    public function getLureponse(){ return $this->lu_reponse; }

    //Liste des setters
    
    public function setId_reponse($id_reponse){ $this->id_reponse = $id_reponse; }
    public function setTitre_reponse($titre_reponse){ $this->titre_reponse = $titre_reponse; }
    public function setTexte_reponse($texte_reponse){ $this->texte_reponse = $texte_reponse; }
    public function setDate_ajout_reponse($date_ajout_reponse){ $this->date_ajout_reponse = $date_ajout_reponse; }
    public function setDate_modif_reponse($date_modif_reponse){ $this->date_modif_reponse = $date_modif_reponse; }
    public function setAuteur_reponse($auteur_reponse){ $this->auteur_reponse = $auteur_reponse; }
    public function setId_sujet($id_sujet){ $this->id_sujet = $id_sujet; }
    public function setLu_reponse($lu_reponse){ $this->lu_reponse = $lu_reponse; }
}
