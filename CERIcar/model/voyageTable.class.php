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

}

?>