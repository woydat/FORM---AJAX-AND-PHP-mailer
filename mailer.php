<!-- Full instruction -> https://github.com/PHPMailer/PHPMailer-->

<?php
require 'phpmailer/PHPMailerAutoload.php';
$data = json_decode(file_get_contents('php://input'), true);
if (!$data){
    die('Error, Please visit the website: https://www.WebsiteName.pl');
}
$mail = new PHPMailer;

$mail->SMTPDebug = 3;                                 // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'mail.*****.net';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mail@*****.pl';                    // SMTP username
$mail->Password = '******';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom($data['mail'], $data['name']);
$mail->addAddress('daniel@gmail.com', 'Daniel');      // Add a recipient
$mail->addAddress('ellen@example.com');             // Name is optional
$mail->addReplyTo($data['mail'], 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                   // Set email format to HTML

$mail->Subject = 'WebsiteName, Message from: '.$data['name'];
$mail->Body    = 'New message from: <b>'.$data['name'].'</b><br>,'.$data['message'].'<br><b>Contact e-mail:'.$data['mail'].'</b><br><br><b>WebsiteName</b><br> Contact Form';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
