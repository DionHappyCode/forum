
<aside id="userinfos">
    <?php 
    
    $auteur = $ctrl->showAuteur($article->getAuteur());
    $avatar = $ctrl->showAvatar($article->getAuteur());
    
    if(!empty($auteur) && !empty($avatar)){
        echo '<img class="userimg" src="../uploads/user'.$article->getAuteur().'/avatar/'.$avatar.'" alt=""/>';
    }
    else{
        echo '<img class="userimg" src="../img/user.png" alt=""/>';
    }
    ?>
    <p> <?php echo $auteur; ?> </p>
    <p><?php 
        if(isset($_GET['id'])){
            echo 'le: '.date('d/m/y',  strtotime($article->getDateajout()));
        }
    ?> </p>
</aside>

