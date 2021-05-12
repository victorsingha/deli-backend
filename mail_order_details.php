<?php

$pick_location = $_POST['pick_location'];
$drop_location = $_POST['drop_location'];
$pick_date = $_POST['pick_date'];
$vehicle = $_POST['vehicle'];
$amount = $_POST['amount'];
$full_name = $_POST['full_name'];
$email_id = $_POST['email_id'];
$contact_number = $_POST['contact_number'];
$parcel = $_POST['parcel'];

    $message = file_get_contents('order_received.html'); 
    $message = str_replace('%pick_location%', $pick_location, $message); 
    $message = str_replace('%drop_location%', $drop_location, $message);
    $message = str_replace('%pick_date%', $pick_date, $message); 
    $message = str_replace('%vehicle%', $vehicle, $message); 
    $message = str_replace('%amount%', $amount, $message); 
    $message = str_replace('%full_name%', $full_name, $message); 
    $message = str_replace('%email_id%', $email_id, $message); 
    $message = str_replace('%contact_number%', $contact_number, $message); 
    $message = str_replace('%parcel%', $parcel, $message); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sup.pickitup@gmail.com';                     // SMTP username
    $mail->Password   = 'gmail_password';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('sup.pickitup@gmail.com', 'pickitup.com');
    $mail->addAddress($email_id);               // Name is optional
    $mail->addReplyTo('no-reply@gmail.com', 'No reply');

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Your Order Details';
    // $mail->Body    = '<b>Order Details</b> <br>
    //                   PickUp Location : ' .$pick_location. '<br>
    //                   Drop Location : '   .$drop_location. '<br>
    //                   Date : ' .$pick_date. '<br>
    //                   Vehicle Type : ' .$vehicle. '<br>
    //                   Amount : ' .$amount. '<br>
    //                   Full Name : ' .$full_name. '<br>
    //                   Email ID : ' .$email_id. '<br>
    //                   Contact Number : ' .$contact_number. '<br>
    //                   Parcel : ' .$parcel. '<br><b>THANK YOU.</b>';
                       
    $mail->Body = $message;

    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
            $status = "ok";
            $result_code = 1;
            echo json_encode(array('status' => $status,'result_code' => $result_code));
} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            $status = "ok";
            $result_code = 0;
            echo json_encode(array('status' => $status,'result_code' => $result_code));
}


?>