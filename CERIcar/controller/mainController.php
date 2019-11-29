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
			$_SESSION["from"] = ucfirst(strtolower($_POST['from']));
		}
		// Si l'autre champs est remplit alors go à la page d'accueil
		else if (isset($_POST['from']) && $_POST['from'] != null && isset($_SESSION["to"]))
		{
			$_SESSION["from"] = ucfirst(strtolower($_POST['from']));
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
			$_SESSION["to"] = ucfirst(strtolower($_POST['to']));
		}
		// Si on recoit TO et que FROM est déjà set
		else if (isset($_POST['to']) && $_POST['to'] != null && isset($_SESSION["from"])) {
			$_SESSION["to"] = ucfirst(strtolower($_POST['to']));
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

			if ($trajet == null) {
				$_SESSION["notification"] = "Le trajet n'existe pas !";
				$_SESSION["notification_status"] = "warning";
				return context::NONE;
			}
		
			// Voyages simple
			$context->voyages = voyageTable::getVoyagesByTrajet($trajet->id);
			
			// Voyages avec correspondance
			$context->voyagesCorrespondance = voyageTable::getCorrespondances($trajet);

			// Nombre de voyages total
			$context->nbVoyagesDisponible = count($context->voyages) + count($context->voyagesCorrespondance);

			// Vérifier que l'ont a bien des voyages en retour
			if ($context->nbVoyagesDisponible > 0) {
				$_SESSION["notification"] = "Trouver !";
				$_SESSION["notification_status"] = "success";
				return context::SUCCESS;
			} else {
				$_SESSION["notification"] = "No result";
				$_SESSION["notification_status"] = "warning";
				return context::NONE;
			}
	
		} else {
			$_SESSION["notification"] = "No from or destination";
			$_SESSION["notification_status"] = "warning";
			return context::ERROR;
		}
	}

	/**
	 * Controller de la banner
	 */
	public static function banner($request,$context) {
		return context::SUCCESS;
	}

	/**
	 * Controller du header
	 */
	public static function header($request,$context) {
		return context::SUCCESS;
	}

	/**
	 * Controller de la connection
	 */
	public static function login($request,$context) {
		return context::SUCCESS;
	}

	/**
	 * Controller de l'inscription
	 */
	public static function register($request,$context) {
		return context::SUCCESS;
	}

	/**
	 * Controller du processus d'inscription
	 */
	public static function registerProcess($request,$context) {

		if (isset($_POST["username"]) &&
			isset($_POST["name"]) &&
			isset($_POST["surname"]) &&
			isset($_POST["image"]) &&
			isset($_POST["password"])
		) {
			// Ajout d'un utilisateur dans la DB
			utilisateurTable::addUser(
				$_POST["username"],

				$_POST["name"],
				$_POST["surname"],

				$_POST["image"],
				sha1($_POST["password"])
			);

			return context::SUCCESS;
		}

	}


	/**
	 * Controller de la proposition de voyage par un conducteur
	 */
	public static function offerSeats($request,$context) {

		if (isset($_POST["cityFrom"]) &&
			isset($_POST["cityTo"]) &&

			isset($_POST["fromHour"]) &&

			isset($_POST["price"]) &&
			isset($_POST["seats"])
		) {

			$contraintes = $_POST["contraints"] ? $_POST["contraints"] : "";

			$context->trajet = trajetTable::getTrajet(
				$_POST["cityFrom"],
				$_POST["cityTo"]
			);

			// Vérifie si le trajet existe vraiement
			if ($context->trajet == null) {
				$_SESSION["notification"] = "Trajet inconnu";
				$_SESSION["notification_status"] = "warning";
				return context::ERROR;
			}

			// Ajout des voyages dans la DB
			$rslt = voyageTable::addVoyage(
				$_POST["cityFrom"],
				$_POST["cityTo"],

				$_POST["fromHour"],

				$_POST["price"],
				$_POST["seats"],

				$contraintes
			);

			if ($rslt == null) {				
				$_SESSION["notification"] = "Insertion rater";
				$_SESSION["notification_status"] = "warning";
				return context::ERROR;
			} else {
				return context::SUCCESS;
			}

		} else {	
			$context->citiesFrom = trajetTable::getAllDepart();
			$context->citiesTo = trajetTable::getAllArrivee();
		}

		return context::SUCCESS;
	}

	/**
	 * Controller des profiles
	 */
	public static function profile($request,$context) {

		$context->user = utilisateurTable::getUserById($_SESSION["user_id"]);

		$context->allReservation = reservationTable::getReservationsByUser($context->user);

		return context::SUCCESS;
	}

	/**
	 * Controller des réservations de voyage
	 */
	public static function book($request,$context) {

		if (isset($_POST["voyageId"])) {

			$voyages = $_POST["voyageId"];
			$voyages = explode(",", $voyages);

			if (count($voyages) == 1) {

				// TODO: Check si un nombre pour des raisons de sécurité

				$reservation = reservationTable::addReservationByVoyage($voyages);
			}
			else {

				foreach ($voyages as $item) {
					reservationTable::addReservationByVoyage($item);
				}

			}
		}

		return context::SUCCESS;
	}

	/**
	 * Controller pour le processus de vérification pour la connection
	 */
	public static function loginProcess($request,$context) {

		if (isset($_POST["identifier"]) && isset($_POST["password"])) {

			$identifier = $_POST["identifier"];
			$password = $_POST["password"];

			$user = utilisateurTable::getUserByLoginAndPass($identifier, $password);
			$context->user = $user;
		
			if ($user) {
				$context->setSessionAttribute('user_id', $user->id);
				$context->setSessionAttribute('user_login', $user->identifiant);
				return context::SUCCESS;
			} else {
				$_SESSION["notification"] = "Bad identifier or password";
				$_SESSION["notification_status"] = "warning";
				return context::ERROR;
			}

		} else {
			$_SESSION["notification"] = "No identifier or password";
			$_SESSION["notification_status"] = "warning";
			return context::ERROR;
		}
	}
	/**
	 * Controller pour la déconnection
	 */
	public static function logout($request,$context) {
		
		if (isset($_SESSION["user_id"]) || isset($_SESSION["user_login"])) {
			
			unset($_SESSION["notification"]);
			unset($_SESSION["notification_status"]);

			unset($_SESSION["user_id"]);
			unset($_SESSION["user_login"]);

			return context::SUCCESS;

		} else {
			$_SESSION["notification"] = "Currently not connected !";
			$_SESSION["notification_status"] = "warning";
			return context::ERROR;
		}
	}

}
