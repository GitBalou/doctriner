<?php
namespace Imie\Entity;
use Doctrine\ORM\EntityRepository;


class ProductRepository extends EntityRepository {

	public function indexAction($attrName, $attrValue){
		
		$em = $this->getEntityManager();
		$query = $em->createQuery("SELECT p FROM Imie\\Entity\\Product p WHERE :attrName LIKE :attrValue");
		$query->setParameter( 'attrName', $attrName);
		$query->setParameter( 'attrValue', $attrValue); 
		$products = $query->getResult();

		return $products;
	}

	public function getProductByName($name) {
		
		$a = $this->createQueryBuilder('p');
		$b = $a->orderBy('p._name');
		$c = $b->getQuery();

		return $c->getResult();
	}
}