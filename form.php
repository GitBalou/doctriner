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
if( isset( $_FILES)) {

	$file = $_FILES['file'];
	$name = $file['name'];
	$tmp_name = $file['tmp_name'];
	$msg = "";
	if ( move_uploaded_file($tmp_name, "uploads/".$name) ) {
	    $msg = "Upload ok";

	    $product = new Product();
	    $product->setName($name);
	    //$product->setImage("uploads/".$name);
	    $entityManager->persist($product);
	    $entityManager->flush();
	}
	else {
		$msg = "Upload error";
	}


}
// Read images
$repo = $entityManager->getRepository('Imie\Entity\Product');
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
				</li>
<?php		endif;
		endforeach;
?>
		</ul>
</body>

</html>