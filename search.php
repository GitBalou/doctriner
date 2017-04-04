<?php
include("bootstrap.php");

$repo = $entityManager->getRepository('Imie\Entity\Product');
$results = $repo->indexAction('p._name', '%teq%');

foreach ($results as $value) {
	echo $value->getId().' '.$value->getName()."\n";
}

$results = $repo->getProductByName('%te%');

foreach ($results as $value) {
	echo $value->getId().' '.$value->getName()."\n";
}


/*
$en = $repo->find(1);
$en->setName('crocododile');
$entityManager->flush();
*/

$id= $argv[1];
$name = $argv[2];

$p = $repo->findOneBy(array(
	'_id' => $id,
	'_name' => $name
));

$entityManager->remove($p);
$entityManager->flush();
/*;
$en= $repo->findBy( array(
	'_id' => $id,
	'_name' => $name
));

foreach( $en => $val) {
	$entityManager->remove($val);	
}

$entityManager->flush();
*/
