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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<?php
// Include Request and Response classes

require 'constants/header.php';
require 'constants/login-check.php';
//api poziv
if (isset($_POST)) {
    $api_query = 'http://api.openweathermap.org/geo/1.0/direct?q=' . $_POST['city_name'] . '&limit=5&appid=' . $api_key;
    $json_data_api_query = file_get_contents($api_query);


    //dekodovanje json podatka
    $response_data_api_query = json_decode($json_data_api_query);
    if ($response_data_api_query) {
?>
        <div class="content-search">
            <?php
            //https://api.openweathermap.org/data/2.5/weather?lat=46.100376&lon=19.667587&units=metric&appid=317875d9da97449bd31293b89a4d994e
            foreach ($response_data_api_query as $v) {
                $api_ll = 'https://api.openweathermap.org/data/2.5/weather?lat=' . $v->lat . '&lon=' . $v->lon . '&units=metric&appid=317875d9da97449bd31293b89a4d994e';

                $json_data_api_ll = file_get_contents($api_ll);

                $response_data_api_ll = json_decode($json_data_api_ll);
                $flag = $response_data_api_ll->sys->country === 'XK' ? "RS" : $response_data_api_ll->sys->country;

                echo '<form action="city.php" method="post">
            <button class="search-kartica">
                <div class="search-left">
                    <img class="search-w-icon" src="http://openweathermap.org/img/wn/' . $response_data_api_ll->weather[0]->icon . '@4x.png" alt="">
                </div>
                <div class="search-right">
                    <div class="search-right-sys">
                        <img style="margin-right: 10px;" src="https://flagsapi.com/' .  $flag . '/flat/48.png">
                        <h3>' . $v->name . '</h3>
                    </div>

                    <div class="search-right-info">
                        <p class="temp-holder">' . $response_data_api_ll->main->temp . '°C</p>
                        <p>Wind: ' . $response_data_api_ll->wind->speed . 'km/h</p>
                        <p>Visibilty: ' . round($response_data_api_ll->visibility / 1000, 1) . 'km</p>
                    </div>

                    <p class="geo-coords">Geo coords <span>[' . $response_data_api_ll->coord->lat . ', ' . $response_data_api_ll->coord->lon . ']</span></p>
                </div>
                <input name="lon" value="' . $response_data_api_ll->coord->lon . '" hidden>
                <input name="lat" value="' . $response_data_api_ll->coord->lat . '" hidden>

            </button>
        </form>';
            }

            ?>
        </div>
    <?php

    } else {
    ?>

        <div style="display: flex; min-height: 100vh;">
            <img style="margin: 0 auto; object-fit: contain;" id="loadSound" src="img/frogy.jpg" alt="">
            <audio id="frog" src="sounds/frog.mp3"></audio>
            <script>
                document.getElementById('loadSound').onmouseover = function() {
                    document.getElementById('frog').play();

                }
            </script>

        </div>
    <?php
    }
} else {
    ?>

    <div style="display: flex; min-height: 100vh;">
        <img style="margin: 0 auto; object-fit: contain;" id="loadSound" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b2/Andrew_tate_%28cropped%29.jpg/640px-Andrew_tate_%28cropped%29.jpg" alt="">
        <audio id="frog" src="sounds/frog.mp3"></audio>
        <script>
            window.onmouseover = function() {
                document.getElementById('frog').play();

            }
        </script>

    </div>
<?php

}

?>







<?php
require 'constants/footer.php';
?>