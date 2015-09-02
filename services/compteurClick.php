<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of compteurClick
 *      Quand l'utilisateur clique sur un poste, l'application prend en compte que un clic pour chaque poste, 
 *      sauf si c'est lui l'author du poste, donc l'application ne prend pas en compte son clic.
 * @author Dionysos
 */

if(isset($_SESSION['id']) && $_SESSION['id']== $article->getAuteur()){//On verifie si l'utilidateur est l'auteur du poste
    $_SESSION['clique'][] = $_GET['id'];//Et on crée la session où on stock les id du poste où il a cliqué
}
elseif(isset($_SESSION['id']) && $_SESSION['id']!= $article->getAuteur()){// On verifie si l'utilisateur est connecté et si il n'est pas l'auteur du post
        if(!isset($_SESSION['clique'])){// On verifie si il n'a pas déjà cliqué sur un poste
            $vuesarticle = $artctrl->updateVue($_GET['id']);//On modifie les nombre de vues 
        $_SESSION['clique'][] = $_GET['id'];//Et on crée la session où on stock les id du poste où il a cliqué
        }
        elseif(isset($_SESSION['clique']) && !in_array($_GET['id'], $_SESSION['clique'])) {// On verifie si l'utilisateur a déjà cliqué sur le poste
           $vuesarticle = $artctrl->updateVue($_GET['id']);//On modifie les nombre de vues 
        $_SESSION['clique'][] = $_GET['id'];//Et on crée la session où on stock les id du poste où il a cliqué
        }
}
elseif(!isset($_SESSION['clique'])){// Si l'utilisateur n'est pas connecté et il n'a pas encore cliqué sur un poste
    $vuesarticle = $artctrl->updateVue($_GET['id']);//On modifie les nombre de vues 
    $_SESSION['clique'][] = $_GET['id'];//Et on crée la session où on stock les id du poste où il a cliqué
    }
elseif(isset($_SESSION['clique']) && !in_array($_GET['id'], $_SESSION['clique'])) {//Si l'utilisateur clique sur un autre poste
    $vuesarticle = $artctrl->updateVue($_GET['id']);//On modifie les nombre de vues 
    $_SESSION['clique'][] = $_GET['id'];//Et on crée la session où on stock les id du poste où il a cliqué
}

