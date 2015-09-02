<?php 
    include_once ('../core.php');
    
    $ctrl = new LoginController();
    
    $artctrl = new ArticleController();
    
    $repctrl = new ReponseController();
    
    if(isset($_SESSION['id'])){
        
        $artreps = $artctrl->recupArticleByNewReponse($_SESSION['id']);
        
        include_once ('../services/keepAlive.php');

        if(isset($_GET['m'])){

            $decon = $ctrl->dec(date("Y-m-d H:i:s"), $_SESSION['id']);

           header('Location: index.php');
        }
    }  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>My Forum</title>
       <?php include_once '../commun/head.php'; ?>
    </head>
    <body>
        <div class="wrapper">
            <?php include ("../commun/menu.php"); ?>
            
            <?php include_once '../commun/header.php'; ?>
            <div class="main">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="soutitre text-center">
                           <span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> Tous les topics : 
                        </h3>
                    </div>
                </div>
                
                 <?php

                   $articles = $artctrl->recupAllArticles();
                    foreach ($articles as $article):
                        
                 ?>
                    <div class="article">
                        
                        <?php include '../commun/userinfo.php'; ?>
                        
                        <div class="artinfos">
                            <h3 class="topic"><a href="article.php?id=<?php echo $article->getId(); ?>"><?php echo $article->getTitre(); ?></a></h3>
                            <p class="date">le: <?php echo date('d/m/y',  strtotime($article->getDateajout())); ?></p>
                            <p>Reponses : <?php echo $reponse = $repctrl->nbReponses($article->getId()); ?></p>
                        </div>
                        
                        <?php include '../commun/vuesinfo.php'; ?>
                    </div>                    
                <?php
                    endforeach;
                ?>
            </div>
            
        </div>
        <footer>
               <?php include_once '../commun/footer.php'; ?>
                
            </footer>
    </body>
</html>
