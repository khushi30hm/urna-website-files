<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST["send"])){
    $name = htmlspecialchars(trim($_POST["name"]));
    $number = htmlspecialchars(trim($_POST["number"]));
    $email = filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL);
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if(!empty($name) && !empty($number) && !empty($message)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'khushi.hospitalityminds@gmail.com'; 
            $mail->Password = 'vqzfjvvwegwxnoty'; 
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465; 

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('khushi.hospitalityminds@gmail.com', $name);
            $mail->addAddress('megha.hospitalityminds@gmail.com'); 


            $mail->isHTML(true);
            $mail->Subject = $subject ?: 'New Contact Form Submission'; 
            $mail->Body = "<strong>Message:</strong> $message<br/>
                           <strong>Name:</strong> $name<br/>
                           <strong>Phone Number:</strong> $number<br/>
                           <strong>Email:</strong> $email";

            $mail->send();
            echo "<script>
                    alert('Mail sent successfully');
                    window.location.href = 'index.html';
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    alert('Mail could not be sent. Error: {$mail->ErrorInfo}');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Please fill in all required fields.');
              </script>";
    }
}
?>
