<?php

include "constants/header.php";
include "constants/login-check.php";
?>

<div class="index-table" style="min-height: 80vh;">
    <table>
        <tr>
            <th>IP_ADDRESS</th>
            <th>DEVICE_TYPE</th>
            <th>USER_AGENT</th>
            <th>DATE_TIME</th>

        </tr>

        <?php
        $sql = "SELECT * from logs";
        $res = mysqli_query(databaseConnect(), $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $ip_address = $row['ip_address'];
            $device_type = $row['device_type'];
            $user_agent = $row['user_agent'];
            $date_time = $row['date_time'];

        ?>
            <tr>
                <td><?php echo $ip_address ?></td>
                <td><?php echo $device_type ?></td>
                <td><?php echo $user_agent ?></td>
                <td><?php echo $date_time ?></td>
            </tr>


        <?php
        }

        ?>
    </table>
</div>


<?php

include "constants/footer.php";
