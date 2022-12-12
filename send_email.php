<?php

require_once "includes/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

session_start();

$temp_password = $_SESSION["pass"];

if (isset($_POST['save_examinee'])) {

    var_dump($_POST);

    $sql = "select * from examinee where (email='$email');";
    $res = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($email == isset($row['email'])) {
            echo "email already exists";
        }
    } else {
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $email_address = $_POST['email_address'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone_number = $_POST['phone_number'];
        $strand_id = $_POST['strand_id'];
        $first_choice = $_POST['first_choice'];
        $status = 1;

        $query = "INSERT INTO examinee(last_name, first_name, middle_name, address, gender, email_address, password, phone_number, first_choice, strand_id, status)
                    VALUES ('$last_name', '$first_name', '$middle_name', '$address', '$gender', '$email_address' , '$password', '$phone_number', '$first_choice' , '$strand_id', '$status')";
        $query_run = mysqli_query($link, $query);

        if ($query_run) {
            $_SESSION['success_status'] = "You have successfully added a new examinee.";
            // header("location: manage_examinee.php");
        }
    }
}

if (isset($_POST['save_qualifier'])) {

    var_dump($_POST);

    $sql = "select * from examinee where (email='$email');";
    $res = mysqli_query($mysqli, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        if ($email == isset($row['email'])) {
            echo "email already exists";
        }
    } else {
        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $email_address = $_POST['email_address'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $phone_number = $_POST['phone_number'];
        $first_choice = $_POST['first_choice'];
        $is_qualifier = 1;
        $status = 1;

        $query = "INSERT INTO examinee(last_name, first_name, middle_name, address, gender, email_address, password, phone_number, first_choice, is_qualifier, status)
                VALUES ('$last_name', '$first_name', '$middle_name', '$address', '$gender', '$email_address' , '$password', '$phone_number', '$first_choice' , '$is_qualifier', '$status')";
        $query_run = mysqli_query($link, $query);

        if ($query_run) {
            $_SESSION['success_status'] = "You have successfully added a new qualifier.";
            // header("location: manage_examinee.php");
        }
    }
}
?> 

<?php

if (isset($_POST['save_examinee'])) {

    var_dump($_POST);

    //Load composer's autoloader
    require_once __DIR__ . '\PHPMailer\Exception.php';
    require __DIR__ . '\PHPMailer\PHPMailer.php';
    require __DIR__ . '\PHPMailer\SMTP.php';

    $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'systemspluscollegefoundation1@gmail.com';
    $mail->Password = 'ieiiabmkltvdntsg'; //   ieiiabmkltvdntsgieiiabmkltvdntsgieiiabmkltvdntsg  bermzwhiteknight8       

    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    //Send Email
    $mail->setFrom('systemspluscollegefoundation1@gmail.com', 'SPCF');


    $query1 = "SELECT * FROM examinee ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($link, $query1);

    if ($result->num_rows > 0) {
        foreach ($result as $row) {

            //Recipients
            $mail->addAddress($email_address);
            $mail->addReplyTo('systemspluscollegefoundation1@gmail.com');

            //Content
            $mail->isHTML(true);
            $mail->Subject = "SPCF ENTRANCE EXAMINATION";

            $mail->Body    = "<h3><b> Good Day! "  . $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] .
                "</b></h3><br><br> Here are your exam credentials. <br><br> Email: " . $row['email_address'] . "<br>Password: <b>" . $temp_password .
                "</b><br> Examination link: ";

            $mail->AltBody = 'Body in plain text for non-HTML mail clients';

            if ($mail->send()); {

                $_SESSION['result'] = 'Message has been sent';
                $_SESSION['status'] = 'ok';
            }
            $_SESSION['result'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            $_SESSION['status'] = 'error';


            $_SESSION['success_status'] = "You have successfully added a new examinee.";
            header("location: manage_examinee.php");
        }
    }
}

?> 
