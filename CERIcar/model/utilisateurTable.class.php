<?php

// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";

class utilisateurTable {

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

	public static function addUser(
		$username,
		$name,
		$surname,
		$image,
		$password
	) {
		$em = dbconnection::getInstance()->getEntityManager();

		$utilisateur = new utilisateur();

		$utilisateur->identifiant = $username;
		$utilisateur->pass = $password;
		$utilisateur->nom = $name;
		$utilisateur->prenom = $surname;
		$utilisateur->avatar = $image;

		$em->persist($utilisateur);
		$em->flush();
	}

}

?>