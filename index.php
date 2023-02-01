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
require "config/config.php";
require "config/functions.php";
require 'api_data/api_index.php';




?>
<div class="content-my">
    <?php
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

</div>

<?php require 'constants/footer.php'; ?>