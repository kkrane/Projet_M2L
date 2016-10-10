<?php 

session_start();

if(!isset($_SESSION['user_login']))
{
    header("location:index.php?sess=nok");
}

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
                    <a href="index.php" class="navbar-brand"> <img src="images/logo.png" class="img-responsive" style="width: 50px; height=50px";> </a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#team">VOIR MA PLACE</a></li>
                        <li><a href="#about">AIDE</a></li>
                        <li><a href="#portfolio">MODIFIER MON COMPTE</a></li>
                        <li><a href="#contact">CONTACT</a></li>
                        <li><a> <?php echo $_SESSION['user_login']; ?></a></li>
                </div>
            </div>
        </nav>
        
        <!-- end header -->

        <!-- start team -->
        <section id="team" style="background-image:url('images/bg.jpg')">
            <div class="container">
                <div class="row">
                    <div class="col-md-13">
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-0 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s"> 
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
                            <h2> Mr. <span><?php echo $_SESSION['user_login']; ?></span></h2>
                            <h2>VOUS ÊTES</h2>
                            <div class="rond">
                                <span style="font-size:10em; font-weight:400; color:white;">4°</span>
                            </div>
                            <h2 style="margin-top:10%;">DANS LA FILE</h2>
                    </div>
                </div>
            </div>
        </section>
        <!-- end team -->

    	<!-- start about -->
		<section id="about">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">BESOIN D'<span>AIDE</span></h2>
    				</div>
                    <div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.8s">
                        <div class="media">
                            <div class="media-heading-wrapper">
                                <div class="media-object pull-left">
                                    <i class="fa fa-tag"></i>
                                </div>
                                <h3 class="media-heading">Accès ma place? </h3>
                            </div>
                            <div class="media-body">
                                <p>La section <a rel="nofollow" href="http://www.google.com" target="_parent">Voir ma place</a>, vous permet de connaître votre place dans la file d'attente si une place ne vous a pas encore été attrribuée.</p>
                            </div>
                        </div>
                    </div>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-offset="50" data-wow-delay="0.3s">
						<div class="media">
							<div class="media-heading-wrapper">
								<div class="media-object pull-left">
									<i class="fa fa-car"></i>
								</div>
								<h3 class="media-heading">Votre espace membre</h3>
							</div>
							<div class="media-body">
								<p>Bienvenue sur <a rel="nofollow" href="http://www.google.com">Parkcar</a>. Voici votre espace membre sur lequel vous pouvez avoir accès à la réservation de votre place de parking. Si vous ne trouvez pas les informations que vous cherchez, n'hésitez pas à nous contacter.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.8s">
						<div class="media">
							<div class="media-heading-wrapper">
								<div class="media-object pull-left">
									<i class="fa fa-paper-plane"></i>
								</div>
								<h3 class="media-heading">Modifier mon compte?</h3>
							</div>
							<div class="media-body">
								<p>Votre compte <a rel="nofollow" href="http://www.google.com">Parkcar</a>, est personnel. Si vous désirez modifier votre adresse mail de référence ou votre mot de passe, la section <a rel="nofollow" href="http://www.google.com">Modifier mon compte</a> est faite pour vous.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- end about -->

        <section id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>MODIFIER </span>MON COMPTE</h2>
                    </div>
                    <a href="#nogo" style='color:#fff;' class="view-detail" data-toggle="modal" data-target="#mail">
                    <div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s">
                        <div class="portfolio-thumb">
                           <img src="images/mail.jpeg" class="img-responsive">
                                <div class="portfolio-overlay">
                                    <h4>Changer mon mail</h4>
                                    <p>Si vous désirez changer ou modifier votre mail cliquez ici.</p>
                                </div>
                        </div>
                    </div></a>
                     <div id="mail" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style='border-radius: 16px 17px 15px 20px;'>
                          <div class="modal-header" style="background-color:#28a7e9; border-color:#202020; border-radius: 15px 15px 0px 0px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">CHANGER | MODIFIER MON MAIL</h4>
                          </div>
                          <div class="modal-body" style='background-color: #202020; border-radius: 0px 0px 10px 15px;'>
                            <form>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="login">NOUVEAU MAIL</label>
                                <input type="text" class="form-control" id="login" placeholder="Identifiant">
                              </div> 
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="mdp">VERIFICATION</label>
                                <input type="paswword" class="form-control" id="mdp" placeholder="Mot de passe">
                              </div>
                                <div id="mdpOubli" style='text-align:center;'>
                                    Votre ancien mail: <FONT color="#6E6E6E">lastTest@gmail.com</FONT>
                                    
                                </div>
                              <div class="row" style='margin-top:5%;'><button type="submit" class="btn btn-default col-md-offset-5" style='background-color: #28a7e9; border-color: #28a7e9; color:#303030; font-weight:bold;'>MODIFIER</button></div>
                            </form>
                          </div>
                        </div>
                    
                    </div>
                    </div>


                    <a href="#nogo" style='color:#fff;' class="view-detail" data-toggle="modal" data-target="#motpasse">
                    <div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.6s">
                        <div class="portfolio-thumb">
                           <img src="images/mdp.jpeg" class="img-responsive">
                                <div class="portfolio-overlay">
                                    <h4>Changer mon mot de passe</h4>
                                    <p>Si vous désirez changer ou modifier votre mot de passe cliquez ici.</p>
                                </div>
                        </div>
                    </div></a>
                    <div id="motpasse" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content" style='border-radius: 16px 17px 15px 20px;'>
                          <div class="modal-header" style="background-color:#28a7e9; border-color:#202020; border-radius: 15px 15px 0px 0px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">MODIFIER LE MOT DE PASSE</h4>
                          </div>
                          <div class="modal-body" style='background-color: #202020; border-radius: 0px 0px 10px 15px;'>
                            <form>
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="login">NOUVEAU MDP</label>
                                <input type="text" class="form-control" id="login" placeholder="Identifiant">
                              </div> 
                              <div class="form-group col-md-6 col-sm-6">
                                <label for="mdp">VERIFICATION</label>
                                <input type="paswword" class="form-control" id="mdp" placeholder="Mot de passe">
                              </div>
                              <div class="row" style='margin-top:5%;'><button type="submit" class="btn btn-default col-md-offset-5" style='background-color: #28a7e9; border-color: #28a7e9; color:#303030; font-weight:bold;'>MODIFIER</button></div>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div> 
                </div>
            </div>
        </section>

    	<!-- start contact -->
    	<section id="contact">
    		<div class="container">
    			<div class="row">
    				<div class="col-md-12">
    					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">NOUS <span>CONTACTER</span></h2>
    				</div>
    				<div class="col-md-6 col-sm-6 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.9s">
    					<form action="#" method="post">
    						<label>NOM</label>
    						<input name="fullname" type="text" class="form-control" id="fullname">
   						  	
                            <label>EMAIL</label>
    						<input name="email" type="email" class="form-control" id="email">
   						  	
                            <label>MESSAGE</label>
    						<textarea name="message" rows="4" class="form-control" id="message"></textarea>
    						
                            <input type="submit" class="form-control" value='Envoyer'>
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