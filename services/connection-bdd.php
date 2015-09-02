<?php
try
{
	global $db;
        $db = new PDO('mysql:host=localhost;dbname=news', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>