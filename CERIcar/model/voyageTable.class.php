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
  	public static function getVoyagesByTrajet($trajet) 
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$voyageRepository = $em->getRepository('voyage');
		$voyage = $voyageRepository->findBy(array('trajet' => $trajet));

		return $voyage; 
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

}

?>