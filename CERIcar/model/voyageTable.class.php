<?php

// Inclusion de la classe voyage
require_once "voyage.class.php";

class voyageTable {

	/**
	 * Get a voyage list from a trajet identifier
	 *
	 * @param Trajet $trajet
	 * @return Voyage[]
	 */
  	public static function getVoyagesByTrajet($trajet,$seats) 
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$voyageRepository = $em->getRepository('voyage');
		$voyages = $voyageRepository
		->findBy(
			array('trajet' => $trajet),
			array('heureDepart' => 'ASC')
		);

		$i = 0;
		
		foreach ($voyages as $v) {
			$nbrPlaceRestanteVoyage = voyageTable::getPlacesRestantes($v->id);

			// Le supprimer si celui-ci n'a pas de place disponible
			if ($nbrPlaceRestanteVoyage < $seats) {	
				unset($voyages[$i]);	
			}

			$i++;
		}

		return $voyages; 
	}

	/**
	 * Get a voyage by id
	 * @param Integer $id
	 * @return Voyage[]
	 */
  	public static function getVoyageById($id) 
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$voyageRepository = $em->getRepository('voyage');
		$voyage = $voyageRepository->findOneBy(array('id' => $id));

		return $voyage; 
	}

	/**
	 * Get all the correspondances for a spefic trajet
	 * @param Integer $id
	 * @return Array
	 */
  	public static function getCorrespondances($trajet, $seats) 
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$sql = "SELECT * from correspondances('$trajet->depart','$trajet->arrivee',$seats)";
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$rslt = $stmt->fetchAll();

		$array = array();

		foreach ($rslt as $item) {

			// Array des nom des villes parcourus
			$villes = explode(',', $item["chemin"]);
			// Colle les avec des fleches
			$villes = implode(' <i class="fas fa-caret-right" aria-hidden="true"></i> ', $villes);

			// Array contenant tous les ID's
			$ids = explode(',', $item["chemin_id"]);
			$voyagesIds = array_slice($ids, 1);

			$departHeure = voyageTable::getVoyageById($voyagesIds[0])->heureDepart;	

			// Récupère l'heure d'arrivé
			$arriveeHeure = $item["heurearrivee"];

			$subarray = array(
				"villes" => $villes, 						// Villes en string
				"voyagesIds" => implode(",", $voyagesIds), 	// Tous les ID's
				"prix_total" => $item["prix_total"], 		// Prix total de la course
				"departHeure" => $departHeure,				// Heure de départ
				"arriveeHeure" => $arriveeHeure,			// Heure d'arrivé
			);

			array_push($array, $subarray);
		}
		
		return $array;
	}

	/**
	 * Calcule le nombre de place restantes
	 *
	 * @param Integer $idVoyage
	 * @return Integer Nombre de place restante
	 */
  	public static function getPlacesRestantes($idVoyage)
	{
		$em = dbconnection::getInstance()->getEntityManager();

		// Récupère le nombre de place totale disponible sur le voyage
		$voyageRepository = $em->getRepository('voyage');
		$voyage = $voyageRepository->findOneBy(array('id' => $idVoyage));
		$nbrPlacesTotal = $voyage->nbPlace;

		// Récupère le nombre de places déjà réservé pour ce voyage
		$reservationRepository = $em->getRepository('reservation');
		$reservations = $reservationRepository->findBy(array('voyage' => $idVoyage));
		$nbrReservation = count($reservations);

		return $nbrPlacesTotal - $nbrReservation;
	}

	/**
	 * Ne fonctionnent pas
	 */
  	public static function NbVoyagesTrajet($idTrajet)
	{
		$em = dbconnection::getInstance()->getEntityManager();


		$sql = 'SELECT nbvoyagestrajet from NbVoyagesTrajet(' . $idTrajet . ')';
		$stmt = $em->getConnection()->prepare($sql);
		$stmt->execute();
		$rslt = $stmt->fetchAll();

		return $rslt[0]["nbvoyagestrajet"];
	}
	
	public static function addVoyage(
		$cityFrom,
		$cityTo,
		$fromHour,
		$price,
		$seats,
		$contraints
	) {
		$em = dbconnection::getInstance()->getEntityManager();

		$userId = $_SESSION["user_id"];

		$voyage = new voyage();

		$voyage->conducteur = utilisateurTable::getUserById(intval($userId));

		if (!isset($voyage->conducteur)) {
			return false;
		}

		$voyage->trajet = trajetTable::getTrajet($cityFrom,$cityTo);

		if (!isset($voyage->trajet)) {
			return false;
		}

		$voyage->tarif = $price;
		$voyage->nbPlace = $seats;
		$voyage->heureDepart = $fromHour;
		$voyage->contraintes = $contraints;

		$em->persist($voyage);
		$em->flush();

		return true;
	}

}

?>