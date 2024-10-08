<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $car_model = $_POST['car_model'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];

    // Validate the inputs
    if (!empty($name) && !empty($email) && !empty($note)) {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            // Set mailer to use SMTP
            $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'ratan.mia@continental-motor.com';                 // SMTP username (your Gmail)
            $mail->Password   = 'zskmkanpgykdmcpo';                        // SMTP password (or App Password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption
            $mail->Port       = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom($email, $name);                             // Sender
            $mail->addAddress('info@cherybd.com');           // Add a recipient (your email)

            // Content
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'New note from ' . $name;
            $mail->Body    = "<h3>Name: $name</h3><p>Email: $email</p><p>Phone: $phone</p><p>Car Model: $car_model</p><p>note: $note</p>";


            // Send email
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "All fields are required.";
    }
}
