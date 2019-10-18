<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.voyage")
 */
class voyage {

	/** 
	 * @Id
	 * @Column(type="integer")
	 * @GeneratedValue
	 */ 
	public $id;

	/**
	 * @Column(type="integer", nullable=false)
	 * @ManyToOne(targetEntity="utilisateur")
	 * @JoinColumn(name="conducteur", referencedColumnName="id")
	 */ 
	public $conducteur;

	/**
	 * @Column(type="integer", nullable=false)
	 * @ManyToOne(targetEntity="trajet")
	 * @JoinColumn(name="trajet", referencedColumnName="id")
	 */ 
	public $trajet;

	/**
	 * @Column(type="integer", nullable=false)
	 */ 
	public $tarif;

	/**
	 * @Column(type="integer", nullable=false)
	 */ 
	public $nbPlace;

	/**
	 * @Column(type="integer", nullable=false)
	 */ 
	public $heureDepart;

	/**
	 * @Column(type="string", length=500)
	 */ 
	public $contraintes;

}

?>
