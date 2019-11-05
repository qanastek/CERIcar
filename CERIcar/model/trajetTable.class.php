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
		$em = dbconnection::getInstance()->getEntityManager();

		$queryBuilder = $em->createQueryBuilder();

		$queryBuilder->select('t.depart')
		->from(trajet::class, 't')
		->distinct()
		->orderBy('t.depart', 'ASC');
		
		$rslt = $queryBuilder->getQuery()->execute();

		return $rslt;
	}

	/**
	 * Fonction qui renvoie tout les départs pour une arrivée sans doublons
	 * @param String $depart Nom de la ville de départ
	 * @return Trajet[] Renvoie une Tableau de String avec comme seule clé "arrivee"
	 */
  	public static function getDepartFromArrivee($arrivee)
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$queryBuilder = $em->createQueryBuilder();

		$queryBuilder->select('t.depart')
		->from(trajet::class, 't')
		->where('t.arrivee = :villeArrivee')
		->setParameter('villeArrivee', $arrivee)
		->distinct()
		->orderBy('t.depart', 'ASC');
		
		$rslt = $queryBuilder->getQuery()->execute();

		return $rslt;
	}

	
	/**
	 *  Fonction qui renvoie tout les arrivee
	 * @return Trajet[] Liste de trajet
	 */
	public static function getAllArrivee() {

		$em = dbconnection::getInstance()->getEntityManager();

		$queryBuilder = $em->createQueryBuilder();

		$queryBuilder->select('t.arrivee')
		->from(trajet::class, 't')
		->distinct()
		->orderBy('t.arrivee', 'ASC');
		
		$rslt = $queryBuilder->getQuery()->execute();

		return $rslt;
	} 

	/**
	 * Fonction qui renvoie tout les arrivées pour un départ sans doublons
	 * @param String $depart Nom de la ville de départ
	 * @return Trajet[] Renvoie une Tableau de String avec comme seule clé "arrivee"
	 */
  	public static function getArriveeFromDepart($depart)
	{
		$em = dbconnection::getInstance()->getEntityManager();

		$queryBuilder = $em->createQueryBuilder();

		$queryBuilder->select('t.arrivee')
		->from(trajet::class, 't')
		->where('t.depart = :villeDepart')
		->setParameter('villeDepart', $depart)
		->distinct()
		->orderBy('t.arrivee', 'ASC');
		
		$rslt = $queryBuilder->getQuery()->execute();

		return $rslt;
	}

}

?>