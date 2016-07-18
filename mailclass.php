<?php
use GuzzleHttp\Client;

class contact
{
private $name; //= $_POST['name'];
private $phone; //= $_POST['phone'];
private $email; //= validateemail($_POST['email']);
private $message; //= $_POST['message'];
private $red;

        function __construct(){
            $this->name = "No Name";
            $this->phone = "No Phone";
            $this->email = "No Email";
            $this->message = "No Message";
            $this->red = "<script>var oldURL = document.referrer; window.location = oldURL; </script>";
        }
        
	function validateemail ($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error = $this->email . " is an Invalid Email";
			echo "<script type='text/javascript'>alert('$error');</script>";
                echo $this->red;
                die();
		}
		
		else
		{
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			$this->email = $email;
			//echo $this -> email;
		}
	}//end of validateemail function

	
	function validatemessage ($message)
	{
		if(!empty($message))
		{
				$message = htmlentities($message);
				$message = filter_var($message, FILTER_SANITIZE_MAGIC_QUOTES);
				$this -> message = $message;
				//echo $this->message;
		}
		else
		{
			$error = "empty message input";
			echo "<script type='text/javascript'> alert('$error');</script>";
			die();
		}
	}//end of validatemessage function
	
	function sendmail ($subject , $email)
	{


		$base_uri = "https://api.mailgun.net/v3";
		$domain = "mg.anthonysaldana.com";
		$username = "api";
		$password = "key-c51f22f7e25f9db82eb9d31fe8b97e6d";
		$message = "Message: " . $this->message . "\n Email:" . $this->email;


		$client = new Client([
			// Base URI is used with relative requests
			'base_uri' => $base_uri,
			// You can set any number of default request options.
			'timeout'  => 2.0,
		]);

		$response = $client->post($base_uri . "/" . $domain . "/messages", [
			'auth' => [
				$username, 
				$password
			],
			'form_params' => [
				'from' => 'admin@anthonysaldana.com',//post a field named 'username',
				'to' => 'anthonywebsol@gmail.com',//post a field named 'password',
				'text' => $message
			]
		]);

		$code = $response->getStatusCode(); // 200

		if( 200 == $code )
		{
			$pass = "Message delivered";
			echo "<script type='text/javascript'>alert('$pass');
			window.location.replace('/');</script>";
		}
		else{
			$error="error sending message. Error Code: " . $code ; 
			ob_start();
			echo "<script type='text/javascript'>alert('$error');
			window.location.replace('index.html#contact');</script>";
		}

		//print_r( $response );
		/*
		
		$headers = 'From: admin@anthonysaldana.com' . "\r\n";// .
		//'Reply-To: arbie@anthonysaldana.com' . "\r\n";
		if(mail($email, $subject, $message, $headers))
		{
		$pass = "Message delivered";
		echo "<script type='text/javascript'>alert('$pass');
		window.location.replace('index.html');</script>";
		}
		else{
		$error="error sending message"; 
		ob_start();
		echo "<script type='text/javascript'>alert('$error');
		window.location.replace('index.html#contact');</script>";
		}*/
	}
}

/*
*	Deprecated
*/
	/*function validatephone ($phone)
	{
		if(!empty($phone))
		{
			if(strlen($phone) > 6 and strlen($phone) < 15)
			{
				$phone = htmlentities($phone);
				$phone = preg_replace('(\D)', '-', $phone);
				$phone = filter_var($phone, FILTER_SANITIZE_MAGIC_QUOTES);
				$this -> phone = $phone;
				//echo $this -> phone;
			}
			else
			{
				$error = $this->phone . " is an invalid phone number";
				echo "<script type='text/javascript'>alert('$error');</script>";
                echo $this->red;
                die();
			}
		}
		else 
		{
			$error = "empty phone input";
			echo "<script type='text/javascript'>alert('$error');</script>";
            echo $this->red;
            die();
		}
	}//end of validatephone function*/
	
	/*function validatename ($name)
	{
		if(!empty($name))
		{
			$name = htmlentities($name);
			$name = filter_var($name, FILTER_SANITIZE_MAGIC_QUOTES);
			$this -> name = $name;
			//echo $this -> name;
		}
		else
		{
			$error = "empty name input";
			echo "<script type='text/javascript'>alert('$error');</script>";
                ?>
                    <script>
                        var oldURL = document.referrer;
                        window.location = oldURL;
                    </script>
                <?php
                die();
		}
	}//end of validatename function*/
?>