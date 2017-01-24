<?php

require 'models/connexion.php';
    
if(isset($_POST['submit']))
	{
		$login = $_POST['login'];
		$mdp = ($_POST['mdp']);
		
		$requete = $bdd->query("SELECT * FROM user
		                        WHERE mdp ='".$mdp."' 
								AND identifiant ='".$login."'");
		if($reponse = $requete->fetch())
		{
			$_SESSION['connecte'] = true;
			$_SESSION['identifiant'] = $reponse['identifiant'];
			$_SESSION['mdp'] = $reponse['mdp'];
            header('location:formation');
			die();
		}
        else
            echo"Login ou Mot de Passe incorrect";
	}
?>