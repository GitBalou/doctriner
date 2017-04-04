<?php 
// Product.php
namespace Imie\Entity;

/**
* @Entity(repositoryClass="ProductRepository")
* @Table
*/

Class Product {
	/** @Id @Column(type="integer") @GeneratedValue */
	private $_id;	

	/** @Column(type="string", length=130) */
	private $_name;

	/** @Column(type="string", nullable=true) */
	private $_image;

	public function getId(){ return $this->_id; }
	public function getName(){ return $this->_name;}
	public function getImage(){return $this->_image;}

	public function setName( $name){
		$this->_name = $name;
	}

	public function setImage( $imgPath) {
		$this->_image = $imgPath;
	}
}