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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/style.css" />
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" />
    </head>
    <body>
        <div class="wrapper">
            <h1 class="titre">My Forum</h1>
            <?php include ("vueMessage.php");?>
            <div class="connexion">
                <?php include ("vueMessage.php");?>
                <h2>Inscription</h2>
                <form action="../router.php?ctrl=Login&AMP;func=inscrireMembre" method="POST" class="form">
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
                        <input type="submit" name="envoyer" />
                        <button><a href="index.php">Annuler</a></button>
                    </p>
                </form>
            </div>
        </div>
    </body>
</html>
