<?php

// On enregistre notre autoload.
function chargerClasse($classname)
{
  require'modules/'.$classname.'.php';
}

spl_autoload_register('chargerClasse');
