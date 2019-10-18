<?php

// Inclusion de la classe reservation
require_once "reservation.class.php";

class reservationTable {

  	public static function getUserByLoginAndPass($login,$pass)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));	
		
		if ($user == false) {
			echo 'Erreur sql';
		}
		return $user; 
	}

}

?>