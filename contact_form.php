<?php
//Fetching Values from URL
$email = $_POST['email1'];
//sanitizing email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
//After sanitization Validation is performed
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

// To send HTML mail, the Content-type header must be set
$to = 'bartekbaranow@gmail.com, marcinczyk3107@gmail.com', 'adamsajewski@wp.pl ';
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From:' . $email. "\r\n"; // Sender's Email

$template = '<div style="padding:50px; color:black;">Witaj ' . $name . ',<br/>'
. '<br/>Masz nowego subskrybenta! <br/><br/>'
. 'Jego email to: ' . $email . '<br/>'
. '<br/>'
. '</div>';
$sendmessage = "<div style=\"background-color:#FFFFFF; color:black;\">" . $template . "</div>";
// message lines should not exceed 70 characters (PHP rule), so wrap it
$sendmessage = wordwrap($sendmessage, 70);

// Send mail by PHP Mail Function
mail($to, "[Centrum dzwieku] Nowy subskrybent", $sendmessage, $headers);
echo "Your Query has been received, We will contact you soon.";
} else {
echo "<span>* invalid email *</span>";
}
?>