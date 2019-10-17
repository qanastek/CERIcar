<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="reservation")
 */
class reservation {

	/** 
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue
	 */ 
	public $id;

	/**
	 * @OneToOne(targetEntity="voyage")
	 * @Column(type="integer", nullable=false)
	 */ 
	public $voyage;
		
	/**
	 * @OneToOne(targetEntity="utilisateur")
	 * @Column(type="integer", nullable=false)
	 */ 
	public $voyageur;

}

?>
