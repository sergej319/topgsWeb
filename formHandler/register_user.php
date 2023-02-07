<?php
include('../config/config.php');
var_dump($_POST);

if (isset($_POST['submit'])) {

    if ($_POST['confirm_password'] == $_POST['password']) {
        $fname = mysqli_real_escape_string(databaseConnect(), $_POST["fname"]);
        $lname = mysqli_real_escape_string(databaseConnect(), $_POST["lname"]);
        $username = mysqli_real_escape_string(databaseConnect(), $_POST["username"]);
        $email = mysqli_real_escape_string(databaseConnect(), $_POST["email"]);
        $password = mysqli_real_escape_string(databaseConnect(), password_hash($_POST["password"], PASSWORD_BCRYPT));
        $confirm_password = mysqli_real_escape_string(databaseConnect(), $_POST["confirm_password"]);

        $sql = "SELECT * FROM users WHERE username='" . $_POST['username'] . "' LIMIT 1";
        //var_dump($_POST)
        $res = mysqli_query(databaseConnect(), $sql);
        $row = $res->fetch_assoc();
        if(!empty($row)){
            header('location:topgs/register.php?m=1');
        }

        //2. SQL query koji salje podatke u bazu
        $sql1 = "INSERT INTO users(fname, lname, username, email, password )
        VALUES ('$fname','$lname','$username','$email','$password')";

        //3. Execute Query + cuvanje podataka u bazu

        $res1 = mysqli_query(databaseConnect(), $sql1) or die(mysqli_error(databaseConnect()));


        //4. Provera da li su podaci uneti u bazu
        if ($res1 == TRUE) {
            //podaci uneti
            //Varijabla za prikaz poruke
            $_SESSION['reg-msg'] = "<div class='success'>You Are Registered Successfully</div>";

            //Redirect stranica
            header("location:/topgs/login.php");
        } else {
            //podaci nisu uneti tacno/uopste
            $_SESSION['reg-msg'] = "<div class='error'>Failed to Register. Try again.</div>";

            //Redirect stranica
            header("location:/topgs/register.php");
        }
    }
}

