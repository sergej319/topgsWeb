<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/constants.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Cobra Weather</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
</head>

<?php
require 'constants/header.php';
require 'api_data/api_index.php';

?>
<div class="content-my">
    <?php
    //http://localhost/api_test2/api/post/read.php

   
    
    ?>
    <?php if (isset($_SESSION['user'])) {

        $testingApi = "http://localhost/api_test2/api/post/read.php";
        $json = file_get_contents($testingApi);
        $responseJSON = json_decode($json);

        if(count($responseJSON) > 0){
        foreach($responseJSON as $rj){

            $api_query_fav = "https://api.openweathermap.org/data/2.5/weather?lat=".$rj->lat."&lon=".$rj->lon."&units=metric&appid=" . $api_key;
            $json_fav = file_get_contents($api_query_fav);
            $response_fav = json_decode($json_fav);

            //Favorites Air Pollution
            $api_query_air_fav = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=".$rj->lat."&lon=".$rj->lon."&appid=" . $api_key;
            $json_air_fav = file_get_contents($api_query_air_fav);
            $response_air_fav = json_decode($json_air_fav);
            if($_SESSION['id_user'] == $rj->id_user){
            echo '
            <form action="city.php" method="post">
                    <button class="no-style-btn">
                        <div id="kartica-su" class="kartica">
                            <div class="kartica-head">
                                <h4>'.$response_fav->name .'</h4>
                                <h4>'.$response_fav->sys->country.' </h4>
                                <img src="https://flagsapi.com/'.$response_fav->sys->country.'/flat/48.png">
                            </div>
                            <div class="kartica-body">
                                <div class="kartica-temp-holder">
                                    <img src="http://openweathermap.org/img/wn/'.$response_fav->weather[0]->icon.'@2x.png" alt="">
                                    <p>'.round($response_fav->main->temp) .'° C</p>
                                </div>

                                <p>Air Quality: '.getAirQuality($response_air_fav) .'</p>
                                <p>Humidity: '.$response_fav->main->humidity .'%</p>
                                <p>Visibilty: '.$response_fav->visibility / 1000 .'  km</p>
                                <input type="text" value="'.$response_fav->coord->lon.'" name="lon" hidden>
                                <input type="text" value="'.$response_fav->coord->lat.'" name="lat" hidden>
                            </div>

                        </div>
                    </button>
                </form>
            ';}

        }
        
        }else{?>
            <div style="min-height: 70vh; display: flex; align-items: center; justify-content: center;"><p style="font-size: 36px;">You haven't added any favorites yet.</p></div>
            <?php
        }
    ?>

        

    <?php
    } else {
    ?>
        <!--Belgrade Card -->
        <form action="city.php" method="post">
            <button class="no-style-btn">
                <div id="kartica-su" class="kartica">
                    <div class="kartica-head">
                        <h4>Belgrade,</h4>
                        <h4><?php echo $response_bg->sys->country ?></h4>
                        <img src="https://flagsapi.com/<?php echo $response_bg->sys->country ?>/flat/48.png">
                    </div>
                    <div class="kartica-body">
                        <div class="kartica-temp-holder">
                            <img src="http://openweathermap.org/img/wn/<?php echo $response_bg->weather[0]->icon ?>@2x.png" alt="">
                            <p><?php echo round($response_bg->main->temp) ?>° C</p>
                        </div>

                        <p>Air Quality: <?php echo getAirQuality($response_air_bg) ?></p>
                        <p>Humidity: <?php echo $response_bg->main->humidity ?>%</p>
                        <p>Visibilty: <?php echo $response_bg->visibility / 1000  ?>km</p>
                        <input type="text" value="<?php echo $response_bg->coord->lon; ?>" name="lon" hidden>
                        <input type="text" value="<?php echo $response_bg->coord->lat; ?>" name="lat" hidden>
                    </div>

                </div>
            </button>
        </form>



        <!--London Card -->
        <form action="city.php" method="post">
            <button class="no-style-btn">
                <div id="kartica-su" class="kartica">
                    <div class="kartica-head">
                        <h4>London,</h4>
                        <h4><?php echo $response_ld->sys->country ?></h4>
                        <img src="https://flagsapi.com/<?php echo $response_ld->sys->country ?>/flat/48.png">
                    </div>
                    <div class="kartica-body">
                        <div class="kartica-temp-holder">
                            <img src="http://openweathermap.org/img/wn/<?php echo $response_ld->weather[0]->icon ?>@2x.png" alt="">
                            <p><?php echo round($response_ld->main->temp) ?>° C</p>
                        </div>

                        <p>Air Quality: <?php echo getAirQuality($response_air_ld) ?></p>
                        <p>Humidity: <?php echo $response_ld->main->humidity ?>%</p>
                        <p>Visibilty: <?php echo $response_ld->visibility / 1000  ?>km</p>
                        <input type="text" value="<?php echo $response_ld->coord->lon; ?>" name="lon" hidden>
                        <input type="text" value="<?php echo $response_ld->coord->lat; ?>" name="lat" hidden>

                    </div>

                </div>
            </button>
        </form>

        <!--Madrid Card -->
        <form action="city.php" method="post">
            <button class="no-style-btn">
                <div id="kartica-su" class="kartica">
                    <div class="kartica-head">
                        <h4>Madrid,</h4>
                        <h4><?php echo $response_md->sys->country ?></h4>
                        <img src="https://flagsapi.com/<?php echo $response_md->sys->country ?>/flat/48.png">
                    </div>
                    <div class="kartica-body">
                        <div class="kartica-temp-holder">
                            <img src="http://openweathermap.org/img/wn/<?php echo $response_md->weather[0]->icon ?>@2x.png" alt="">
                            <p><?php echo round($response_md->main->temp) ?>° C</p>
                        </div>

                        <p>Air Quality: <?php echo getAirQuality($response_air_md) ?></p>
                        <p>Humidity: <?php echo $response_md->main->humidity ?>%</p>
                        <p>Visibilty: <?php echo $response_md->visibility / 1000  ?>km</p>
                        <input type="text" value="<?php echo $response_md->coord->lon; ?>" name="lon" hidden>
                        <input type="text" value="<?php echo $response_md->coord->lat; ?>" name="lat" hidden>

                    </div>

                </div>
            </button>
        </form>

        <!--Washington Card -->
        <form action="city.php" method="post">
            <button class="no-style-btn">
                <div id="kartica-su" class="kartica">
                    <div class="kartica-head">
                        <h4>Washington,</h4>
                        <h4><?php echo $response_w->sys->country ?></h4>
                        <img src="https://flagsapi.com/<?php echo $response_w->sys->country ?>/flat/48.png">
                    </div>
                    <div class="kartica-body">
                        <div class="kartica-temp-holder">
                            <img src="http://openweathermap.org/img/wn/<?php echo $response_w->weather[0]->icon ?>@2x.png" alt="">
                            <p><?php echo round($response_w->main->temp) ?>° C</p>
                        </div>

                        <p>Air Quality: <?php echo getAirQuality($response_air_w) ?></p>
                        <p>Humidity: <?php echo $response_w->main->humidity ?>%</p>
                        <p>Visibilty: <?php echo $response_w->visibility / 1000  ?>km</p>
                        <input type="text" value="<?php echo $response_w->coord->lon; ?>" name="lon" hidden>
                        <input type="text" value="<?php echo $response_w->coord->lat; ?>" name="lat" hidden>

                    </div>

                </div>
            </button>
        </form>

        <!--Moscow Card -->
        <form action="city.php" method="post">
            <button class="no-style-btn">
                <div id="kartica-su" class="kartica">
                    <div class="kartica-head">
                        <h4>Moscow,</h4>
                        <h4><?php echo $response_m->sys->country ?></h4>
                        <img src="https://flagsapi.com/<?php echo $response_m->sys->country ?>/flat/48.png">
                    </div>
                    <div class="kartica-body">
                        <div class="kartica-temp-holder">
                            <img src="http://openweathermap.org/img/wn/<?php echo $response_m->weather[0]->icon ?>@2x.png" alt="">
                            <p><?php echo round($response_m->main->temp) ?>° C</p>
                        </div>

                        <p>Air Quality: <?php echo getAirQuality($response_air_m) ?></p>
                        <p>Humidity: <?php echo $response_m->main->humidity ?>%</p>
                        <p>Visibilty: <?php echo $response_m->visibility / 1000  ?>km</p>
                        <input type="text" value="<?php echo $response_m->coord->lon; ?>" name="lon" hidden>
                        <input type="text" value="<?php echo $response_m->coord->lat; ?>" name="lat" hidden>

                    </div>

                </div>
            </button>
        </form>
    <?php } ?>
</div>

<?php require 'constants/footer.php'; ?>