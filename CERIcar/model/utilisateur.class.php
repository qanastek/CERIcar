<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.utilisateur")
 */
class utilisateur {

	/** 
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */ 
	public $id;

	/**
	 * @Column(type="string")
	 */ 
	public $identifiant;
		
	/**
	 * @Column(type="string")
	 */ 
	public $pass;

	/**
	 * @Column(type="string")
	 */ 
	public $nom;

	/**
	 * @Column(type="string")
	 */ 
	public $prenom;

	/**
	 * @Column(type="string")
	 */ 
	public $avatar;

}

?>
