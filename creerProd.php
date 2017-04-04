<?php
include("bootstrap.php");
use Imie\Entity\Product;

$prod = new Product();

$prod->setName($argv[1]);
$entityManager->persist($prod);
$entityManager->flush();

echo "Le fichier ".$argv[1]." est enregistre sous l'id ".$prod->getId();