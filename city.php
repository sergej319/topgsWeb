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
require 'constants/login-check.php';


if (isset($_POST)) {

    

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

    $sql = "SELECT * FROM favorites WHERE id_city='".$response->id."' AND id_user='" . $_SESSION['id_user'] . "'";
    $res = mysqli_query(databaseConnect(), $sql);
    $row = $res->fetch_assoc();
    //var_dump($response);
?>
    <div class="content-my">
        <?php
        if(isset($_SESSION['saved_city'])){
            echo "<p style='color: red; width: 100%; font-size: 20px; text-align: center;'>".$_SESSION['saved_city']."</p>";
            unset($_SESSION['saved_city']);
        }
        
        ?>
        <div class="city-info">
            <div class="kartica">
                <div class="kartica-head">
                    <img src="https://flagsapi.com/<?php echo $response->sys->country === 'XK' ? 'RS' :  $response->sys->country; ?>/flat/48.png">
                    <h4><?php echo $response->name; ?></h4>
                    <form action="" method="post">
                        <input type="text" hidden value="<?php echo $response->id ?>" name="id_favourites">
                        <input type="text" hidden value="<?php echo $_SESSION['id_user']; ?>" name="id_user">
                        <input type="text" hidden value="<?php echo $response->name; ?>" name="city_name">
                        <input type="text" hidden value="<?php echo $response->sys->country; ?>" name="country">
                        <input type="text" hidden value="<?php echo $response->coord->lon; ?>" name="lon">
                        <input type="text" hidden value="<?php echo $response->coord->lat; ?>" name="lat">
                        
                            <?php 
                            if(empty($row) || $row < 1 || $row == false){
                                echo '
                                <button type="submit" name="submit" class="btn-book">
                                    <img class="book" src="img/bookmark-star.svg" alt="">
                                </button>';
                            }else{
                                    echo '
                                    <button type="submit" name="cancel" class="btn-book">
                                        <img class="book" src="img/bookmark-star-fill.svg" alt="">
                                    </button>';
                                }
                             ?>
                            
                        
                    </form>

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
                                <p>' . date('H:i', $response_days->list[$i]->dt) . '</p>
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
                if (!empty($response_days->list[$i + 4])) {
                    if ($res_days_arr[1] === '09:00:00') {

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
            for ($i = 0; $i < count($day); $i += 4) {
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
                $min_temp_values = [];
                for ($h = $i; $h < $helper_temp + 4; $h++) {
                    $min_temp_values[$h] = $day[$h]->main->temp_min;
                }

                $max_temp_values = [];
                for ($f = $i; $f < $helper_temp + 4; $f++) {
                    $max_temp_values[$f] = $day[$f]->main->temp_max;
                }

                echo '<div class="dropdown-my">
                    <p class="dropdown-day">' . date('l', $day[$i + 1]->dt) . '</p>
                    <img src="http://openweathermap.org/img/wn/' . $day[$i + 1]->weather[0]->icon . '@2x.png" alt="" width="64px">
                    <p class="dropdown-temp">' . min($min_temp_values) . ' / ' . max($max_temp_values) . '°C</p>
                    <p class="dropdown-desc" style="text-transform: capitalize;">' . $day[$i + 1]->weather[0]->description . '</p>
                    <div class="dropdown-icon-holder" id="dp' . $helper . '">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-caret-down-square" viewBox="0 0 16 16">
                            <path d="M3.626 6.832A.5.5 0 0 1 4 6h8a.5.5 0 0 1 .374.832l-4 4.5a.5.5 0 0 1-.748 0l-4-4.5z" />
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 0a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2z" />
                        </svg>
                    </div>
                </div>
                <div class="dropdown-my-info hide" id="dropdown-my-info-' . $helper . '">
                    <div class="main-info">
                        <p>Humidity: ' . $day[$i + 1]->main->humidity . '%</p>
                        <p>Wind: ' . $wind_deg_day . ' ' . $day[$i + 1]->wind->speed . 'km/h</p>
                        <p>Visibility: ' . round($day[$i + 1]->visibility / 1000, 2) . 'km</p>
                        <p>Pressure: ' . $day[$i + 1]->main->pressure . 'hPa</p>
                    </div>
                    <hr>
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
                for ($k = $helper_temp; $k < $helper_temp + 4; $k++) {
                    echo '<td>' . $day[$k]->main->temp . '°C</td>';
                }

                echo '</tr>';
                echo '<tr>
                                <td>Feels like</td>';
                for ($o = $helper_temp; $o < $helper_temp + 4; $o++) {
                    echo '<td>' . $day[$o]->main->feels_like . '°C</td>';
                }
                echo '</tr>
                        </table>
                    </div>
                </div>';
                $helper++;
                $helper_temp += 4;
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
    <div style="min-height: 80vh;" class="content-my">
        <p style="font-size: 50px;">404: You haven't clicked on a city...</p>
    </div>

<?php

}




?>

<script>
    //https://api.openweathermap.org/data/2.5/forecast?lat=" . $_POST['lat'] . "&lon=" . $_POST['lon'] . "&units=metric&appid=" . $api_key

    fetch('https://api.openweathermap.org/data/2.5/forecast?lat=40.416775&lon=-3.703790&units=metric&appid=<?php echo $api_key ?>')
        .then((response) => response.json())
        .then((data) => console.log(data));

    fetch('https://api.openweathermap.org/data/2.5/weather?lat=40.416775&lon=3.703790&units=metric&appid=317875d9da97449bd31293b89a4d994e')
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
if (isset($_POST['submit'])) {

    $id_user = $_POST['id_user'];
    $id_city = $_POST['id_favourites'];
    $city_name = $_POST['city_name'];
    $lon = $_POST['lon'];
    $lat = $_POST['lat'];

    

    $sql = "SELECT * FROM favorites WHERE id_city='$id_city' AND id_user='".$_SESSION['id_user']."'";
    $res = mysqli_query(databaseConnect(), $sql);
    $row = $res->fetch_assoc();

    if(!empty($row)){

        $_SESSION['saved_city'] = "This city has already been saved";
    


    }
    else{

        $sql1 = "INSERT INTO favorites (id_city, id_user, lon, lat, city_name) VALUES ('$id_city','$id_user', '$lon', '$lat', '$city_name')";
        mysqli_query(databaseConnect(), $sql1);
    
    }

} else if (isset($_POST['cancel'])) {

    $sql3 = "DELETE FROM favorites WHERE id_city='".$response->id."' AND id_user='".$_SESSION['id_user']."'";
    mysqli_query(databaseConnect(), $sql3);

}

?>