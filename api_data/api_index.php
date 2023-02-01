<?php 
//Beograd Air Pollution
$api_query_air_bg = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=44.787197&lon=20.457273&appid=" . $api_key;
$json_air_bg = file_get_contents($api_query_air_bg);
$response_air_bg = json_decode($json_air_bg);

//Beograd api results
$api_query_bg = "https://api.openweathermap.org/data/2.5/weather?lat=44.787197&lon=20.457273&units=metric&appid=" . $api_key;
$json_bg = file_get_contents($api_query_bg);
$response_bg = json_decode($json_bg);



//London Air Pollution
$api_query_air_ld = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=51.509865&lon=-0.118092&appid=" . $api_key;
$json_air_ld = file_get_contents($api_query_air_ld);
$response_air_ld = json_decode($json_air_ld);

//London api results
$api_query_ld = "https://api.openweathermap.org/data/2.5/weather?lat=51.509865&lon=-0.118092&units=metric&appid=" . $api_key;
$json_ld = file_get_contents($api_query_ld);
$response_ld = json_decode($json_ld);



//Madrid Air Pollution
$api_query_air_md = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=40.416775&lon=-3.703790&appid=" . $api_key;
$json_air_md = file_get_contents($api_query_air_md);
$response_air_md = json_decode($json_air_md);

//Madrid api results
$api_query_md = "https://api.openweathermap.org/data/2.5/weather?lat=40.416775&lon=-3.703790&units=metric&appid=" . $api_key;
$json_md = file_get_contents($api_query_md);
$response_md = json_decode($json_md);


//Washington Air Pollution
$api_query_air_w = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=47.751076&lon=-120.740135&appid=" . $api_key;
$json_air_w = file_get_contents($api_query_air_w);
$response_air_w = json_decode($json_air_w);

//Washington api results
$api_query_w = "https://api.openweathermap.org/data/2.5/weather?lat=47.751076&lon=-120.740135&units=metric&appid=" . $api_key;
$json_w = file_get_contents($api_query_w);
$response_w = json_decode($json_w);


//Moscow Air Pollution
$api_query_air_m = "http://api.openweathermap.org/data/2.5/air_pollution/forecast?lat=55.751244&lon=37.618423&appid=" . $api_key;
$json_air_m = file_get_contents($api_query_air_m);
$response_air_m = json_decode($json_air_m);

//Moscow api results
$api_query_m = "https://api.openweathermap.org/data/2.5/weather?lat=55.751244&lon=37.618423&units=metric&appid=" . $api_key;
$json_m = file_get_contents($api_query_m);
$response_m = json_decode($json_m);


?>