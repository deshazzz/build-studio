<?php
// Variables
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$phone = trim($_POST['phone']);
$preferredCommunication = trim($_POST['preferredCommunication']);
$businessName = trim($_POST['businessName']);
$businessDomain = trim($_POST['businessDomain']);
$message = trim($_POST['message']);


// Email address validation - works with php 5.2+
function is_email_valid($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}


if( isset($name) && isset($email) && isset($phone) && isset($businessName) && isset($businessDomain) && isset($preferredCommunication) && isset($message) && is_email_valid($email) ) {

	// Avoid Email Injection and Mail Form Script Hijacking
	$pattern = "/(content-type|bcc:|cc:|to:)/i";
	if( preg_match($pattern, $name) || preg_match($pattern, $email) || preg_match($pattern, $phone) || preg_match($pattern, $businessName) || preg_match($pattern, $businessDomain) || preg_match($pattern, $preferredCommunication) || preg_match($pattern, $message)) {
		exit;
	}

	// Email will be send
	$to = "mostafafcis15@gmail.com";  // Change with your email address
	$subject = "New appointment request from buildstudio.app"; // If you want a default subject

	// HTML Elements for Email Body
	$body = <<<EOD
	<strong>Name:</strong> $name <br>
	<strong>Email:</strong> <a href="mailto:$email?subject=feedback" "email me">$email</a> <br> <br>
	<strong>Phone:</strong> $phone <br>
	<strong>Preferred Communication:</strong> $preferredCommunication <br>
	<strong>Business Name:</strong> $businessName <br>
	<strong>Business Domain:</strong> $businessDomain <br>
	<strong>Message:</strong> $message <br>
EOD;
//Must end on first column
	
	$headers = "From: $name <$email>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	// PHP email sender
	mail($to, $subject, $body, $headers);
}


?>
