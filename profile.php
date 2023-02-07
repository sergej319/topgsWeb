<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/constants.css">
    <link rel="stylesheet" href="css/city.css">
    <link rel="stylesheet" href="css/profile.css">
    <title>Cobra Weather</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&700display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<?php require 'constants/header.php';
require 'constants/login-check.php';
$sql = "SELECT * FROM users WHERE username='" . $_SESSION['user'] . "' LIMIT 1";
$res = mysqli_query(databaseConnect(), $sql);
$row = $res->fetch_assoc();

?>





<div class="content-my" id="editProfile">
    <div id="weather">

    </div>
    <div class="profile-card">
        <div class="profile-card-wrapper">
            <div class="profile-card-left">
                <p>First Name: </p>
                <p>Last Name: </p>
                <p>Username: </p>
                <p>Email: </p>
            </div>
            <div class="profile-card-right">
                <p><?php echo $row['fname'] ?></p>
                <p><?php echo $row['lname'] ?></p>
                <p><?php echo $row['email'] ?></p>
                <p><?php echo $row['username'] ?></p>
            </div>



        </div>
        <div class="modal-my hide">
            <div class="modal-header-my">
                <h4>Edit Profile</h4>
                <button id="exit-modal">X</button>
            </div>
            <div class="modal-body-my">
                <form action="updateProfile.php" method="post">
                    <label for="fname">First Name: </label>
                    <input type="text" class="input-modal" id="fname" name="fname" value="<?php echo $row['fname'] ?>">
                    <label for="lname">Last Name: </label>
                    <input type="text" class="input-modal" id="lname" name="lname" value="<?php echo $row['lname'] ?>">
                    <label for="username">Username: </label>
                    <input type="text" class="input-modal" id="username" name="username" value="<?php echo $row['username'] ?>">
                    <label for="email">Email: </label>
                    <input type="text" class="input-modal" id="email" name="email" value="<?php echo $row['email'] ?>">
                    <label for="password">Password: </label>
                    <input type="text" class="input-modal" id="password" name="password">
                    <label for="confirmPassword">Confirm Password: </label>
                    <input type="text" class="input-modal" id="confirmPassword" name="confirmPassword">
                    <label for="newPassword">New Password: </label>
                    <input type="text" class="input-modal" id="newPassword" name="newPassword">
                    <input type="submit" name="submit" class="btn-modal-submit">
                </form>
            </div>
        </div>
        <button id="btn-show-modal">Edit profile</button>


    </div>



    <div class="fav-city-card">

        <h2>Favorite cities</h2>
        <?php
        $sql = "SELECT * FROM favorites WHERE id_user='" . $_SESSION['id_user'] . "'";

        $res = mysqli_query(databaseConnect(), $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id_favorite = $row['id_favorite'];
                $id_city = $row['id_city'];
                $lon = $row['lon'];
                $lat = $row['lat'];
                $city_name = $row['city_name'];
                //Favorites api results
                $api_query_fav = "https://api.openweathermap.org/data/2.5/weather?lat=" . $lat . "&lon=" . $lon . "&units=metric&appid=" . $api_key;
                $json_fav = file_get_contents($api_query_fav);
                $response_fav = json_decode($json_fav);
        ?>
                <form action="formHandler/deleteFavCity.php" class="fav-city-form" method="post">
                    <input type="text" hidden name="id_city" value="<?php echo $id_city; ?>">
                    <p style="width: 30%;"><?php echo $city_name; ?></p>
                    <img src="https://flagsapi.com/<?php echo $response_fav->sys->country;  ?>/flat/48.png">
                    <button style="width: 30%;" class="remove-city">
                        Remove
                    </button>
                </form>

        <?php
            }
        } else {
            echo "<p>You don't have any favorite cities.</p>";
        }


        ?>

    </div>








</div>

<?php



?>
<script>
    document.getElementById('btn-show-modal').addEventListener('click', function() {
        let isOpen = false;
        if (!isOpen) {
            document.querySelector('.modal-my').classList.add('show')
            document.querySelector('.modal-my').classList.remove('hide')
            document.querySelector('.profile-card-wrapper').classList.add('hide')
            document.querySelector('.profile-card-wrapper').classList.remove('show')
            document.getElementById('btn-show-modal').classList.add('hide')
            document.getElementById('btn-show-modal').classList.remove('show')

        } else {
            document.querySelector('.modal-my').classList.add('hide')
            document.querySelector('.modal-my').classList.remove('show')
            document.querySelector('.profile-card-wrapper').classList.add('show')
            document.querySelector('.profile-card-wrapper').classList.remove('hide')
            document.getElementById('btn-show-modal').classList.add('show')
            document.getElementById('btn-show-modal').classList.remove('hide')

        }
    })
    document.getElementById('exit-modal').addEventListener('click', function() {
        document.querySelector('.modal-my').classList.add('hide')
        document.querySelector('.modal-my').classList.remove('show')
        document.querySelector('.profile-card-wrapper').classList.add('show')
        document.querySelector('.profile-card-wrapper').classList.remove('hide')
        document.getElementById('btn-show-modal').classList.add('show')
        document.getElementById('btn-show-modal').classList.remove('hide')

    })


    const api_key = '317875d9da97449bd31293b89a4d994e';
    /*fetch('http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=' + position.coords.latitude + '&lon=' + position.coords.longitude + '&appid=' + api_key)
        .then((response) => response.json())
        .then((data) => data)
*/
    let air = [];
    const api_air = navigator.geolocation.getCurrentPosition(pos => {
        return fetch(`http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=${pos.coords.latitude}&lon=${pos.coords.longitude}&appid=${api_key}`)
            .then((response) => response.json())
            .then((data) => {
                air = data
                return data
            });
    })
    console.log(air)

    navigator.geolocation.getCurrentPosition(position => {
        fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${position.coords.latitude}&lon=${position.coords.longitude}&units=metric&appid=${api_key}`)
            .then(res => {
                if (!res.ok) {
                    throw Error("Weather data not available")
                }
                return res.json()
            })
            .then(data => {
                let wind_deg
                if (data.wind.deg > 337.5 || data.wind.deg < 22.5) {
                    wind_deg = "North";
                } else if (data.wind.deg > 292.5 && data.wind.deg < 337.49) {
                    wind_deg = "North West";
                } else if (data.wind.deg > 247.5 && data.wind.deg < 292.49) {
                    wind_deg = "West";
                } else if (data.wind.deg > 202.5 && data.wind.deg < 247.49) {
                    wind_deg = "South West";
                } else if (data.wind.deg > 157.5 && data.wind.deg < 202.49) {
                    wind_deg = "South";
                } else if (data.wind.deg > 112.5 && data.wind.deg < 157.49) {
                    wind_deg = "South East";
                } else if (data.wind.deg > 67.5 && data.wind.deg < 112.49) {
                    wind_deg = "East";
                } else {
                    wind_deg = "North East";
                }
                let wear;
                console.log(data)

                function getWear(data) {
                    if (data.main.temp > 26) {
                        return 'hot.png'
                    } else if (data.main.feels_like <= 26 && data.main.feels_like >= 16) {
                        return 'spring.png'
                    } else {
                        return 'winter.png'
                    }
                }
                const iconUrl = `http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`
                document.getElementById("weather").innerHTML = `
                <div class="kartica">
                <div class="kartica-head">
                    <img src="https://flagsapi.com/${data.sys.country === 'XK' ? 'RS' :  data.sys.country}/flat/48.png">
                    <h4>${data.name}</h4>
                </div>
                <div class="kartica-body">
                    <div class="kartica-temp-holder">
                        <img src="http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="">
                        <h3>${data.main.temp}°C</h3>
                        <p>(feels like: ${data.main.feels_like} °C)</p>

                    </div>
                    <div class="holder-parent">
                        <div class="kartica-left-holder">
                            <p class="weather-holder-desc">${data.weather[0].description}</p>
                            <p>Wind: ${wind_deg + " - " + data.wind.speed + "km/h"}</p>
                            
                            <p>Humidity: ${data.main.humidity}%</p>

                        </div>
                        <div class="kartica-middle-holder">
                            <img src="img/${getWear(data)}" width="50px">
                            ${data.weather[0].description == 'rain' || data.clouds.all > 45 ? `<img src="img/rain.png" width="50px">` : ''}
                        </div>
                        <div class="kartica-right-holder">
                            <p>Clouds: ${data.clouds.all} %</p>
                            <p>Visibilty: ${data.visibility / 1000}  km</p>
                            <p>Pressure: ${data.main.pressure} hPa</p>
                        </div>
                    </div>

                </div>

            </div>
            `
            })
            .catch(err => console.error(err))
    });
</script>
<?php require 'constants/footer.php'; ?>