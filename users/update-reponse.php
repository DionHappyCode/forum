<?php include_once ('../core.php'); 

    $ctrl = new LoginController();

    include_once ('../services/keepAlive.php');
    
    if(isset($_GET['m'])){
          
        $decon = $ctrl->dec(date("Y-m-d H:i:s"), $_SESSION['id']);
       
       header('Location: index.php');
    }
    
    $repctrl = new ReponseController();
    
    $reponse = $repctrl->recupUn($_GET['reponseid']);
    
    $_SESSION['reponseid'] = $_GET['reponseid'];
    
    
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Modifier Reponse</title>
        <?php include_once '../commun/head.php'; ?>
    </head>
    <body>
        <div class="wrapper">
            <?php include ("../commun/menu.php");?>
            <?php include_once '../commun/header.php'; ?>   
            <div class="main">
                
                <form method="post" action="../router.php?ctrl=Reponse&func=updateReponse" class="form">
                    <fieldset>
                        <legend>Modifier le reponse : </br><strong><?php echo $reponse->getTitre(); ?></strong></legend>
                        <p><label>Titre</label><input type="text" name="titre_reponse" size="50" value="<?php echo $reponse->getTitre(); ?>"/></p>
                        <p><label>Description</label><textarea name="texte_reponse" cols="50"><?php echo $reponse->getTexte(); ?></textarea></p>
                        <input type="hidden" name="datemodif_reponse" /><br/>
                        <input type="hidden" name="auteur_reponse" /><br/>
                        <input type="hidden" name="id_sujet" /><br/>
                        <input type="submit" name="submit" value="Inserer" />
                        <button><a href="article.php?id=<?php echo $_SESSION['articleid'] ; ?>">Annuler</a></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
