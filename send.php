<?php
require_once 'mailclass.php';
$contact = new contact;
$contact -> validateemail($_POST['email']);
//$contact -> validatephone($_POST['phone']);
//$contact -> validatename($_POST['name']);
$contact -> validatemessage($_POST['text']);
$subject = "Message from Portfolio"; // change to desired subject line
$email = 'anthonywebsol@gmail.com'; //change to desired email
$contact ->sendmail($subject , $email);
?>
