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
        <div class="city-info">
            <div class="kartica">
                <div class="kartica-head">
                    <img src="https://flagsapi.com/<?php echo $response->sys->country === 'XK' ? 'RS' :  $response->sys->country; ?>/flat/48.png">
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
                            <p>Visibilty: <?php echo round($response->visibility / 1000, 2)  ?>km</p>
                            <p>Pressure: <?php echo $response->main->pressure ?>hPa</p>
                        </div>
                    </div>

                </div>

            </div>

            <div class="hourly-table-wrapper">

                <h2>Hourly Forecast</h2>
                <div class="hourly-table">
                    <?php
                    //var_dump($response_days);
                    for ($i = 0; $i < 5; $i++) {

                        $date_time =  explode(" ", $response_days->list[$i]->dt_txt);
                        echo '<div class="time">
                                <p>' . $date_time[1] . '</p>
                                <img width="100%" src="http://openweathermap.org/img/wn/' . $response_days->list[$i]->weather[0]->icon . '@2x.png" alt="">
                                <p>' . $response_days->list[$i]->main->temp . '°C</p>
                            </div>';
                    }

                    ?>
                </div>
            </div>


        </div>
        <div class="dropdown-my-wrapper">
            <?php
            $day = [];
            $count = 0;
            $dayCount = 0;
            for ($i = 0; $i < count($response_days->list); $i++) {

                $res_days_arr = explode(' ', $response_days->list[$i]->dt_txt);

                if ($res_days_arr[1] === '09:00:00') {
                    if ($response_days->list[$i + 4]) {
                        $day[$count] = $response_days->list[$i];
                        $count++;
                        $day[$count] = $response_days->list[$i + 2];
                        $count++;
                        $day[$count] = $response_days->list[$i + 3];
                        $count++;
                        $day[$count] = $response_days->list[$i + 4];
                        $count++;
                        $dayCount++;
                    }
                }
            }



            ?>
            <h2><?php echo $dayCount ?> day forecast</h2>






            <?php 
            $helper = 0;
            $helper_temp = 0;
            for($i = 1; $i<count($day); $i+=4){
                if ($day[$i]->wind->deg > 337.5 || $day[$i]->wind->deg < 22.5) {
                    $wind_deg_day = "North";
                } elseif ($day[$i]->wind->deg > 292.5 && $day[$i]->wind->deg < 337.49) {
                    $wind_deg_day = "North West";
                } elseif ($day[$i]->wind->deg > 247.5 && $day[$i]->wind->deg < 292.49) {
                    $wind_deg_day = "West";
                } elseif ($day[$i]->wind->deg > 202.5 && $day[$i]->wind->deg < 247.49) {
                    $wind_deg_day = "South West";
                } elseif ($day[$i]->wind->deg > 157.5 && $day[$i]->wind->deg < 202.49) {
                    $wind_deg_day = "South";
                } elseif ($day[$i]->wind->deg > 112.5 && $day[$i]->wind->deg < 157.49) {
                    $wind_deg_day = "South East";
                } elseif ($day[$i]->wind->deg > 67.5 && $day[$i]->wind->deg < 112.49) {
                    $wind_deg_day = "East";
                } else {
                    $wind_deg_day = "North East";
                }

                echo '<div class="dropdown-my">
                    <p class="dropdown-day">'.$day[$i]->dt_txt.'</p>
                    <img src="http://openweathermap.org/img/wn/'.$day[$i]->weather[0]->icon .'@2x.png" alt="" width="64px">
                    <p class="dropdown-temp">'.$day[$i]->main->temp_min . ' / '. $day[$i]->main->temp_max.'°C</p>
                    <p style="text-transform: capitalize;">'.$day[$i]->weather[0]->description.'</p>
                    <div class="dropdown-icon-holder" id="dp'.$helper.'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-down-square" viewBox="0 0 16 16">
                            <path d="M3.626 6.832A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5z" />
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2z" />
                        </svg>
                    </div>
                </div>
                <div class="dropdown-my-info hide" id="dropdown-my-info-'.$helper.'">
                    <div class="main-info">
                        <p>Humidity: '.$day[$i]->main->humidity.'%</p>
                        <p>Wind: '.$wind_deg_day.' '.$day[$i]->wind->speed.'km/h</p>
                        <p>Visibility: '.round($day[$i]->visibility / 1000, 2).'km</p>
                        <p>Pressure: '.$day[$i]->main->pressure.'hPa</p>
                    </div>
                    <div class="temp-info">
                        <table>
                            <tr>
                                <td></td>
                                <td>Morning</td>
                                <td>Afternoon</td>
                                <td>Evening</td>
                                <td>Night</td>
                            </tr>

                            <tr>
                                <td>Temperature</td>';
                            for($k = $helper_temp; $k < $helper_temp+4; $k++){echo '<td>'.$day[$k]->main->temp.'°C</td>';} 
                                
                            echo '</tr>';
                            echo '<tr>
                                <td>Feels like</td>';
                            for($o = $helper_temp; $o < $helper_temp+4; $o++){echo '<td>'.$day[$o]->main->feels_like.'°C</td>';}
                            echo '</tr>
                        </table>
                    </div>
                </div>';
                $helper++;
                $helper_temp+=4;
                
        }
?>

                    </table>
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

<script>
    //https://api.openweathermap.org/data/2.5/forecast?lat=" . $_POST['lat'] . "&lon=" . $_POST['lon'] . "&units=metric&appid=" . $api_key

    fetch('https://api.openweathermap.org/data/2.5/forecast?lat=40.416775&lon=-3.703790&units=metric&appid=<?php echo $api_key ?>')
        .then((response) => response.json())
        .then((data) => console.log(data));
    const dp0 = document.getElementById('dropdown-my-info-0')
    const dp1 = document.getElementById('dropdown-my-info-1')
    const dp2 = document.getElementById('dropdown-my-info-2')
    const dp3 = document.getElementById('dropdown-my-info-3')
    const dp4 = document.getElementById('dropdown-my-info-4')
    let isOpen = {
        dp0: false,
        dp1: false,
        dp2: false,
        dp3: false,
        dp4: false,
    }
    document.getElementById('dp0').addEventListener('click', function() {


        if (!isOpen['dp0']) {
            dp0.classList.remove('hide')
            dp0.classList.add('show')
            isOpen['dp0'] = true
        } else {
            dp0.classList.remove('show')
            dp0.classList.add('hide')
            isOpen['dp0'] = false
        }

    })

    document.getElementById('dp1').addEventListener('click', function() {


        if (!isOpen['dp1']) {
            dp1.classList.remove('hide')
            dp1.classList.add('show')
            isOpen['dp1'] = true
        } else {
            dp1.classList.remove('show')
            dp1.classList.add('hide')
            isOpen['dp1'] = false
        }

    })

    document.getElementById('dp2').addEventListener('click', function() {


        if (!isOpen['dp2']) {
            dp2.classList.remove('hide')
            dp2.classList.add('show')
            isOpen['dp2'] = true
        } else {
            dp2.classList.remove('show')
            dp2.classList.add('hide')
            isOpen['dp2'] = false
        }

    })

    document.getElementById('dp3').addEventListener('click', function() {


        if (!isOpen['dp3']) {
            dp3.classList.remove('hide')
            dp3.classList.add('show')
            isOpen['dp3'] = true
        } else {
            dp3.classList.remove('show')
            dp3.classList.add('hide')
            isOpen['dp3'] = false
        }

    })

    document.getElementById('dp4').addEventListener('click', function() {


        if (!isOpen['dp4']) {
            dp4.classList.remove('hide')
            dp4.classList.add('show')
            isOpen['dp4'] = true
        } else {
            dp4.classList.remove('show')
            dp4.classList.add('hide')
            isOpen['dp4'] = false
        }

    })
</script>
<?php

require 'constants/footer.php';

?>