<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/constants.css">
    <link rel="stylesheet" href="css/city.css">
    <title>Cobra Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
</head>
<?php
require 'constants/header.php';
require "config/config.php";
require "config/functions.php";
if ($_POST) {
    //City Air Pollution
    $api_query_air = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=" . $_POST['lat'] . "&lon=" . $_POST['lon'] . "&appid=" . $api_key;
    $json_air = file_get_contents($api_query_air);
    $response_air = json_decode($json_air);

    //City api results
    $api_query = "https://api.openweathermap.org/data/2.5/weather?lat=" . $_POST['lat'] . "&lon=" . $_POST['lon'] . "&units=metric&appid=" . $api_key;
    $json = file_get_contents($api_query);
    $response = json_decode($json);

    //5 day api results
    $api_query_days = "https://api.openweathermap.org/data/2.5/forecast?lat=" . $_POST['lat'] . "&lon=" . $_POST['lon'] . "&units=metric&appid=" . $api_key;
    $json_days = file_get_contents($api_query_days);
    $response_days = json_decode($json_days);

    //var_dump($response);
?>
    <div class="content-my">
        <div class="kartica">
            <div class="kartica-head">
                <img src="https://flagsapi.com/<?php echo $response->sys->country ?>/flat/48.png">
                <h4><?php echo $response->name; ?></h4>

            </div>
            <div class="kartica-body">
                <div class="kartica-temp-holder">
                    <img src="http://openweathermap.org/img/wn/<?php echo $response->weather[0]->icon ?>@2x.png" alt="">
                    <h3><?php echo $response->main->temp ?>°C</h3>
                    <p>(feels like: <?php echo $response->main->feels_like; ?>°C)</p>

                </div>
                <div class="holder-parent">
                    <div class="kartica-left-holder">
                        <p class="weather-holder-desc"><?php echo $response->weather[0]->description; ?></p>
                        <p>Wind: <?php
                                    if ($response->wind->deg > 337.5 || $response->wind->deg < 22.5) {
                                        $wind_deg = "North";
                                    } elseif ($response->wind->deg > 292.5 && $response->wind->deg < 337.49) {
                                        $wind_deg = "North West";
                                    } elseif ($response->wind->deg > 247.5 && $response->wind->deg < 292.49) {
                                        $wind_deg = "West";
                                    } elseif ($response->wind->deg > 202.5 && $response->wind->deg < 247.49) {
                                        $wind_deg = "South West";
                                    } elseif ($response->wind->deg > 157.5 && $response->wind->deg < 202.49) {
                                        $wind_deg = "South";
                                    } elseif ($response->wind->deg > 112.5 && $response->wind->deg < 157.49) {
                                        $wind_deg = "South East";
                                    } elseif ($response->wind->deg > 67.5 && $response->wind->deg < 112.49) {
                                        $wind_deg = "East";
                                    } else {
                                        $wind_deg = "North East";
                                    }

                                    echo $wind_deg . " - " . $response->wind->speed . "km/h"
                                    ?></p>
                        <p>Air Quality: <?php echo getAirQuality($response_air) ?></p>
                        <p>Humidity: <?php echo $response->main->humidity ?>%</p>

                    </div>
                    <div class="kartica-right-holder">
                        <p>Clouds: <?php echo $response->clouds->all; ?>%</p>
                        <p>Humidity: <?php echo $response->main->humidity ?>%</p>
                        <p>Visibilty: <?php echo round($response->visibility / 1000, 2)  ?>km</p>
                        <p>Pressure: <?php echo $response->main->pressure ?>hPa</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

<?php
} else {
?>
    <div class="content-my">
        <p>FUCK YOU</p>
    </div>

<?php

}




?>


<?php
require 'constants/footer.php';

?>