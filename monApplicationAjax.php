<?php
/*
* Mon dispacher
*/

//nom de l'application
$nameApp = "CERIcar";

//action par défaut
$action = "index";

if(key_exists("action", $_REQUEST))
$action =  $_REQUEST['action'];

require_once 'lib/core.php';

// Inclus le controller générale de l'application
require_once $nameApp . '/controller/mainController.php';

// Charge tous les modèles
foreach(glob($nameApp . '/model/*.class.php') as $model)
	include_once $model ;   

session_start();

$context = context::getInstance();

// Initialise le nom de l'application
$context->init($nameApp);

// Controlleur
$view = $context->executeAction($action, $_REQUEST);

// Traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view === false)
{
	echo "Une grave erreur s'est produite, il est probable que l'action " . $action . " n'existe pas...";
	die;
}

/**
* Renvoie la vue correspondante à si le controller existe ou non
*/
include($nameApp . "/view/" . $action . $view . ".php");

?>
