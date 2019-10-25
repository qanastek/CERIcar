<?php

// Inclusion de la classe trajet
require_once "trajet.class.php";

class trajetTable {

  	public static function getTrajet($depart, $arrivee)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$trajetRepository = $em->getRepository('trajet');

		$trajet = $trajetRepository->findOneBy(array('depart' => $depart,'arrivee' => $arrivee));
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}

		return $trajet;
	}

	/**
	 *  Fonction qui renvoie tout les départs
	 *
	 * @return Trajet[] Liste de trajet
	 */
	public static function getAllDepart() {
		$em = dbconnection::getInstance()->getEntityManager() ;

		$trajetRepository = $em->getRepository('trajet');

		$trajet = $trajetRepository->findAll();
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}

		return $trajet;
	} 

	/**
	 *  Fonction qui renvoie tout les départs pour une arrivée
	 *
	 * @param String $arrivee
	 * @return Trajet[] Liste de trajet
	 */
  	public static function getDepartFromArrivee($arrivee)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$trajetRepository = $em->getRepository('trajet');

		$trajet = $trajetRepository->findBy(array('arrivee' => $arrivee));
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}

		return $trajet;
	}

	/**
	 * Fonction qui renvoie tout les arrivée pour un départs 
	 *
	 * @param String $depart
	 * @return Trajet[]
	 */
  	public static function getArriveeFromDepart($depart)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$trajetRepository = $em->getRepository('trajet');

		// Si il y une destination de saisie
		if ($depart) {
			$trajet = $trajetRepository->findBy(array('depart' => $depart));
		} else {
			$trajet = $trajetRepository->findAll();
		}
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}

		return $trajet;
	}

}

?>