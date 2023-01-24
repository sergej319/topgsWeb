<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/constants.css">
    <link rel="stylesheet" href="css/search.css">
    <title>Cobra Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
</head>
<?php
// Include Request and Response classes
$api_key = '317875d9da97449bd31293b89a4d994e';
$api_key_ll = '64e5fb699662dc84e676bd476a18417f';

//api poziv
$api_query = 'http://api.openweathermap.org/geo/1.0/direct?q=' . $_POST['city_name'] . '&limit=5&appid=' . $api_key;
$json_data_api_query = file_get_contents($api_query);


//dekodovanje json podatka
$response_data_api_query = json_decode($json_data_api_query);



//smestanje u varijable neophodne podatke
$city_lat = $response_data_api_query[0]->lat;
$city_lon = $response_data_api_query[0]->lon;

// https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=44.0127932&lon=20.9114225&units=metric
//poziv novom api-ju sa lon i lat podacima
//$api_ll = 'https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=' . $city_lat . '&lon=' . $city_lon . '&units=metric';
//$json_data_api_ll = file_get_contents($api_ll);


//dekodovanje json podataka
//$response_data_api_ll = json_decode($json_data_api_ll);

//var_dump($response_data_api_query);
/*var_dump($response_data_api_query);
var_dump($response_data_api_ll);*/
// All user data exists in 'data' object
//$user_data = $response_data->data;

// Cut long data into small & select only first 10 records
//$user_data = array_slice($user_data, 0, 9);

// Print data if need to debug
//print_r($user_data);

// Traverse array and display user data


require 'constants/header.php';
?>
<div class="content-my">
    <?php
    foreach ($response_data_api_query as $v) {
        $api_ll = 'https://apis.scrimba.com/openweathermap/data/2.5/weather?lat=' . $v->lat . '&lon=' . $v->lon . '&units=metric';

        $json_data_api_ll = file_get_contents($api_ll);

        $response_data_api_ll = json_decode($json_data_api_ll);

        echo
        '<div class="card" style="width: 18rem; background-color: #222")">
        <div class="card-body">
            <h5 id="name-query" class="card-title">' . $v->name . '</h5>
        </div>
        <ul class="list-group list-group-flush">
            <li id="temperature-query" class="list-group-item">Temperature: ' . $response_data_api_ll->main->temp . '</li>
            <li id="country-query" class="list-group-item">Country: ' . $response_data_api_ll->sys->country . '</li>
            <li id="humidity-query" class="list-group-item">Humidity: ' . $response_data_api_ll->main->humidity . '</li>
            <div class="card-body"></div>
        </ul>
    </div>';
    }






    ?>
</div>
<?php





require 'constants/footer.php';
?>