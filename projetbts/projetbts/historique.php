<?php

require_once 'models/connexion.php';

?>


<?php



function getHistorique()
{
$bdd = getConnexion();
$sql = "SELECT * FROM formation";
$req = $bdd->query($sql);

 if(!$req)
	 {
		echo 'Requête déféctueuse';
	 }

return $req;
};

?>