<?php
include('config/config.php');
include('config/functions.php');

// //Import PHPMailer classes into the global namespace
// //These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require 'vendor/autoload.php';

// //Create an instance; passing `true` enables exceptions

// function verify_email($username, $email, $code){
//     $mail = new PHPMailer(true);

//     $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'mail.topgs.stud.vts.su.ac.rs';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'topgs';                     //SMTP username
//     $mail->Password   = 'P2C5xXZEidGRLcM';                               //SMTP password
//     $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
//     $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('topgs@topgs.stud.vts.su.ac.rs', 'Mailer');
//     $mail->addAddress( $email,'User');     //Add a recipient               //Name is optional

//     //Attachments
//     //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//         //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'Please verify your email with <a href="http://localhost/topgs/verify_email.php?code='.$code.'">this</a> link.';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();



// }


if (isset($_POST['submit'])) {

    if ($_POST['confirm_password'] == $_POST['password']) {
        $fname = mysqli_real_escape_string(databaseConnect(), $_POST["fname"]);
        $lname = mysqli_real_escape_string(databaseConnect(), $_POST["lname"]);
        $username = mysqli_real_escape_string(databaseConnect(), $_POST["username"]);
        $email = mysqli_real_escape_string(databaseConnect(), $_POST["email"]);
        $password = mysqli_real_escape_string(databaseConnect(), password_hash($_POST["password"], PASSWORD_BCRYPT));
        $confirm_password = mysqli_real_escape_string(databaseConnect(), $_POST["confirm_password"]);
        $code = md5(mt_rand());
        $active = 1;

        $sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        //var_dump($_POST)
        $res = mysqli_query(databaseConnect(), $sql);
        
        $row = $res->fetch_assoc();
        //echo 'error';
        
        if(!empty($row)){
            
            header('location:/topgs/register.php?m=1');
            

        }else{
            
            //2. SQL query koji salje podatke u bazu
            $sql1 = "INSERT INTO users (fname, lname, username, email, password, active)
            VALUES ('$fname','$lname','$username','$email','$password', $active)";

            //3. Execute Query + cuvanje podataka u bazu
            
            $res1 = mysqli_query(databaseConnect(), $sql1);
            //var_dump(mysqli_query(databaseConnect(), $sql1));
            //mysqli_query(databaseConnect(), $sql1);
            //var_dump($sql1);
            //$res69 = mysqli_query(databaseConnect(), $sql);
            //var_dump($res69);
            //return;

            //header("location:/topgs/login.php");
            //4. Provera da li su podaci uneti u bazu
            if ($res1 == 1) {
                //podaci uneti
                //Varijabla za prikaz poruke
                $_SESSION['reg-msg'] = "<div class='success'>A activation link has been sent to your email.</div>";
                //verify_email($username, $email, $code);

                //Redirect stranica
                header("location:/topgs/login.php");
            } else {
                //podaci nisu uneti tacno/uopste
                $_SESSION['reg-msg'] = "<div class='error'>Failed to Register. Try again.</div>";

                //Redirect stranica
                header("location:/topgs/register.php");
            }
        }
        

        
    }else{
        $_SESSION['reg-msg'] = "Your passwords do not match.";
        header("location:/topgs/register.php");
    }
}else{
    $_SESSION['reg-msg'] = "Please fill in a registration form.";
    header("location:/topgs/register.php");
}

