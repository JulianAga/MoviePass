<?php
 	
 	include "Config/API_tmdb.php";
 	include "Api/api_now.php";// incluyo la API de peliculas actuales en cartelera
 	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	//error_reporting(E_ALL ^ E_NOTICE);
	
	require "Config/Autoload.php";
	require "Config/Config.php";

	use Config\Autoload as Autoload;
	use Config\Router 	as Router;
	use Config\Request 	as Request;
	
	
	Autoload::start();

	session_start();

	Router::Route(new Request());

	
?>