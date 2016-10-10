<?php 

session_start()
    
//include "../includes/connect.php";

?>


<!DOCTYPE HTML>
<head>
	<title>ParkUrCar | Administration</title>
	<link rel="stylesheet" type="text/css" href="css/index.css" />
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scalabe=0" />
	<meta charset="utf-8">

	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/general.js"></script>

	<style type="text/css">
		ul#nav li a {
			font-size: 1em;
		}


	</style>

</head>
<body>

	<div id="header">
		<div class="logo">
			<a href="../index.php"><span>ParkUrCar |</a></span> <a href="index.php">Administration</a>
		</div>
	</div>

	<a href="#" class="mobile">MENU</a>

	<div id="container">
		<div class="sidebar">
			<ul id="nav">
				<li><a class="selected" href="index.php">Tableau de bord<div class="fa fa-tachometer fa-2x"></div></a></li>
				<li><a href="#">Modifier la file<span class="fa fa-pencil-square-o fa-2x"></span></a></li>
				<li><a href="#">Réservations<span class="fa fa-trash-o fa-2x"></span></a></li>
				<li><a href="#">Planning réunion<span class="fa fa-calendar fa-2x"></span></a></li>
				<li><a href="gestMembre.php">Gérer les membres<span class="fa fa-users fa-2x"></span></a></li>
			</ul>
		</div>

		<div class="content">
				<h1 style='color: #627d94;'>Tableau de bord</h1>
				<div id="box" class="box1">
					<div class="box-top">Nbr.<br>membres inscrits</div>
					<div class="box-panel">
						<span class="fa fa-user fa-user fa-5x"></span><h1>3</h1>
					</div>
				</div>
				<div id="box" class="box2">
					<div class="box-top">Taille<br>file d'attente</div>
					<div class="box-panel">
						<span class="fa fa-pencil-square-o fa-5x"></span><h1>4</h1>
					</div>
				</div>
				<div id="box" class="box3">
					<div class="box-top">Site en ligne<br>depuis</div>
					<div class="box-panel">
						<span class="fa fa-globe fa-5x"></span><h1>6 mois</h1>
					</div>
				</div>
				<div id="box" class="box4">
					<div class="box-top">Nbr.<br>visiteurs en ligne</div>
					<div class="box-panel">
						<span class="fa fa-laptop fa-5x"></span><h1>4</h1>
					</div>
				</div>
				<div id="box" class="box5">
					<div class="box-top">Nbr. documents<br>téléchargés</div>
					<div class="box-panel">
						<span class="fa fa-download fa-5x"></span><h1>25</h1>
					</div>
				</div>

				<div id="box" class="box6">
					<div class="box-top">Nbr.<br>Total visites</div>
					<div class="box-panel">
						<span class="fa fa-line-chart fa-5x"></span><h1>876</h1>
					</div>
				</div>
            
				<div id="box-user" class="box7">
					<div class="box-top" style="background-color: #627d94;"><span class="fa fa-users fa-2x" style="margin-right: 3px; width: 50px;"></span>Table des 10 derniers membres inscrits<span style="margin-left: 5%; font-size: 0.8em; color: #cccccc;">4 membres</span></div>
					<div class="box-panel">
						 <table>
						  <tr>
						    <td>Identifiant</td>
						    <td>Nom</td>
						    <td>Prénom</td>
						    <td>E-mail</td>
						    <td>Rang</td>
						  </tr>

						  <?php 

						  // table user

						  $userSql = $bdd->query("SELECT id_user, user_nom, user_prenom, user_mail, user_rang FROM user ORDER BY id_user DESC LIMIT 10");

						  while ($users = $userSql->fetch(PDO::FETCH_ASSOC)) 
						  {
						  	$userId = $users['id_user'];
						  	$userName = $users['user_nom'];
						  	$userFirstName = $users['user_prenom'];
						  	$userMail = $users['user_mail'];
						  	$userRang = $users['user_rang'];

						  	?>
							  <tr>
							  	<td><?php echo "USR".$userId; ?></td>
							  	<td><?php echo $userName; ?></td>
							  	<td><?php echo $userFirstName; ?></td>
							  	<td><?php echo $userMail; ?></td>
							  	<?php 

							  	if ($userRang == 1) 
							  	{
							  		echo "<td>Administrateur</td>";
							  	}
							  	else
							  	{
							  		echo "<td>Membres</td>";
							  	}

							  	?>
							  </tr>

						  	<?php
						  }

						  $userSql->closeCursor();

						  ?>
						</table>
					</div>
				</div>

				<div id="box-user" class="box7">
					<div class="box-top" style="background-color: #627d94;"><span class="fa fa-envelope fa-2x" style="margin-right: 3px; width: 50px;"></span>10 dernières demandes de réservation<span style="margin-left: 5%; font-size: 0.8em; color: #cccccc;">15 demandes</span></div>
					<div class="box-panel">
						
					</div>
				</div>
		</div>
	</div>

</body>
</html>