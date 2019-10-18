<?php

// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

  	public static function getUserByLoginAndPass($login,$pass)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('identifiant' => $login, 'pass' => $pass));	
		
		if ($user == false) {
			echo 'Erreur sql';
		}
		return $user; 
	}

  	public static function getUserById($id)
	{
		$em = dbconnection::getInstance()->getEntityManager() ;

		$userRepository = $em->getRepository('utilisateur');
		$user = $userRepository->findOneBy(array('id' => $id));	
		
		if ($user == false) {
			echo 'Erreur sql';
		}
		return $user; 
	}

}

?>