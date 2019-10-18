<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.trajet")
 */
class trajet {

	/** 
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */ 
	public $id;

	/**
	 * @Column(type="string")
	 */ 
	public $depart;

	/**
	 * @Column(type="string")
	 */ 
	public $arrivee;

	/**
	 * @Column(type="integer")
	 */ 
	public $distance;

}

?>
