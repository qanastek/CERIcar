<?php

/**
* Controllers gérant les différentes routes
*/
class mainController
{

	public static function helloWorld($request,$context)
	{
		$context->mavariable = "hello world";
		return context::SUCCESS;
	}

	public static function index($request,$context)
	{		
		return context::SUCCESS;
	}

	public static function searchVoyage($request,$context)
	{
		return context::SUCCESS;
	}

	/**
	 * Vue de saisie de la ville de départ
	 * @param $request
	 * @param $context
	 * @return void
	 */
	public static function searchVoyageFrom($request,$context)
	{
		// Si l'autre champs n'est pas remplit alors go à lui
		if (isset($_POST['from']) && $_POST['from'] != null && !isset($_SESSION["to"]))
		{
			$_SESSION["from"] = $_POST['from'];
			$context->redirect("monApplication.php?action=searchVoyageTo");
		}
		// Si l'autre champs est remplit alors go à la page d'accueil
		else if (isset($_POST['from']) && $_POST['from'] != null && isset($_SESSION["to"]))
		{
			$_SESSION["from"] = $_POST['from'];
			$context->redirect("monApplication.php?action=searchVoyage");
		}
		else if(isset($_SESSION["to"])) {
			$context->allFrom = trajetTable::getDepartFromArrivee($_SESSION["to"]);
		}
		else if(!isset($_SESSION["to"])) {
			$context->allFrom = trajetTable::getAllDepart();
		}
		return context::SUCCESS;
	}

	/**
	 * Vue de saisie de la ville d'arrivé
	 * @param $request
	 * @param $context
	 * @return void
	 */
	public static function searchVoyageTo($request,$context)
	{
		// Je set la valeur de to
		if (isset($_POST['to']) && $_POST['to'] != null && !isset($_SESSION["from"])) {
			$_SESSION["to"] = $_POST['to'];		
			$context->redirect("monApplication.php?action=searchVoyageFrom");
		}
		// Si on recoit TO et que FROM est déjà set
		else if (isset($_POST['to']) && $_POST['to'] != null && isset($_SESSION["from"])) {
			$_SESSION["to"] = $_POST['to'];
			$context->redirect("monApplication.php?action=searchVoyage");
		}
		else if(isset($_SESSION["to"])) {
			$context->allTo = trajetTable::getArriveeFromDepart($_SESSION["from"]);
		}
		else if(!isset($_SESSION["to"])) {
			$context->allTo = trajetTable::getAllArrivee();
		}

		return context::SUCCESS;
	}

	public static function superTest($request,$context)
	{		
		$context->param1 = $_GET["param1"];
		$context->param2 = $_GET["param2"];

		$context->notification = "Tout c'est bien passé";
		$context->notification_status = "success";

		$context->trajet = trajetTable::getTrajet("Angers", "Amiens");
		$context->voyages = voyageTable::getVoyagesByTrajet($context->trajet);
		$context->reservations = reservationTable::getReservationByVoyage(1);

		$context->user1 = utilisateurTable::getUserByLoginAndPass("OM", "123456");
		$context->user2 = utilisateurTable::getUserById(1);

		return context::SUCCESS;
	}

	/**
	 * Charge tout les voyages correspondant au trajet 
	 */
	public static function searchResult($request,$context) {
		
		$trajet = trajetTable::getTrajet(
			$context->getSessionAttribute("from"),
			$context->getSessionAttribute("to")
		);
		
		$context->voyages = voyageTable::getVoyagesByTrajet($trajet->id);

		return context::SUCCESS;
	}

}
