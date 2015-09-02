<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Messages
 *
 * @author Stagiaire
 */
class Message {
   
    private $type;
    private $text;
    
    public function __construct($type,$text){
        $this->type = $type;
        $this->text = $text;
        
        $_SESSION['message'] = serialize($this); 
    }
    
    public function afficherMessage(){
        echo $this->text;
    }
    
    public function clear(){
        unset($_SESSION['message']);
    }
}