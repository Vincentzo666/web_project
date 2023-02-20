<?php

    function remove_json_row($json, $field, $to_find) {

        for($i = 0, $len = count($json); $i < $len; ++$i) {
            if ($json[$i][$field] === $to_find) {
                array_splice($json, $i, 1); 
            }   
        }   

        return $json;
    }   

    $animals =
'{
"0":{"kind":"mammal","name":"Pussy the Cat","weight":"12kg","age":"5"},
"1":{"kind":"mammal","name":"Roxy the Dog","weight":"25kg","age":"8"},
"2":{"kind":"fish","name":"Piranha the Fish","weight":"1kg","age":"1"},
"3":{"kind":"bird","name":"Einstein the Parrot","weight":"0.5kg","age":"4"}
}';

    $decoded = json_decode($animals, true);

    print_r($decoded);

    $decoded = remove_json_row($decoded, 'name', 'Roxy the Dog');

    print_r($decoded);

?>