<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/SMTP.php';


if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {

        $mail->SMTPDebug = 2; 

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'khushi.hospitalityminds@gmail.com';
        $mail->Password = 'usgklqbsgmiydsaz';
        $mail->SMTPSecure ='ssl';
        $mail->Port = 465;

        $mail->setFrom('khushi.hospitalityminds@gmail.com');
        $mail->addAddress('megha.hospitalityminds@gmail.com');
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body = $_POST["name"] . "<br/>" . $_POST["number"] . "<br/>" . $_POST["email"] . "<br/>" . $_POST["message"];
        $mail->send();

        // echo 
        // "<script>
        // alert('sent successfully');
        //  document.location.href = index.php;
        // </script>";

        echo "<script>
    alert('Email sent successfully!');
    document.location.href = 'index.php';
  </script>";
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        // Error alert with detailed message
        echo "<script>
    alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
  </script>";
    }
}
