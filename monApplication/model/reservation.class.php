<?php

use Doctrine\Common\Collections\ArrayCollection;

/** 
 * @Entity
 * @Table(name="jabaianb.reservation")
 */
class reservation{

	/** @Id @Column(type="integer")
	 *  @GeneratedValue
	 */ 
	public $id;

    /**
     *  @OneToOne(targetEntity="voyage")
     *  @JoinColumn(name="voyage", referencedColumnName="id")
     * */ 
	public $voyage;
		
    /**
     *  @OneToOne(targetEntity="utilisateur")
     *  @JoinColumn(name="voyageur", referencedColumnName="id")
     * */ 
	public $voyageur;
	
}

?>