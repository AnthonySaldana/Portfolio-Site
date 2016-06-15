<?php
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

	
	function validatephone ($phone)
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
	}//end of validatephone function
	
	function validatename ($name)
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
	}//end of validatename function
	
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
		$message = "phone: " . $this -> phone . "\n Message: " . $this -> message . "\n Name: " . $this -> name . "\n Email:" . $this->email;
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
                }
	}
}
?>