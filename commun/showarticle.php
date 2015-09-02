<?php

include '../commun/userinfo.php';

 echo '<div class="artinfos">'
        . '<h3 class="topic">'.$article->getTitre().'</h3>',
            '<p>'.nl2br($article->getContenu()).'</p>'
         . '<p><span class="st_facebook"></span>
            <span class="st_googleplus"></span>
            <span class="st_twitter"></span>
            <span class="st_email"></span>
            <span class="st_sharethis"></span></p>';

          if(isset($_SESSION['id'])){
           echo '<p class="rep"><a id="reponseform" href="">Reponse</a></p>';

           if(isset($_SESSION['id']) && $_SESSION['type']=="administrateur"){
              echo '<a href="../router.php?ctrl=Article&func=deleteArticle&id='.$article->getId().'">Supprimer</a>';
          }
        }
          else{
              echo '<p class="rep">Veuillez vous connecter pour donner une reponse</p>';
          }
    echo "</div>";                         

