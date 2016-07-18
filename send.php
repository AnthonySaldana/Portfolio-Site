<?php
/*require_once 'mailclass.php';
$contact = new contact;
$contact -> validateemail($_POST['email']);
//$contact -> validatephone($_POST['phone']);
//$contact -> validatename($_POST['name']);
$contact -> validatemessage($_POST['text']);
$subject = "Message from Portfolio"; // change to desired subject line
$email = 'anthonywebsol@gmail.com'; //change to desired email
$contact ->sendmail($subject , $email);*/

# Include the Autoloader (see "Libraries" for install instructions)
require 'vendor/autoload.php';
use Mailgun\Mailgun;

# Instantiate the client.
$mgClient = new Mailgun('key-c51f22f7e25f9db82eb9d31fe8b97e6d');
$domain = "sandbox701195d08f284159af91e185e8dd2e7d.mailgun.org";

# Make the call to the client.
$result = $mgClient->sendMessage("$domain",
                  array('from'    => 'Mailgun Sandbox <postmaster@sandbox701195d08f284159af91e185e8dd2e7d.mailgun.org>',
                        'to'      => 'anthony saldana <anthonywebsol@gmail.com>',
                        'subject' => 'Hello anthony saldana',
                        'text'    => 'Congratulations anthony saldana, you just sent an email with Mailgun!  You are truly awesome!  You can see a record of this email in your logs: https://mailgun.com/cp/log .  You can send up to 300 emails/day from this sandbox server.  Next, you should add your own domain so you can send 10,000 emails/month for free.'));
    

?>
