
    <?php
    require_once('f:/wamp/www/blog/services/Message.php');
    
    if(isset($_SESSION["message"])){
        
    ?>
       <div id="backmess" onclick="style.display='none';">
           <div id="vueMessage">
               <a href="#" onclick="document.getElementById('backmess').style.display='none';return false;" id="close_popup">X</a>
    <?php          
        $msg = unserialize($_SESSION['message']);
        $msg->afficherMessage();
        $msg->clear();
    ?>
           </div>
       </div>
    <?php
    }
    ?>
