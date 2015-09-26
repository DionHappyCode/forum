<?php include_once ('../core.php'); 
    
    $ctrl = new LoginController();
    
    $repctrl = new ReponseController();
    
    include_once ('../services/keepAlive.php');
    if(isset($_GET['m'])){
          
        $decon = $ctrl->dec(date("Y-m-d H:i:s"), $_SESSION['id']);
       
       header('Location: index.php');
    }
?>
<!DOCTYPE html">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Nouvel Article</title>
        <?php include_once '../commun/head.php'; ?>
    </head>
    <body>
         <div class="wrapper">
             <?php include ("../commun/menu.php");?>
             <?php include_once '../commun/header.php'; ?> 
            
            <div class="main">    
               
                <form method="post" action="../router.php?ctrl=Article&func=newArticle" class="form">
                    <fieldset>
                        <legend>Ajoutez un nouvel article</legend>
                        <p><label>Titre de l'article</label><input type="text" name="titre" size="70"/></p>
                        <p><label>Description de l'article</label><textarea name="contenu" cols="90" rows="10"></textarea></p>
                        <input type="hidden" name="auteur" /><br/>
                        <input type="hidden" name="dateajout" /><br/>
                        <input type="submit" name="submit" value="Inserer" />
                        <input type="reset" name="annuler" id="annuler" value="Annuler"/> 
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
