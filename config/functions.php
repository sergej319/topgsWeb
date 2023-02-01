<?php
function getAirQuality($response_data_api_query)
{
    switch ($response_data_api_query->list[0]->main->aqi) {
        case 1:
            return "<span style='color: #70e000'>Good</span>";
            break;
        case 2:
            return "<span style='color: #38b000'>Fair</span>";
            break;
        case 3:
            return "<span style='color: #ff9505'>Moderate</span>";
            break;
        case 4:
            return "<span style='color: #ff0a54'>Poor</span>";
            break;
        case 5:
            return "<span style='color: #e70e02'>Very Poor</span>";
            break;
    }
}
?>