<?php
include_once '../config/config.php';
require_once '../config/functions.php';

$data = getUsers(databaseConnect(), (int)$_GET['id']);


?>

<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalToggleLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" novalidate class="row g-3 mt-3 mb-3 p-3" id="user">
                <div class="col-md-6 required">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" autofocus value="<?php echo $data['username'] ?>">
                </div>
                <div class="col-md-6 required">
                    <label for="fname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $data['fname'] ?>">
                </div>

                <div class="col-md-6 required">
                    <label for="lname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $data['lname'] ?>">
                </div>

                <div class="col-md-6 required">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email'] ?>">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Send</button>
                    <button type="reset" class="btn btn-primary">Cancel</button>
                </div>

                <input type="hidden" name="op" value="update">
                <input type="hidden" name="id_user" value="<?php echo $data['id_user'] ?>">
            </form>
            <div id="message" class="alert hide"></div>
        </div>
        <div class="modal-footer">
            Modal footer
        </div>
    </div>
</div>