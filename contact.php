<?php

require 'PHPMailer-master/PHPMailerAutoload.php';



$fromEmail = 'info@grmobileautorepairs.com';
$fromName = 'Client';

// $sendToEmail = 'mobileautorepairs@outlook.com';
$sendToEmail = 'klata.jarek@gmail.com';
$sendToName = 'Robert';

$subject = 'New message from contact form';
$fields = array('name' => 'Name', 'subject' => 'Subject', 'tel' => 'Phone', 'email' => 'Email', 'message' => 'Message');
$okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon';
$errorMessage = 'There was an error while submitting the form. Please try again later.';

error_reporting(0);

try {
    if (count($_POST) == 0) throw new \Exception("Form is empty");

    $emailTextHtml = "<h1>You have a new message from your contact form</h1><hr>";
    $emailTextHtml .= "<table>";

    foreach ($_POST as $key => $value) {
        if (isset($fields[$key])) {
            $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
        }
    }

    $emailTextHtml .= "</table><hr>";
    $emailTextHtml .= "<p>Have a nice day,<br>Best,<br>Regards</p>";

    $mail = new PHPMailer;

    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($sendToEmail, $sendToName);
    $mail->addReplyTo($from);

    $mail->isHTML(true);

    $mail->Subject = $subject;
    $mail->msgHTML($emailTextHtml); 

    if(!$mail->send()) {
        throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
    }
    
    $responseArray = array('type' => 'success', 'message' => $okMessage);

} catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
    //debug_to_console( $e );
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
} else {
    echo $responseArray['message'];
}


























?>