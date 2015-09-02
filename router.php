<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once ('core.php');

$controller = $_GET['ctrl']."Controller";

$ctrl = new $controller();

if(isset($_POST['submit'])){

    $ctrl->$_GET['func']($_POST); 

}
elseif (isset($_GET)){ 

    $ctrl->$_GET['func']($_GET);
}