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
		$context->allFrom = trajetTable::getDepartFromArrivee($context->to);
		$context->allTo = trajetTable::getArriveeFromDepart($context->from);
		return context::SUCCESS;
	}

	/**
	 * Vue de saisie de la ville de départ
	 *
	 * @param $request
	 * @param $context
	 * @return void
	 */
	public static function searchVoyageFrom($request,$context)
	{
		// Je set la valeur de from
		if (isset($_POST['from']) && $_POST['from'] != null && !isset($_SESSION["to"])) {
			$_SESSION["from"] = $_POST['from'];
			header("Location: monApplication.php?action=searchVoyageTo", true);
		}
		else if (isset($_POST['from']) && $_POST['from'] != null && isset($_SESSION["to"])) {
			// Si on recoit FROM et que TO est déjà set
			$_SESSION["from"] = $_POST['from'];
			header("Location: monApplication.php?action=searchVoyage", true);
		}
		else {
			$context->allFrom = trajetTable::getDepartFromArrivee($_SESSION["to"]);
		}
		return context::SUCCESS;
	}

	/**
	 * Vue de saisie de la ville d'arrivé
	 *
	 * @param $request
	 * @param $context
	 * @return void
	 */
	public static function searchVoyageTo($request,$context)
	{
		// Je set la valeur de to
		if (isset($_POST['to']) && $_POST['to'] != null && !isset($_SESSION["from"])) {
			$_SESSION["to"] = $_POST['to'];
			header("Location: monApplication.php?action=searchVoyageFrom", true);
		}
		else if (isset($_POST['to']) && $_POST['to'] != null && isset($_SESSION["from"])) {
			// Si on recoit TO et que FROM est déjà set
			$_SESSION["to"] = $_POST['to'];
			header("Location: monApplication.php?action=searchVoyage", true);
		}
		else {
			// Je limite les choix de to ainsi que je choisi to
			$context->allTo = trajetTable::getArriveeFromDepart($_SESSION["from"]);
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

}
