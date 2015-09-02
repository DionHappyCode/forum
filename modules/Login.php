<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author Stagiaire
 */
class Login {
    
    //On defini les variables
    protected $id,
              $login,
              $password,
              $date_inscr,
              $date_deconnexion,
              $type,
              $avatar,
              $useron;
    //On crée le constructeur
    public function __construct(array $donnees){
            $this->hydrate($donnees);
            
    }

    //Fonction pour alimenter les données
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value)
            {
                    $method = 'set'.ucfirst($key);

                    if (is_callable([$this, $method]))
                    {
                            $this->$method($value);
                    }				
            }
    }
    
    //Liste de getters
    public function getId(){return $this->id;}
    public function getLogin(){return $this->login;}
    public function getPassword(){return $this->password;}
    public function getDate(){return $this->date_inscr;}
    public function getDeconnexion(){return $this->date_deconnexion;}
    public function getType(){return $this->type;}
    public function getAvatar(){return $this->avatar;}
    public function getUseron(){return $this->useron;}
        
    //Liste de setters
    public function setId($id){$this->id = $id;}
    public function setLogin($login){$this->login = $login;}
    public function setPassword($password){$this->password = $password;}
    public function setDate_inscr($date_inscr){$this->date_inscr = $date_inscr;}
    public function setDate_deconnexion($date_deconnexion){$this->date_deconnexion = $date_deconnexion;}
    public function setType($type){$this->type = $type;}
    public function setAvatar($avatar){$this->avatar = $avatar;}
    public function setUseron($useron){$this->useron = $useron;}
      
}
