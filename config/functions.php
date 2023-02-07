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

function getProfile(mysqli $connection, int $id_user):array
{
    $data = [];
    $sql = "SELECT * FROM users WHERE  id_user='$id_user'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = $row;
        }
    }

    return $data;
}
/**
 * @param string $str The string to sanitize
 * @return string Sanitized $str
 */
function sanitize(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function is_ajax(): bool
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function updateProfile(string $fname,string $lname, string $username, string $email, int $id_user, mysqli $connection): bool
{

    $sql = "UPDATE users SET fname = '$fname', lname = '$lname', username='$username', email='$email'";



    $sql .= " WHERE id_user = $id_user";

    mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return mysqli_affected_rows($connection) > 0;
}
?>