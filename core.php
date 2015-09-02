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

//Ouverture des sessions
session_start();

dfdsfsgf