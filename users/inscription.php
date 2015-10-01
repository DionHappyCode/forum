<?php 
    include_once ('../core.php');
          
    //Eviter retourner sur la page de formulaire après le login    
    if(isset($_SESSION['login'])) header('Location:index.php');
    
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Inscription</title>
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
                           Inscription
                        </h3>
                    </div>
                </div>
                <form action="../router.php?ctrl=Login&AMP;func=inscrireMembre" method="POST" class="form text-center">
                    <p><label>
                            Votre login :
                        </label>
                        <input type="text" name="login" />
                    </p>
                    <p><label>
                            Votre mot de passe : 
                        </label>
                        <input type="password" name="password" />
                    </p>
                        <input type="hidden" name="date_inscr" /><br/>
                        <input type="hidden" name="type" /><br/>
                        <input type="hidden" name="useron" /><br/>
                    <p>
                        <input type="submit" name="envoyer" class="middle"/>
                        <input type="reset" name="annuler" value="Annuler"/>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
