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
			$_SESSION["from"] = ucfirst($_POST['from']);
		}
		// Si l'autre champs est remplit alors go à la page d'accueil
		else if (isset($_POST['from']) && $_POST['from'] != null && isset($_SESSION["to"]))
		{
			$_SESSION["from"] = ucfirst($_POST['from']);
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
			$_SESSION["to"] = ucfirst($_POST['to']);
		}
		// Si on recoit TO et que FROM est déjà set
		else if (isset($_POST['to']) && $_POST['to'] != null && isset($_SESSION["from"])) {
			$_SESSION["to"] = ucfirst($_POST['to']);
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

		if (isset($_SESSION["from"]) && isset($_SESSION["to"])) {
			
			$trajet = trajetTable::getTrajet(
				$_SESSION["from"],
				$_SESSION["to"]
			);
		
			$context->voyages = voyageTable::getVoyagesByTrajet($trajet->id);

			// Vérifier que l'ont a bien des voyages en retour
			if (count($context->voyages) > 0) {
				return context::SUCCESS;
			} else {
				$context->notification = "No result";
				return context::NONE;
			}
	
		} else {
			$context->notification = "No from or destination";
			return context::ERROR;
		}
	}

	/**
	 * Controller de la banner
	 */
	public static function banner($request,$context) {
		$context->notification = "Tesing";
		$context->notification_status = "warning";
		return context::SUCCESS;
	}

}
