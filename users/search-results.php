<?php include_once ('../core.php');
    include_once '../services/Upload.php';
    include_once '../services/Search.php';
    
    $ctrl = new LoginController();
    
    include_once ('../services/keepAlive.php');

    $artctrl = new ArticleController();
    
    $repctrl = new ReponseController();
    
    $artreps = $artctrl->recupArticleByNewReponse($_SESSION['id']);
    
    if(isset($_GET['m'])){
          
        $decon = $ctrl->dec(date("Y-m-d H:i:s"), $_SESSION['id']);
       
       header('Location: index.php');
    }
?>
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
                <?php
                    //Recuparation de nombre de resultat
                    $nbsearch = $artctrl->getNbSearch($_GET['search']);
                    //Recuparation des articles
                    $search_results = $artctrl->getSearchResults($_GET['search']);
                    
                //Si il y a de resultat 
                    if($nbsearch !=0){
                        ?>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="soutitre text-center">
                                    <!--On affiche combien resultat on a trouvé-->
                                    <span class="label label-default"><?php echo $nbsearch; ?></span> Resultats trouvés : 
                                </h3>
                            </div>
                        </div>
                <?php
                    foreach ($search_results as $search_result){
                ?>
                <!-- On affiche les articles-->
                <div class="article">
                    <div class="artinfos">
                        <h3 class="topic"><a href="article.php?id=<?php echo $search_result->getId(); ?>"><?php echo $search_result->getTitre(); ?></a></h3>
                        <p class="date">le: <?php echo date('d/m/y',  strtotime($search_result->getDateajout())); ?></p>
                        <p>Reponses : <?php echo $reponse = $repctrl->nbReponses($search_result->getId()); ?></p>
                    </div> 
                </div>
                <?php
                        }//Fin de foreach
                    }
                    else{//Si il n'y a pas de resultat, on affiche un message
                        ?>
                    
                       <div class="panel panel-default">
                    <div class="panel-body">
                        <h3 class="soutitre text-center">
                            Il n'y a pas de resultats pour votre recherche <span class="label label-default"><?php echo $_GET['search']; ?></span>
                        </h3>
                    </div>
                </div>
                    <?php
                    }  
                ?>
                </div>
            </div>
        </div>
        <footer>
               <?php include_once '../commun/footer.php'; ?>
                
            </footer>
    </body>
</html>
