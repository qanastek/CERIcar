<?php

// Inclusion de la classe trajet
require_once "trajet.class.php";

class trajetTable {

  	public static function getTrajet($depart, $arrivee)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$trajetRepository = $em->getRepository('trajet');
		$trajet = $trajetRepository->findOneBy(array(
			'depart' => $depart,
			'arrivee' => $arrivee
		));
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}
		return $trajet; 
	}

}

?>