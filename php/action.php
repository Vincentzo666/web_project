<?php
session_start();
include 'function.php';
$lms = new lms();
if($_POST['action'] == 'delete_invoice' && $_POST['id']) {
	$lms->deleteInvoice($_POST['id']);	
	$jsonResponse = array(
		"status" => 1	
	);
	echo json_encode($jsonResponse);	
}
if($_GET['action'] == 'logout') {
session_unset();
session_destroy();
header("Location:index.php");
}