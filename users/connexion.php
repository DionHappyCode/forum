<?php 
    include_once ('../core.php');
        
    $ctrl = new LoginController();
    
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
        <title>Se Connecter</title>
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
                           Connexion
                        </h3>
                    </div>
                </div>
                <form action="../router.php?ctrl=Login&AMP;func=LogIn" method="POST" class="form text-center">
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
                    <p>
                        <input type="submit" name="envoyer" value="Valider" class="middle"/>
                        <input type="reset" name="annuler" value="Annuler"/>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
