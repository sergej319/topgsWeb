<?php
function getCurrentPage(): string
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

function getLogs(mysqli $connection): array
{

    $data = [];
    $sql = "SELECT * FROM logs";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}

function deleteLog($connection, $id_log)
{
    $sql = "DELETE FROM logs WHERE id_log = $id_log";
    mysqli_query($connection, $sql) or die(mysqli_error($connection));
}

function getUsers(mysqli $connection, int $id_user): array
{

    $data = [];
    $sql = "SELECT * FROM users WHERE id_user = '$id_user'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data = $row;
        }
    }

    return $data;
}

function updateUser(string $username, int $id_user, string $fname, string $lname, string $email, mysqli $connection): bool
{

    $sql = "UPDATE users SET username = '$username', fname = '$fname', lname = '$lname', email = '$email'";



    $sql .= " WHERE id_user = $id_user";

    mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return mysqli_affected_rows($connection) > 0;
}