<?php

// error_reporting(E_ALL | E_STRICT);
// ini_set('display_startup_errors',1);
// ini_set('display_errors',1);

//if lang is not set, set to english
$polish = isset($_POST['lang'])?($_POST['lang']==="pl"):false;

if(!(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['body'])) ){
	echo $polish?'0Wypełnij wszystkie pola!':'0Please fill out all of the fields!';
	die();
}

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$message = trim($_POST['body']);

if(empty($name) || empty($email) || empty($message)){
	echo $polish?'0Wypełnij wszystkie pola!':'0Please fill out all of the fields!';
	die();
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
	echo $polish?'0Podaj prawidłowy adres e-mail!':'0Please provide a valid e-mail address!';
	die();
}


$recipients = array(
  "office@ignibit.com",
);
$to = implode(',', $recipients); // your email address

$subject = "Ignibit Contact form message from $email";
$headers = "From: \n $name <contactform@ignibit.com>" . "\r\n" .
    "Reply-To: \n $email" . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
$body = "$message";


if ($_POST['submit']) {
    if (mail ($to, $subject, $body, $headers)) {
	    echo $polish?'1Twoja wiadomość została wysłana!':'1Your message has been sent!';
	} else {
	    echo $polish?'0Coś poszło nie tak, spróbuj jeszcze raz.':'0Something went wrong, go back and try again.';
	}
}
