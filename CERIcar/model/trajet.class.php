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
	 * @Column(type="string", length=25, nullable=false)
	 */ 
	public $depart;

	/**
	 * @Column(type="string", length=25, nullable=false)
	 */ 
	public $arrivee;

	/**
	 * @Column(type="integer", nullable=false)
	 */ 
	public $distance;

}

?>
