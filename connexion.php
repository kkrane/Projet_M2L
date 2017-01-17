<?php 

function getConnexion()
{
	try
	{
		$bdd= new PDO('mysql:host=localhost;dbname=intranet;charset=utf8','root','');
	}
	catch(Exception $e)
	{
		die("Erreur de connexion");
	}

    return $bdd;
};
?>