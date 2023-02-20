<?php 
	/*$data[] = $_POST['myData'];
	if( $data != null)
	{
		$inp = file_get_contents('neural.json');
		$tempArray = json_decode($inp);
		array_push($tempArray, $data);
		$jsonData = json_encode($tempArray);
		//echo $jsonData;
		$an = $jsonData;
		file_put_contents('neural.json', $an);
	}*/

	function remove_json_row($json, $field, $to_find) {

        for($i = 0, $len = count($json); $i < $len; ++$i) {
            if ($json[$i][$field] == $to_find) {
                array_splice($json, $i, 1); 
            }   
        }   

        return $json;
    }  

	$data = $_POST['myData'];
	$kcheck = $_POST['kcheck'];
	$json = file_get_contents('../data/neural.json');
	
	$decoded = json_decode($json, true);

    $decoded = remove_json_row($decoded, 'std_id', $kcheck);

	$json = json_encode($decoded);
    

	if(strlen($json) > 2){
		$string = ',' . $data; 
	}
	else{
		$string = $data;
	}
	$position = strlen($json) - 1; 
	$out = substr_replace( $json, $string, $position, 0 ); 
	file_put_contents('../data/neural.json', $out);
?>