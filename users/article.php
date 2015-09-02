<?php  
    include_once ('../core.php');
    
    $ctrl = new LoginController();
    
    $artctrl = new ArticleController();
    
    if(isset($_SESSION['id'])){
        
        $artreps = $artctrl->recupArticleByNewReponse($_SESSION['id']);
        
        include_once ('../services/keepAlive.php');
    
        if(isset($_GET['m'])){

            $decon = $ctrl->dec(date("Y-m-d H:i:s"), $_SESSION['id']);

           header('Location: index.php');
        }
    }
    
    $article = $artctrl->recupUn($_GET['id']);
    
    $_SESSION['articleid'] = $_GET['id'];
    
    $repctrl = new ReponseController();
    
    $reponses = $repctrl->recupReponses($_GET['id']);
    
    if(isset($_SESSION['id']) && $_SESSION['id']==$article->getAuteur()){
        $reponsestatus = $repctrl->modifierVuereponse($_GET['id']);
    }
    
    
    //Compteur de vues
    
    include_once ('../services/compteurClick.php');
    
        
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title><?php echo $article->getTitre(); ?></title>
       <?php include_once '../commun/head.php'; ?>
    </head>
    <body>
        <div class="wrapper">
            <?php include ("../commun/menu.php");?>
            <?php include_once '../commun/header.php'; ?>
            <div class="main">
                <!-- Affichage d'un article-->
                <div class="article">
                    
                        <?php include_once '../commun/showarticle.php'; ?>
                    <?php include '../commun/vuesinfo.php'; ?>
                    
                <!-- formulaire de reponse-->
                    <div class="repform">
                        <form method="post" action="../router.php?ctrl=Reponse&amp;func=newReponse" class="form">  
                            <p>Ajoutez une reponse à l'article : </br><strong><?php echo $article->getTitre(); ?></strong></p>
                            <p>
                                <label>Titre</label>
                                <input id="titre_reponse" type="text" name="titre_reponse" size="50"/>
                            </p>
                            <p>
                                <label>Description</label>
                                <textarea id="texte_reponse" name="texte_reponse" cols="60" rows="10"></textarea>
                            </p>
                                <input type="hidden" name="dateajout_reponse" /><br/>
                                <input type="hidden" name="auteur_reponse" /><br/>
                                <input type="hidden" name="id_sujet" /><br/>
                                <input type="submit" name="submit" value="Inserer" />
                                <input type="reset" name="annuler" id="annuler" value="Annuler"/>                              
                        </form>
                    </div>
                <!-- Affichage des reponses-->
                    <?php include_once '../commun/reponses.php'; ?>
                
                </div>
                </div>
            </div>
      
        <footer>
               <?php include_once '../commun/footer.php'; ?>
                
            </footer>
        <script type="text/javascript">
            $(function(){
                $('#reponseform').click (function(e){
                    e.preventDefault();
                    $('.repform').slideDown( "500" );
                    
                });
            });
        </script>
        <script type="text/javascript">
            $(function(){
                $('#annuler').click (function(e){
                    e.preventDefault();
                    $('.repform').slideUp( "500" );
                    
                });
            });
        </script>
       
    </body>
</html>
