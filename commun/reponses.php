<?php

foreach ($reponses as $reponse):

    
$auteur = $ctrl->showAuteur($reponse->getAuteur());
$avatar = $ctrl->showAvatar($reponse->getAuteur());

echo '<div class="reponse">'
    . '<aside id="userinfos">';
        if(!empty($auteur) && !empty($avatar)){
        echo '<img class="userimg" src="../uploads/user'.$reponse->getAuteur().'/avatar/'.$avatar.'" alt=""/>';
    }
    else{
        echo '<img class="userimg" src="../img/user.png" alt=""/>';
    }
        echo '<p>'.$auteur.' </p>'
                . '<p>le: '.date('d/m/y',  strtotime($reponse->getDateajout())).'</p>'
    . '</aside>'
    . '<div class="artinfos">'
           . '<h3 id='.$reponse->getId().'>'.$reponse->getTitre().'</h3>'
                .'<p class="reptexte">'.nl2br($reponse->getTexte()).'</p>';
                
                if(isset($_SESSION['id']) && $_SESSION["type"]=="administrateur" ) {
                    echo '<a href="update-reponse.php?reponseid='.$reponse->getId().'" class="rep">Modifer</a>'
                        .'<a href="../router.php?ctrl=Reponse&func=deleteReponse&id='.$reponse->getId().'" >Supprimer</a>';
                }
                elseif(isset($_SESSION['id']) && $reponse->getAuteur()==$_SESSION['id']){
                    echo '<a href="update-reponse.php?reponseid='.$reponse->getId().'" class="rep">Modifer</a>';
                }
           echo '</div>'
                . '</div>';                    
endforeach;
