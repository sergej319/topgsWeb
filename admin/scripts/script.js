$(document).ready( function () {

    setTimeout(function () {
        $('#message').remove('.show');
        $('#message').add('.hide');
    }, 4000);
    

    $('#logs').DataTable({
        ajax: 'ajax/getLogs.php',
    });
    $('#users').DataTable({
        ajax: 'ajax/getUsers.php',
    });
    $('#favorited').DataTable({
        ajax: 'ajax/getFavorited.php',
    });

    $('body').on('click', '.editUser', function () {
        var id = $(this).data('id');
        let options = {
            backdrop: 'static',
            keyboard: true,
            show: false
        };
        $.get('ajax/showEditUsersModal.php', {id: id}, function (html) {
            $('#userModal').html(html);
            $('#userModal').modal('show', options);
            $('#userModal').on('shown.bs.modal', function () {
                $('#username').focus();
            })
        });

    });

    $('body').on('submit', '#user', function (event) {

        if ($('#username').val().trim().length === 0) {
            $('#username').val('');
            $('#username').focus();
            errorMessage('<strong>Error!</strong> Insert value for username');
            return false;
        }

        if ($('#fname').val().trim().length === 0) {
            $('#fname').val('');
            $('#fname').focus();
            errorMessage('<strong>Error!</strong> Insert value for fname');
            return false;
        }

        if ($('#lname').val().trim().length === 0) {
            $('#lname').val('');
            $('#lname').focus();
            errorMessage('<strong>Error!</strong> Insert value for lname');
            return false;
        }

        if ($('#email').val().trim().length === 0) {
            $('#email').val('');
            $('#email').focus();
            errorMessage('<strong>Error!</strong> Insert value for email');
            return false;
        }


        $.post("ajax/updateUser.php", $(this).serialize(), function (data) {
            $("#message").html(data.message);
            $('#message').removeClass();
            $("#message").addClass(data.aclass);
            $('#message').fadeIn(300);
            $("#message").delay(1000).fadeOut(300);
            $('#user').DataTable().ajax.reload();
            $('#user').DataTable().clear();
        }, "json");
        event.preventDefault();
    });

    $('body').on('click', '.editUser', function () {
        var id = $(this).data('id');
        let options = {
            backdrop: 'static',
            keyboard: true,
            show: false
        };
        $.get('ajax/showEditUsersModal.php', {id: id}, function (html) {
            $('#userModal').html(html);
            $('#userModal').modal('show', options);
            $('#userModal').on('shown.bs.modal', function () {
                $('#username').focus();
            })
        });

    });
$('body').on('click', '.deleteLog', function() {
        var id = $(this).data('id');
        let name = $(this).data('name');
        let answer = confirm('Do you want to delete log with ip '+name+'? ');
        if(answer) {
            $.post('ajax/deleteLog.php', { id: id});
            $('#logs').DataTable().ajax.reload();
            $('#logs').DataTable().clear();
        }
    })

    $('body').on('click', '.deleteUser', function() {
        var id = $(this).data('id');
        let name = $(this).data('name');
        let answer = confirm('Do you want to delete log with ip '+name+'? ');
        if(answer) {
            $.post('ajax/deleteLog.php', { id: id});
            $('#logs').DataTable().ajax.reload();
            $('#logs').DataTable().clear();
        }
    })
});