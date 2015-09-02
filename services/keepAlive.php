<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of keepAlive
 *
 * @author Stagiaire
 */
if(isset($_SESSION['id'])){

    $user = $ctrl->userConnexion($_SESSION['id']);
        if($user == 1){ 

            return true; 

        }
        else{ 
            $decon = $ctrl->dec();
       
            header('Location: ../users/index.php');
        }
    }

elseif(!isset($_SESSION['id'])){header('Location: ../users/index.php');}


