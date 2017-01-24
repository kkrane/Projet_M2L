<?php

session_start();

	require "models/connexion.php";

	define("BASE_URL",$_SERVER['REQUEST_URI']);

	if(!isset($_GET['p']) || $_GET['p'] == "") 
	{
		$_GET['p'] = "connexionhome";
	}
	else
	{
		if(!file_exists("controllers/".$_GET['p'].".php"))
		{
			$_GET['p']="404";
		}
	}
	ob_start();
		include "controllers/".$_GET['p'].".php";
		$content = ob_get_contents();
	ob_end_clean();

	require "views/layout.php";