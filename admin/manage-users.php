<?php

include "constants/header.php";
include "constants/login-check.php";

?>

<div class="container" style="min-height: 80vh">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php" class="link-dark">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $titles[$page] ?></li>
        </ol>
    </nav>

    <table id="users" class="table table-hover display" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>

    <div class="modal" id="userModal" aria-hidden="true" aria-labelledby="userModal" tabindex="-1">
    </div>
</div>

    <?php

    include "constants/footer.php";
