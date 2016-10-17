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
		<title>Jacquie et Michel</title>
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
                        <li><a href="index.php">ACCUEIL</a></li>
                        <li><a href="views/formation.php">FORMATION</a></li>
                        <li><a href="views/historique.php">HISTORIQUE</a></li>
                        <li><a href="views/connexion.php">DECONNEXION</a></li>
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
    				<h1>Liste de vos formations en cours de validation</h1>
    				</div>
    			</div>
    		</div>
    	</section>

        <!-- start copyright -->
        <footer id="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">
                       	Copyright &copy; 2016 J&M
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