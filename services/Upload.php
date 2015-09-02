<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 *
 * @author Stagiaire
 */
require_once('f:/wamp/www/blog/services/Message.php');

class Upload {
    
    private $files,
            $destination,
            $newname,
            $newthumb,
            $filext,
            $success = false,
            $extensions = array("img" => array('jpg','jpeg','gif','png'),
                                "doc" => array('pdf'),
                                "zip" => array('zip','rar','7z'));

    const MAXSIZE = 1024000;
    const IMAGEWIDTH = 70;
    
    public function __construct($files, $destination, $type) {
        
        $this->files = $files;
        $this->destination = $destination;
        
        $ext = $this->extensions[$type];
         
    //On verifie si le formulaire est remplit
        if(isset($this->files['fichier']['name']) && !empty($this->files['fichier']['name'])){
        //Verification du fichier
            if($this->verifichier($ext)){
            //On upload le fichier
                if($this->uploadFile($this->files['fichier']['tmp_name'], $this->destination.$this->newname)){

                    $this->createThumb($this->destination.$this->newname,  $this->destination.$this->newthumb ="min".$this->newname, self::IMAGEWIDTH);

                    unset($_FILES);
                    $this->success = true;
                }
                else{
                    $msg = new Message("error","Une erreur a survenu lors l'enregistement du fichier !");
                    header("Location: ../blog/users/membre.php");
                }
            }
            else{
                $msg = new Message("error","Verification a echoué !");
                header("Location: ../blog/users/membre.php");
            }          
        }
        else{
            $msg = new Message("error","Vous n'avez pas choisi un fichier");
            header("Location: ../blog/users/membre.php");
        }
    }
//Recuperer la valeur du success
    public function getSuccess(){
        return $this->success;
    }
//Recuperer le nouveau nom du fichier
    public function getNewthumb(){
        return $this->newthumb;
    }
//Recuperer l'extention du fichier    
    public function getFilext(){   
        return $this->filext;
        
    }
    
//Verification de toutes le condtions avant uploader le fichier
    private function verifichier($ext) {
        
    //On verifie si c'est le bon format
        if($this->extensionsValid($ext, $this->files['fichier']['name'])){
            //On donne un nom temporaire et on enleve les accents
                $this->remplacerAccents(strtolower($this->files['fichier']['tmp_name']));
            //On verifie si la taille di fichier depasse pas la taille maximume
                if($this->checkSize()){
                //on renome le fichier final
                    $this->newname = $this->remplacerAccents($this->renommerFichier($this->files['fichier']['name']));
                //On crée un dossier pour stocker le fichier
                    $this->createFolder($this->destination);
                    
                    return true;
                }
                else{
                    $msg = new Message("error","Fichier trop grand !");
                    header("Location: ../blog/users/membre.php");
                }
        }
        else{
            $msg = new Message("error","Le format du fichier n'est pas accepté !");
            header("Location: ../blog/users/membre.php");
        }
    }

//Verification d'extantion de fichier
    private function extensionsValid($extensions, $nomfichier) {
        
        $this->filext = strtolower(substr(strrchr($nomfichier, '.')  ,1) );
        
        if (in_array($this->filext, $extensions)){
            
            return TRUE;
        }
        else{
            return FALSE;
        }
    }
    
//Verification de la taille du fichier
    private function checkSize() {
        
        if ($this->files['fichier']['size'] < self::MAXSIZE) {
            return true;
        } 
        else {
            return false;
        }
    }
    
//Renomer le fichier
    private function renommerFichier($file) {
        
        $nom = uniqid(rand(), true).$file;
        
        return $nom;
    }
    
//Remplacer les accents
    private function remplacerAccents($file) {
        
        $pattern = Array("/é/", "/è/", "/ê/", "/ç/", "/à/", "/â/", "/î/", "/ï/", "/ù/", "/ô/");
        // notez bien les / avant et après les caractères
        $rep_pat = Array("e", "e", "e", "c", "a", "a", "i", "i", "u", "o");
        $motsansaccents = preg_replace($pattern, $rep_pat, $file);
        return $motsansaccents;
   
    }
    
//Creation du dossier
    private function createFolder($repertoire){
        
        if (!file_exists($repertoire)) {
            mkdir($repertoire, 0777, true);
        
            return TRUE;
        }
        else return false;
    }
    
    
//Creation d'un thumbnail
    public function createThumb($src, $dest, $desired_width) {
        
        if($this->getFilext() == "jpg"){
            $this->filext = "jpeg";
        }
        
        $source_image = call_user_func('imagecreatefrom'.$this->getFilext(),$src);
	$width = imagesx($source_image);
	$height = imagesy($source_image);
	
	/* find the "desired height" of this thumbnail, relative to the desired width  */
	$desired_height = floor($height * ($desired_width / $width));
	
	/* create a new, "virtual" image */
	$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
	/* copy source image at a resized size */
	imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
	/* create the physical thumbnail image to its destination */
	$thumb = imagepng($virtual_image, $dest);
        
        
    }
    
//Uploader le fichier
    private function uploadFile($file, $destination) {
        if(move_uploaded_file($file, $destination)){
            return true;
        }
        else return false;
    }  
}
