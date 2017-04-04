<?php
include("bootstrap.php");
use Imie\Entity\Product;

// POSt_ID
if( isset($_POST['id']) ) {
	$id = intval($_POST['id']);

	$repo = $entityManager->getRepository('Imie\Entity\Product');
	$p = $repo->find($id);
}

// POST_file
$msg = "";
if( isset( $_FILES) && isset($_FILES['file'])) {

	$file = $_FILES['file'];
	$name = $file['name'];
	$tmp_name = $file['tmp_name'];
	
	if ( move_uploaded_file($tmp_name, "uploads/".$name) ) {
	    $msg = "Upload ok";

	    $product = new Product();
	    $product->setName($name);
	    $product->setImage("uploads/".$name);
	    $entityManager->persist($product);
	    $entityManager->flush();
	}
	else {
		$msg = "Upload error";
	}


}

// repo
$repo = $entityManager->getRepository('Imie\Entity\Product');

// delete files
if( isset($_GET['delete'])) {
	$id = intval($_GET['id']);
	
	$prodToDel = $repo->find($id);
	if( $prodToDel != NULL) {
		$entityManager->remove($prodToDel);
		$entityManager->flush();
	}
}

// Read images
$products = $repo->findAll();
?>

<html>
<head>
</head>

<body>
	<form method="post" action="form.php" >
		<input type="number" step="1" name="id" />
		<input type="submit" value="envoyer" />
	</form>

<?php if( isset($p)) : ?>	
	<p>
		<?php echo $p->getName(); ?>
	</p> 
<?php endif; ?>

	<form method="post" action="form.php" enctype="multipart/form-data">
		<input name="file" type="file" />
  		<input type="submit" value="Envoyer le fichier" />
	</form>

<?php if( $msg != '') : ?>
	<p>
		<?php echo $msg; ?>
	</p>
<?php endif; ?>
		
		<ul>
<?php 	foreach ($products as $product) :
			if( $product->getImage() != '') : ?>
				<li>
					<img src="<?php echo $product->getImage(); ?>" />
					<a href="?delete&id=<?php echo $product->getId(); ?>">Supprimer</a>
				</li>
<?php		endif;
		endforeach;
?>
		</ul>
</body>

</html>