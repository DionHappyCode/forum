
<!--Navigation menu-->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">MyForum</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="index.php"><span class="glyphicon glyphicon-home"></span> Page d'accueil</a></li>
        <li class="<?php if(isset($_SESSION['id'])){ echo 'hide'; }?>"><a href="connexion.php">Se Connecter</a></li><!--Afficher si l'utilisateur n'est pas connecté--->
        <li class="<?php if(isset($_SESSION['id'])){ echo 'hide'; }?>"><a href="inscription.php">S'inscrire</a></li><!--Afficher si l'utilisateur n'est pas connecté--->
    <!--Afficher si l'utilisateur est connecté-->
        <?php if(isset($_SESSION['id'])){ ?>
            <li><a href="new-article.php"><span class="glyphicon glyphicon-pencil"></span> Nouvel Article</a></li>
            <li><a href="?m=deconnexion"><span class="glyphicon glyphicon-off"></span> Deconnexion</a></li>
        <?php } ?>
      </ul>
        <p class="navbar-text navbar-right">
                        
            <?php 
                if(isset($_SESSION['id'])){
                //  Afficher si il n'y a pas des nouvelles reponses
                   if($repctrl->getNbReponses($_SESSION['id'])==0){ 
            ?>
            <span class="glyphicon glyphicon-inbox" data-toggle="tooltip" data-placement="bottom" title="Pas des nouvelles reponses"></span>
            <?php
                }
                else{
                    //Si il y a des nouvelles reponses
                    ?>

                    <a data-container="body" data-toggle="popover" title="Cliquez sur l'article pour voir les reponses" data-placement="bottom" 
                            data-content="<ol><?php foreach ($artreps as $artrep){ ?>
                            <li><a href='article.php?id=<?php echo $artrep->getId(); ?>'><?php echo $artrep->getTitre(); ?></a></li><?php }?></ol>">
                            <span class="glyphicon glyphicon-inbox" data-toggle="tooltip" data-placement="bottom" 
                            title="Vous avez <?php echo $repctrl->getNbReponses($_SESSION['id']); ?> nouvelles reponses">
                            <span class="badge-notify"><?php echo $repctrl->getNbReponses($_SESSION['id']); ?></span>
                            </span>
                         </a>
                    
                <?php
                
                            }//Fin else
            //Afficher l'avatar
                $avatar = $ctrl->showAvatar($_SESSION['id']);
                if(!empty($avatar)){
                        echo '<img class="usermenu" src="../uploads/user'.$_SESSION['id'].'/avatar/'.$avatar.'" alt=""/>';
                    }
                    else{
                        echo '<img class="usermenu" src="../img/user.png" alt=""/>';
                    }      
                 ?>
            
              <!--Afficher le nom d'utilisateur et le lien vers son profil-->
            Bienvenu(e) <a href="<?php 
                    if($_SESSION["type"]=="membre"){//Afficher si l'utilisateur est un membre
                        echo 'membre.php'; 
                    }
                    elseif($_SESSION["type"]=="administrateur"){//Afficher si l'utilisateur est un administrateur
                        echo 'admin.php'; 
                    }
                    ?>" class="navbar-link"><?php echo $ctrl->showAuteur($_SESSION['id']); ?></a>
            <?php } ?>  
        </p>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Chercher">
        </div>
        <button type="submit" class="btn btn-default">Valider</button>
      </form>
        
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    $('[data-toggle="popover"]').popover({html:true});
});
</script>