<?php

if(isset ($_POST['email']) and isset($_POST['text']) and !empty($_POST['email']) and !empty($_POST['text']) )
{
    $email = $_POST['email'];
    $text = $_POST['text'];
    $message = "User email:". $email . "<br/> message:" . $text . ".";
    $receive = "anthonysaldana@leafyweb.com";
    $subject = "Message from your portfolio";
    if( mail($receive, $subject, $message)) 
	 {
	    $pass = "Message has been delivered"; 
		ob_start();
	    echo "<script type='text/javascript'>alert('$pass');
		window.location.replace('index.html');</script>";
	 }
    else 
	 {
	    $error="error sending message"; 
		ob_start();
	    echo "<script type='text/javascript'>alert('$error');
				window.location.replace('index.html#contact');</script>";
	 }
}
else
{
	
	$error = "Email or Message not set. Please go fill out both forms.";
	ob_start();
	echo "<script type='text/javascript'> alert('$error');
			window.location.replace('index.html#contact');</script>";
}
ob_flush();



?>