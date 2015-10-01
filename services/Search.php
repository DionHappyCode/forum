<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Search
 *
 * @author Dionysos
 */
require_once('f:/wamp/www/blog/services/Message.php');

class Search {
    
    private $search_term,
            $condition;
    
    public function __construct($search_term) {
        
        $this->search_term = $search_term;
        
        $condition =  $this->searchCondition($search_term);
        
        $this->condition = $condition;

        return $condition;
                    
    }
    
    public function getCondition() {
        return $this->condition ;
    }
    
    //Fonction pour preciser la condition qui va completer la requête de la recherche
    private function searchCondition($search_term) {
        
        $search_exploded = explode ( " ", $this->search_term); 
        $x = 0; 
        $condition = ""; 

        foreach( $search_exploded as $search_each ) { 
            $x++;
               if( $x == 1 ){ 
                $condition .="titre LIKE '%$search_each%' OR contenu LIKE '%$search_each%'";
                 }
            else{ 
                $condition .=" OR titre LIKE '%$search_each%' OR contenu LIKE '%$search_each%'"; 
            }
        }
        return $condition;
    }
}
