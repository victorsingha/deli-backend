<?php

$email_id = $_POST['email_id'];

require 'init.php';

if($con)
{
  $sql = "select * from driver_details where email_id = '$email_id'";
    $result = mysqli_query($con,$sql);  
    if(mysqli_num_rows($result) > 0)
      { 
        $row = mysqli_fetch_assoc($result);
        $status = "ok";
        $result_code = 1;
        $email_id = $row["email_id"];
        $password = $row["password"];
        echo json_encode(array('status' => $status,'result_code' => $result_code, 
          'email_id' => $email_id, 
          'password'=> $password));
      }
    else
      {
        $status = "ok";
        $result_code = 0;
        echo json_encode(array('status' => $status,'result_code' => $result_code));
      }
}
else
{
    $status = "Failed";
    echo json_encode(array('status' => $status),JSON_FORCE_OBJECT);
}

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
    $mail->Subject = 'Password Recovery';
    $mail->Body    = 'Your email is <b>'.$email_id. '</b> and password is <b>' .$password. '</b>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
   // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
mysqli_close($con)

?>