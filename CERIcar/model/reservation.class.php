<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.reservation")
 */
class reservation {

	/** 
	 * @Id
	 * @Column(type="integer", nullable=false)
	 * @GeneratedValue
	 */ 
	public $id;

	/**
	 * @Column(type="integer", nullable=false)
	 * @OneToOne(targetEntity="voyage")
	 * @JoinColumn(name="voyage", referencedColumnName="id")
	 */ 
	public $voyage;
		
	/**
	 * @Column(type="integer", nullable=false)
	 * @OneToOne(targetEntity="utilisateur")
	 * @JoinColumn(name="voyageur", referencedColumnName="id")
	 */ 
	public $voyageur;

}

?>
