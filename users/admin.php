<?php 
    include_once ('../core.php');
    include_once '../services/Upload.php';
    
    $ctrl = new LoginController();
    
    include_once ('../services/keepAlive.php');

    $artctrl = new ArticleController();
    
    $repctrl = new ReponseController();
    
    $artreps = $artctrl->recupArticleByNewReponse($_SESSION['id']);
    
    if(isset($_GET['m'])){
          
        $decon = $ctrl->dec(date("Y-m-d H:i:s"), $_SESSION['id']);
       
       header('Location: index.php');
    }
    if($_SESSION['type'] != "administrateur"){
        header("Location: index.php");
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
        <title>Admin</title>
        <?php include_once '../commun/head.php'; ?>
    </head>
    <body>
        <div class="wrapper">
            <?php include ("../commun/menu.php");?>
            <?php include_once '../commun/header.php'; ?>
            
            <div class="container col-lg-7">
                <h4 class="soutitre">
                    <span class="glyphicon glyphicon-list"></span> Voici vos articles <span class="badge"><?php echo $artctrl->nbArticles($_SESSION['id']); ?></span> :   
                </h4>
                 <?php
                  
                   $articles = $artctrl->recupArticlesbyUser($_SESSION['id']);
                    foreach ($articles as $article):
                        $avatar = $ctrl->showAvatar($article->getAuteur());
                            echo '<div class="article">'
                                   . '<h3 class="topic">'.$article->getTitre().'</h3>'.
                                        '<p class="date">le: '.date('d/m/y',  strtotime($article->getDateajout())).'<br/>'
                                        .'<p>'.myTruncate(nl2br($article->getContenu()), 60).'</p>'
                                        . '<a href="article.php?id='.$article->getId().'">Lire la suite</a>'
                                        .'<p>Reponses : '.$reponse = $repctrl->nbReponses($article->getId()).'</p>'
                                   . '</div>';
                                        
                    endforeach;
                ?>
            </div>
            <aside id="admin" class="col-lg-5">
                 <div class="article">
                     
                     <?php 

                        if(!empty($avatar)){
                                echo '<img class="userimg" src="../uploads/user'.$_SESSION['id'].'/avatar/'.$avatar.'" alt=""/>';
                            }
                            else{
                                echo '<img class="userimg" src="../img/user.png" alt=""/>';
                            }
                            
                            ?>

                     <h3 class="profil">
                        Votre profil :
                    </h3>
                     <h5 class="profil">
                        
                        Membre depuis :  <?php 
                            $user = $ctrl->showUser($_SESSION["id"]);
                            echo date('d/m/y',  strtotime($user->getDate()));
                         ?>
                    </h5>
                     <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default"><a id="avatar" href="">Changer avatar</a></button>
                        <button type="button" class="btn btn-default"><a id="modipass" href="">Modifier mot de passe</a></button>
                        <button type="button" class="btn btn-default"><a id="modilog" href="">Modifier login</a></button>
                      </div>
                     <!-- formulaire de insertion d'avatar-->
                     <div class="imgform">
                         <form action="../router.php?ctrl=Login&amp;func=uploadAvatar" method="post" enctype="multipart/form-data" class="form">
                            <input type="file" name="fichier" />
                            <input type="submit" name="submit" value="Changer" />
                            <input type="reset" name="annuler" id="annul" value="Annuler"/>
                        </form>
                     </div>
                    
                     <!-- formulaire de modification de mot de passe-->
                     <div class="repform">
                         <form action="../router.php?ctrl=Login&AMP;func=modifierPassword" method="POST" class="form">
                            <p><label> Votre mot de passe actuel : </label>
                                <input type="password" name="password" />
                            </p>
                            <p><label>
                                    Votre nouveau mot de passe : 
                                </label>
                                <input type="password" name="newpass" />
                            </p>
                            <p><label>
                                    Confirmer votre nouveau mot de passe : 
                                </label>
                                <input type="password" name="confpass" />
                            </p>
                            <p>
                                <input type="submit" name="envoyer" value="Valider"/>
                                <input type="reset" name="annuler" id="annuler" value="Annuler"/>
                            </p>
                        </form>   
                    </div>
                     <!-- /formulaire de modification de mot de passe-->
                     
                     <!-- formulaire de modification du login-->
                     <div class="modlog">
                         <form action="../router.php?ctrl=Login&AMP;func=modifierLogin" method="POST" class="form">
                            <p><label> Votre login actuel : </label>
                                <input type="text" name="login" />
                            </p>
                            <p><label>
                                    Votre nouveau login : 
                                </label>
                                <input type="text" name="newlogin" />
                            </p>
                            <p><label>
                                    Confirmer votre nouveau login : 
                                </label>
                                <input type="text" name="conflogin" />
                            </p>
                            <p>
                                <input type="submit" name="envoyer" value="Valider"/>
                                <input type="reset" name="annuler" id="cancel" value="Annuler"/>
                            </p>
                        </form>   
                    </div>
                     <!-- /formulaire de modification du login-->
                </div>
                <div class="article">
                    <h3>
                        Votre statistiques :
                    </h3>
                    <h4>
                         Vous avez publié <?php echo $artctrl->nbArticles($_SESSION['id']); ?> articles : 
                    </h4>
                    <ol>
                        
                            <?php
                               $articles = $artctrl->recupArticlesbyUser($_SESSION['id']);
                                foreach ($articles as $article):
                                        echo '<li><a href="article.php?id='.$article->getId().'">'.$article->getTitre().'</a></li>'
                                            ;                    
                                    endforeach;
                            ?>
                         
                    </ol> 
                    <h4>
                        Vous avez publié <?php echo $repctrl->nbReponsesbyUser($_SESSION['id']); ?> reponses :
                    </h4>
                    <ol>
                        
                            <?php
                               $reponses = $repctrl->recupReponsesbyAuteur($_SESSION['id']);
                                foreach ($reponses as $reponse):
                                        echo '<li>'.$reponse->getTitre().'</li>'
                                            ;                    
                                    endforeach;
                            ?>
                         
                    </ol>    
                </div>
                <div class="article">
                    <h3>
                        Statistiques du forum :
                    </h3>
                    <h4>
                        Il y a <span class="rep"><?php echo $artctrl->getNbArticles(); ?> articles</span> publiés.
                    </h4>
                    <h4>
                        Il y a <span class="rep"><?php echo $ctrl->getNbUsers(); ?> membres</span> enregistrés.
                    </h4>
                    <h4>
                        Il y a <span class="rep"><?php echo $ctrl->getNbUsersOnline(); ?> membres</span> en ligne.
                    </h4>
                </div>
            </aside>
            
            <footer>
               <?php include_once '../commun/footer.php'; ?>
                
            </footer>
        </div> 
    </body>
</html>
