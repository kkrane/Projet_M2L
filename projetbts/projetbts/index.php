<?php 

session_start();

include "includes/connect.php";
include "includes/function.php";

if(isset($_GET['sess']))
{
    $erreur = "Vous devez vous identifier pour accéder à cette page";
}

if (!empty($_POST['inscription']))
{
    if (!empty($_POST['inscr_nom'])) 
    {
        $nom = trim($_POST['inscr_nom']);
        if (preg_match('`^[- A-Za-zàâäéèêëïîôöùûü\']{2,}$`i', $nom)) 
        {
            $nom = Rec($nom);
        }
        else
        {
            $erreur = "Votre nom ne peut contenir de caractères spéciaux";
        }
    }
    else
    {
        $erreur = "Veuillez renseigner votre nom de famille";
    }

    if (!empty($_POST['inscr_prenom'])) 
    {
        $prenom = trim($_POST['inscr_prenom']);
        if (preg_match('`^[- A-Za-zàâäéèêëïîôöùûü\']{2,}$`i', $prenom)) 
        {
            $prenom = Rec($prenom);
        }
        else
        {
            $erreur = "Votre prenom ne peut contenir de caractères spéciaux";
        }
    }
    else
    {
        $erreur = "Veuillez renseigner votre prénom";
    }

    if (!empty($_POST['inscr_mail'])) 
    {
        $mail = $_POST['inscr_mail'];
        $mail = Rec($mail);
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) 
        {
            $erreur = "Votre adersse mail n'est pas valide";
        }
    }
    else
    {
        $erreur = "Veuillez indiquer votre adresse mail";
    }

    if (!empty($_POST['inscr_login'])) 
    {
        $inscr_login = $_POST['inscr_login'];
        $inscr_login = htmlspecialchars($inscr_login);
        $inscr_login = Rec($inscr_login);
        
        $existSql = $bdd->prepare("SELECT user_login FROM user WHERE user_mdp = ?");
        $existSql->execute(array(sha1($inscr_login)));
        
        if(empty($existSql))
        {
            $erreur = "Quelqu'un utilise déjà cet identifiant";
        }
        
        
    }
    else
    {
        $erreur = "Veuillez renseigner votre identifiant";
    }
    
    if(!empty($_POST['inscr_mdp']))
    {
        $inscr_mdp = htmlspecialchars($_POST['inscr_mdp']);
        $inscr_mdp = Rec($inscr_mdp);
    }
    else
    {
        $erreur = "Veuillez choisir votre mot de passe";
    }
}

elseif(!empty($_POST['connexion']))
{
    if(!empty($_POST['co_login']) && !empty($_POST['co_mdp']))
    {
        $auth = false;
        $co_login = htmlspecialchars($_POST['co_login']);
        $co_login = Rec($co_login);
        $co_mdp = htmlspecialchars($_POST['co_mdp']);
        $co_mdp = Rec($co_mdp);
        
        $sql = $bdd->query("SELECT user_login, user_mdp FROM user");

	   while ($data = $sql->fetch(PDO::FETCH_ASSOC)) 
	   {
		  if ($co_login == $data['user_login'] AND sha1($co_mdp) == $data["user_mdp"]) 
		  {
             echo "coucouBBB";
			 $auth = true;
			 $_SESSION['user_login'] = $co_login;
			 $_SESSION['user_mdp'] = $co_mdp;
		  }
	   }
       
        if(!$auth)
        {
            $erreurCo = "identifiants incorrects";
        }
    }
    else
    {
        $erreurCo = "Veuillez renseigner vos identifiants.";
    }
    
    if($auth && !isset($erreurCo))
    {
        $adminOrNot = $bdd->prepare("SELECT user_rang from user where user_login = ? AND user_mdp = ?");
        
        $adminOrNot->execute(array($_SESSION['user_login'], sha1($_SESSION['user_mdp'])));
        
        while($row = $adminOrNot->fetch(PDO::FETCH_ASSOC))
        {
            $rang = $row['user_rang'];            
        }
        
        if($rang == 1)
        {
            header("location:admin/index.php");
        }
        else
        {
            header("location:connecte.php");
        }
        
        $sql->closeCursor();
        $adminOrNot->closeCursor();
    }
    
    
}

if(!empty($_POST['inscription']) && !isset($erreur))
{
    $_SESSION['user_login'] = $inscr_login;
    $_SESSION['user_mdp'] = $inscr_mdp;

    $attenteMax = $bdd->query("SELECT MAX(attente_rang) AS PLACE FROM attente");
    
    while($attente = $attenteMax->fetch(PDO::FETCH_ASSOC))
    {
        $laMax = $attente['PLACE'];
    }
    
    $placeUser = $laMax + 1;
    
    $inscriSql = $bdd->prepare("INSERT INTO user VALUES('',?,?,?,?,?,?)");
    
    $inscriSql->execute(array($_SESSION['user_login'],sha1($_SESSION['user_mdp']), $nom, $prenom, $mail, 0));
    
    $idUser = $bdd->prepare("SELECT id_user FROM user where user_login = ? AND user_mdp = ?");
    
    $idUser->execute(array($_SESSION['user_login'],sha1($_SESSION['user_mdp'])));
                     
    if($users = $idUser->fetch(PDO::FETCH_ASSOC))
    {
        $user_id = $users['id_user'];
    }
    else
        echo "erreur dans la requete sql";
    
    $attentePlace = $bdd->prepare("INSERT INTO attente VALUES(?, ?)");
    
    $attentePlace->execute(array($placeUser, $user_id));
    
    
    header("location:connecte.php");
}
else
{

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Park your car</title>
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/templatemo-style.css">
		<script src="js/jquery.js"></script>
        <script src="includes/function.js"></script>
		<script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.singlePageNav.min.js"></script>
		<script src="js/typed.js"></script>
		<script src="js/wow.min.js"></script>
		<script src="js/custom.js"></script>
	</head>
	<body id="top">

		<!-- start preloader -->
		<div class="preloader">
			<div class="sk-spinner sk-spinner-wave">
     	 		<div class="sk-rect1"></div>
       			<div class="sk-rect2"></div>
       			<div class="sk-rect3"></div>
      	 		<div class="sk-rect4"></div>
      			<div class="sk-rect5"></div>
     		</div>
    	</div>
    	<!-- end preloader -->

        <!-- start header -->
        
            <nav class="navbar navbar-default templatemo-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                        <span class="icon icon-bar"></span>
                    </button>
                    <a href="#" class="navbar-brand"> <img src="images/logo.png" class="img-responsive" style="width: 50px; height=50px";> </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#top">ACCUEIL</a></li>
                        <li><a href="#about">AIDE</a></li>
                        <li><a href="#team">INSCIPTION/CONNEXION</a></li>
                        <li><a href="#contact">CONTACT</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
            if(isset($erreurCo))
            {
                ?>
                <div class="alert alert-danger" style='margin-bottom:0px;'>
                    <strong>Attention! </strong> <?php echo $erreurCo." Veuillez essayer de vous reconnecter"; ?>
                </div>
        <?php
            }
        ?>
        
        <!-- end header -->

    	<!-- start home -->
    	<section id="home">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-offset-2 col-md-8">
    					<h1 class="wow fadeIn" data-wow-offset="50" data-wow-delay="0.9s"><FONT color="#585858">Une place sécurisée pour</FONT><span> vous</span></h1>
                        <FONT color="#6E6E6E">
    					<div class="element">
                            <div class="sub-element">Marre de chercher une place ?</div>
                            <div class="sub-element">ParUrCar vous permet de réserver votre place de parking !</div>
                            <div class="sub-element">Sécurisé, fiable et à moindre prix</div>
                        </div></FONT>
    					<div class="col-md-offset-4 col-sm-offset-5 col-xs-offset-4"><a data-scroll href="#about" class="btn btn-default wow fadeInUp" data-wow-offset="50" data-wow-delay="0.6s">Lancez-vous</a></div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end home -->

    	<!-- start about -->
		<section id="about">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">BESOIN D'<span>AIDE</span></h2>
    				</div>
                    <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.6s">
                        <div class="media">
                            <div class="media-heading-wrapper">
                                <div class="media-object pull-left">
                                    <i class="fa fa-mobile"></i>
                                </div>
                                <h3 class="media-heading">A quoi sert ce site?</h3>
                            </div>
                            <div class="media-body">
                                <p>Ce site permet la réservation en ligne de place de parking pour la société <a rel="nofollow" href="http://www.google.com" target="_parent">Parkcar</a>. Il s'agit d'un gestionnaire auquel vous pouvez avoir accès afin de gérer ou de demander une place de parking.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-offset="50" data-wow-delay="0.9s">
						<div class="media">
							<div class="media-heading-wrapper">
								<div class="media-object pull-left">
									<i class="fa fa-car"></i>
								</div>
								<h3 class="media-heading">Comment gérer sa place?</h3>
							</div>
							<div class="media-body">
								<p>En accord avec <a rel="nofollow" href="http://www.google.com">Parkcar</a> vous pourrez avoir accès à votre place de parking et savoir combien de temps cette place vous est attribuée. Pour cela, veuillez vous connecter avec vos identifiants ci dessous.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
						<div class="media">
							<div class="media-heading-wrapper">
								<div class="media-object pull-left">
									<i class="fa fa-html5"></i>
								</div>
								<h3 class="media-heading">Comment avoir un compte?</h3>
							</div>
							<div class="media-body">
								<p>Afin d'obtenir un compte sur <a rel="nofollow" href="http://www.google.com">Park your car</a> veuillez vous inscrire ci dessous. Nos admins analyserons votre demande avant de vous autorisez l'accès à votre nouveau compte.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end about -->

    	<!-- start team -->
    	<section id="team">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-13">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>INSCRIPTION</span> / CONNEXION</h2>
    				</div>
                    <div class="col-md-2 col-sm-0 col-xs-0 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
                    </div>
                    <a href="#nogo" style='color:#fff;' class="view-detail" data-toggle="modal" data-target="#inscription">
    				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
                        <div class="team-wrapper">
                            <img src="images/in.jpg" class="img-responsive" alt="team img 1" style="width: 100%; min-width : 100%;">
                                <div class="team-des">
                                    <h4>S'inscrire</h4>
                                    <span>En tant qu'utilisateur</span>
                                    <p>Avec cette inscription, vous pourrez avoir accès à votre place dans la liste d'attente pour le parking, mais aussi à la date d'expiration de cette dernière.</p>
                                </div>
                        </div>
                    </div></a>
                     <div id="inscription" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style='border-radius: 16px 17px 15px 20px;'>
                          <div class="modal-header" style="background-color:#28a7e9; border-color:#202020; border-radius: 15px 15px 0px 0px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">INSCRIPTION | NOUS REJOINDRE</h4>
                          </div>
                          <div class="modal-body" style='background-color: #202020; border-radius: 0px 0px 10px 15px;'>
                            <div id='alertErr' class="alert alert-danger fade in" style='display:none;'>

                                <strong>Attention! </strong> <span id="errMsg"><?php if(isset($erreur)){echo $erreur;} ?></span>

                            </div>
                            <form action="index.php" method='post'>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="nom">Nom</label>
                                <input type="text" name="inscr_nom" onblur="verifName(this)" class="form-control" id="nom" placeholder="Nom">
                              </div>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="prenom">Prénom</label>
                                <input type="text" name="inscr_prenom" onblur="verifFirstName(this)" class="form-control" id="prenom" placeholder="Prénom">
                              </div>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="mail">Mail</label>
                                <input type="email" name="inscr_mail" onblur="verifMail(this)" class="form-control" id="mail" placeholder="Mail">
                              </div>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="login">Identifiant</label>
                                <input type="text" name="inscr_login" onblur="verifLogin(this)" class="form-control" id="login" placeholder="Identifiant">
                              </div> 
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" name="inscr_mdp" onblur="verifMdp()" class="form-control" id="mdp" placeholder="Mot de passe">
                              </div>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="mdp">Vérification mot de passe</label>
                                <input type="password" name="inscr_mdp2" onblur="verifMdp()" class="form-control" id="mdp2" placeholder="Mot de passe">
                              </div>
                              <input name="inscription" type="submit" value="S'inscrire" class="btn btn-default col-md-offset-5" style='background-color: #28a7e9; border-color: #28a7e9; color:#303030; font-weight:bold;'>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div> 

                     <a href="#nogo" style='color:#fff;' class="view-detail" data-toggle="modal" data-target="#connexion">
                    <div class="col-md-2 col-sm-0 col-xs-0 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="1.6s">
                        <div class="team-wrapper">
                            <img src="images/co.jpg" class="img-responsive" alt="team img 2" style="width: 100%; min-width : 100%;">
                                <div class="team-des">
                                    <h4>Se connecter</h4>
                                    <span>De manière sécurisée</span>
                                    <p>Veuillez rentrer vos identifiants afin d'avoir accès à votre comptre. En cas de problème de connection, n'hésitez pas à contacter notre service de support.</p>
                                </div>
                        </div>
                    </div></a>

                    <div id="connexion" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                          <div class="modal-content" style='border-radius: 16px 17px 15px 20px;'>
                          <div class="modal-header" style="background-color:#28a7e9; border-color:#202020; border-radius: 15px 15px 0px 0px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">CONNEXION | ACCÉDER À VOTRE ESPACE</h4>
                          </div>
                          <div class="modal-body" style='background-color: #202020; border-radius: 0px 0px 10px 15px;'>
                            <div id='alertErr2' class="alert alert-danger fade in" style='display:none;'>

                                <strong>Attention! </strong> <span id="errMsg2"></span>

                            </div>
                            <form action="index.php" method='post'>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="nom">Login</label>
                                <input type="text" name="co_login" onblur="verifCoLogin(this)" class="form-control" id="login_co" placeholder="Login">
                              </div>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="mdp">Mot de passe</label>
                                <input type="password" name="co_mdp" onblur="verifCoMdp(this)" class="form-control" id="mdp" placeholder="Mot de passe">
                              </div>
                                <div class="checkbox form-group col-md-6 col-sm-6">
                                    <label><input type="checkbox" name="co_autoco">Se souvenir de moi</label>
                                </div>
                              <input name="connexion" value='Se connecter' type="submit" class="btn btn-default col-md-offset-5" style='background-color: #28a7e9; border-color: #28a7e9; color:#303030; font-weight:bold;'>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div> 
                    
                    <div class="col-md-2 col-sm-0 col-xs-0 wow fadeIn" data-wow-offset="50" data-wow-delay="1.3s">
                    </div>
    					
    				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end team -->

    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">NOUS <span>CONTACTER</span></h2>
    				</div>
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
    					<form action="#" method="post">
    						<label>NAME</label>
    						<input name="fullname" type="text" class="form-control" id="fullname">
   						  	
                            <label>EMAIL</label>
    						<input name="email" type="email" class="form-control" id="email">
   						  	
                            <label>MESSAGE</label>
    						<textarea name="message" rows="4" class="form-control" id="message"></textarea>
    						
                            <input type="submit" class="form-control">
    					</form>
    				</div>
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
    					<address>
    						<p class="address-title">Notre adresse</p>
    						<span>Ci-dessous sont renseignés les différents moyens afin de prendre contact avec nous.</span>
    						<p><i class="fa fa-phone"></i> 06 12 34 56 78</p>
    						<p><i class="fa fa-envelope-o"></i> Parkcar@gmail.com</p>
    						<p><i class="fa fa-map-marker"></i> 36 quai des Orfèvres, 75 000 Paris</p>
    					</address>
    					<ul class="social-icon">
    						<li><h4>RESEAUX SOCIAUX</h4></li>
    						<li><a href="#" class="fa fa-facebook"></a></li>
    						<li><a href="#" class="fa fa-twitter"></a></li>
    						<li><a href="#" class="fa fa-instagram"></a></li>
    					</ul>
    				</div>
    			</div>
    		</div>
    	</section>
    	<!-- end contact -->

        <!-- start copyright -->
        <footer id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">
                       	Copyright &copy; 2015 ParkYourCar</p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end copyright -->

	</body>
</html>
<?php 
}

?>