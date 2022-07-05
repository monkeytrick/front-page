<?php

include "functions.php";

$pub_request = get_pubs($_GET, $publications);

// Set number of articles
if(isset($_GET["art-num"]) && $_GET["art-num"] !== 5) {
    $num_articles = $_GET["art-num"];
  } 
else {
    $num_articles = 5;
  }

// Retrieves publication data
$results = [];

foreach($pub_request as $outlet){
  
    $newspaper = [];
    $newspaper['name'] = $outlet->pub_name;
    $newspaper['url'] = $outlet->site_url;

    $stories = $outlet->get_articles($num_articles);

    // Check for error message. Create error message if present
    if(array_key_exists('error', $stories)) {
        $newspaper['error'] = $stories['error'];
    }
    // If no error, push articles
    else {    
        $newspaper['articles'] = [];
        foreach($stories as $story) {
                array_push($newspaper['articles'], $story['headline']);
        }
    }
    
    array_push($results, $newspaper);
}

echo json_encode($results, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

?>