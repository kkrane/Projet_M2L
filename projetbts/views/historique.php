<?php
 if (isset($_SESSION['connecte'])){
?>
<?php
require_once 'models/historique.php';
?>
<link rel="stylesheet" href="css/style.css">
	<body id="top">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-offset-3 col-md-10"> <!-- container du titre -->
    				<h1>Historique de vos formations</h1>
    				</div>
                </div>
            </div>
                   <div class="container titre">
                    <div class="row">
    				<div id="th_historique">
                    
			        <div class="col-md-offset-2">
                        <table cellpadding="10px" cellspacing="0" border="0" width="60%"; >

                            <tr id="tablatest">
                                <th style="text-align : center;" id="titreform" onclick="#">INTITULE FORMATION</th>
                                <th style="text-align : center;" id="titredate" onclick="#">DATE DEBUT</th>
                                <th style="text-align : center;" id="titredate" onclick="#">CREDIT</th>
                            <tr>
                        
                    </div>
                       
			        </div>
                    </div>
                    </div>
                   
                   <div class="container titre">
                   <div class="row"> 
                   <div id="tableau_historique">
    				<?php
                        $req = getHistorique();
    				    while($donnee = $req->fetch())
                        {
                    ?>
                        <div class="col-md-offset-2">
                         
                         <td style="text-align : center;" scope="col" name="titre" id="titre"><?php echo $donnee['titre'];?></td>
                         <td style="text-align : center;" scope="col" name="titre" id="titre"><?php echo $donnee['date_debut'];?></td>
                         <td style="text-align : center;" scope="col" name="titre" id="titre"><?php echo $donnee['cout'];?></td>
                         </table>
                       </div>
                    </div>
                    <?php
                        }
    				?>
    			
    		</div>
        </div>
    </body>

<?php }
 ?>