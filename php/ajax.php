<?php
include("function.php");
$lms = new lms();

	// if(isset($_POST['path'])&&isset($_POST['image'])){
	// 	$path = $_POST['path'];
	// 	$img = $_POST['image'];

	// 	mkdir('../data/users/' . $path, 0777, true);

	// 	define('orig_dir', '../data/users/' . $path . '/');
	// 	$img = str_replace('data:image/png;base64,', '', $img);
	// 	$img = str_replace(' ', '+', $img);
	// 	$data = base64_decode($img);
	// 	// Save image to data/original directory
	// 	$fi = new FilesystemIterator(orig_dir, FilesystemIterator::SKIP_DOTS);
	// 	$file = orig_dir . 'image' . iterator_count($fi). '.png';
	// 	$success = file_put_contents($file, $data);
	// 	print $success ? $file : 'Unable to save the file in image directory.';
	// }

	if(isset($_POST['stdview'])){
		$id = $_POST['stdview'];
		$show_std = $lms->select('student',"*","id='$id'");

		if($show_std){ 
		   
			echo json_encode(array('success' => 1, 
			'result1'=>$show_std[0]['std_pic'],
			'result2'=>$show_std[0]['std_id'],
			'result3'=>$show_std[0]['prefix'],
			'result4'=>$show_std[0]['fname'],
			'result5'=>$show_std[0]['lname'],
			'result6'=>$show_std[0]['email'],
			'result7'=>$show_std[0]['phone']
		));
			
		}else{
			echo json_encode(array('success' => 2));
		}
		
	}else {
		echo json_encode(array('success' => 0));
	}
?>