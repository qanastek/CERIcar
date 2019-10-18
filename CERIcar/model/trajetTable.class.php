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
	 *  Fonction qui renvoie tout les départs pour une arrivée
	 *
	 * @param String $arrivee
	 * @return void
	 */
  	public static function getDepartFromArrivee($arrivee)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$trajetRepository = $em->getRepository('trajet');

		// Si il y une destination de saisie
		if ($arrivee) {
			$trajet = $trajetRepository->findBy(array('arrivee' => $arrivee));
		} else {
			$trajet = $trajetRepository->findAll();
		}
		
		if ($trajet == false) {
			echo 'Erreur sql';
		}

		return $trajet;
	}

	/**
	 * Fonction qui renvoie tout les arrivée pour un départs 
	 *
	 * @param String $depart
	 * @return void
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