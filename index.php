<?php
require_once("Orders.php");

$orders = new Orders();
printArray("Orders with 'Logitech Mouse' as product", $orders->getProductByName("Logitech mouse"));
printArray("Orders with 'Plastic' as material of the product", $orders->findMaterialByName("Plastic"));
printArray("Orders with products with no parts", $orders->findProductsWithNoParts());


function printArray($title, $array){
	if (!is_null($title)) {
		echo "<pre>";
		echo "<h1>" . $title . "</h1>";
	 	print_r($array);
	 	echo "<h1>" . $title . " - end </h1>";
	 	echo "</pre>";
	} else {
		echo "<pre>";
	 	print_r($array);
	 	echo "</pre>";
	}
	
}
?>
