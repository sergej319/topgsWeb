<?php

include "constants/header.php";
//include "constants/login-check.php";
?>


<div class="container ">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php" class="link-dark">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titles[$page] ?></li>
        </ol>
    </nav>

    <table id="logs" class="table table-hover display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Ip address</th>
                <th>Device type</th>
                <th>User agent</th>
                <th>Date time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Ip address</th>
                <th>Device type</th>
                <th>User agent</th>
                <th>Date time</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</div>


<?php

include "constants/footer.php";
