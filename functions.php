<?php 

include "Class_Publication.php";
include "publications_data.php";

function get_pubs ($request, $publications) { 

    $pub_data = [];

    $pub_num = 0;

    foreach($request as $key => $value) {
    
    //Check format of key
        if($key == "pub".$pub_num) {            
            
            $pub_found = false;

            // sanitize params
            $value = strip_tags($value);
            $value = htmlspecialchars($value);

            foreach($publications as $outlet => $data) {
                if($value == $outlet) {
                    array_push($pub_data, $data);
                    $pub_found = true;
                    break;
                }
            }

            if($pub_found != true) {
                array_push($pub_data, ["Could not find publication " . $value]);
            }
            $pub_num++;
        }
        elseif($key == "art-num" && $value !== 5) {
        $num_articles = $value;
        }
        else {
        array_push($pub_data, ["Error: cannot retrieve publication" . $value]);
        };
    }
    return $pub_data;
}
?>