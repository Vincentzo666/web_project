<?php 
	$inp = file_get_contents('../data/neural.json');
	$tempArray = json_decode($inp);
	$jsonData = json_encode($tempArray);
	echo $jsonData;
 ?>
