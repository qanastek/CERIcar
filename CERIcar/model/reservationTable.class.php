<?php

// Inclusion de la classe reservation
require_once "reservation.class.php";

class reservationTable {

  	public static function getReservationByVoyage($voyage)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$reservationRepository = $em->getRepository('reservation');
		$reservation = $reservationRepository->findBy(array('voyage' => $voyage));	
		
		if ($reservation == false) {
			echo 'Erreur sql';
		}
		return $reservation; 
	}

  	public static function addReservationByVoyage($voyage)
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$userId = $_SESSION["user_id"];

		$reservation = new reservation();
		
		$reservation->voyage = voyageTable::getVoyageById(intval($voyage));
		$reservation->voyageur = utilisateurTable::getUserById(intval($userId));

		$em->persist($reservation);
		$em->flush();
	}

}

?>