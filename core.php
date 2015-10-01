<?php

// On enregistre notre autoload.
function chargerClasse($classname)
{
    if(strpos($classname, 'Controller') !=false){
    require 'controller/'.$classname.'.php';
    }
    elseif(strpos($classname, 'Manager') !=false){
        require 'modules/'.$classname.'.php';   
    }
}

spl_autoload_register('chargerClasse');

//Couper le texte
function myTruncate($string, $limit, $break=" ", $pad="...")
{
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}

//Filtrer les injections dans la base de données
function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }

//Ouverture des sessions
session_start();

