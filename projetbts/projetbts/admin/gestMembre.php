<?php 

require_once "header.php";

session_start();

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="../../includes/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
	<meta charset="utf-8" >
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<meta name="viewport" content="width=device-width, initial-scale: 1.0, user-scalabe=0" />

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="../../tinymce/js/tinymce/tinymce.min.js"></script>
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="js/general.js"></script>
<style type="text/css">
    	.sidebar {
    		min-height: 100%;
    	}

    	.labelInfo {
    		color:#627d94; 
    		font-weight:bold;
    	}

    	.infoDoc {
    		font-size: 1.3em;
    		display:inline-block; 
    		vertical-align:top;
    		margin-left: 2%;
    	}

    	.fa-5x {
    		font-size: 13em;
    		display: inline-block;
    	}

    	.sidebar a {
    		font-size: 1.2em;
    	}

    	.logo a {
    		font-size: 1.6em;
    	}

    @media screen and (max-width: 800px) {
	div#box-user .box-panel{
		overflow-x: auto;
		display: block;
	}
}

    </style>

</head>
<body>
	<div class="sidebar">
			<ul id="nav">
				<li><a href="index.php">Tableau de bord<div class="fa fa-tachometer fa-2x"></div></a></li>
				<li><a href="#">Modifier la file<span class="fa fa-pencil-square-o fa-2x"></span></a></li>
				<li><a href="#">Réservation<span class="fa fa-trash-o fa-2x"></span></a></li>
				<li><a href="#">Planning réunion<span class="fa fa-calendar fa-2x"></span></a></li>
				<li><a class="selected" href="gestMembre.php">Gérer les membres<span class="fa fa-users fa-2x"></span></a></li>
			</ul>
		</div>
		<div class="container" style="padding-left: 0px; margin-left: 0px; width: 100%;">
			<div class="content">
				<h1 style='margin-bottom:3%;'>Gérer les membres inscrits <span style='font-size:0.5em;'>(4 membres)</span></h1>
				<div class="row">
					<?php 
						$infoUser = $bdd->query("SELECT id_user, user_nom, user_prenom, user_mail, user_rang FROM user");

						while ($badge = $infoUser->fetch(PDO::FETCH_ASSOC)) 
						{
							$usr_id = $badge['id_user'];
							$usr_nom = $badge['user_nom'];
							$usr_prenom = $badge['user_prenom'];
							$usr_mail = $badge['user_mail'];
							$usr_rang = $badge['user_rang'];

							if ($usr_rang == 1) 
							{
								$usr_rang = "Admin";
							}
							else
							{
								$usr_rang = "Membre";
							}

							?>

							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="panel panel-primary">
									<div class="panel-heading" style='text-align:center;'><h4>Dr. <?php echo $usr_nom." ".$usr_prenom; ?></h4></div>
									<div class="panel-body">
											<?php 
												if ($usr_photo) 
												{
													echo "<img style='width:143px; height:182px; style:inline-block;' src=../../includes/photo-doc/".$usr_photo.">";
												}
												else
												{
													echo "<span class='fa fa-user-md fa-5x'></span>";
												}

											?>
											<div class="infoDoc">
												<div>
													<span class="labelInfo">Hopital concerné :</span> 
												<?php echo $usr_hop; ?>
												</div>
												<div>
													<span class="labelInfo">Libéral :</span> 
													<?php echo $usr_liber; ?>
												</div>
												<div style='margin-top:5%;'>
													<span class="labelInfo">Statut :</span> 
													<?php echo $usr_rang; ?>
												</div>
												<div>
													<span class="labelInfo">Mail :</span> 
													<?php echo $usr_mail; ?>
												</div>
												<div style='margin-top: 13%;'>
													<span class="labelInfo">Articles rédigés :</span> 
													<?php echo $usr_nbArt; ?>
												</div>
											</div>
									</div>
								</div>
							</div>

							<?php
						}
					?>
				</div>	
			</div>
		</div>
	</body>
</html>