<?php
session_start();

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$email=$_POST['email'];
	$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
	$host="localhost";
	$admin="root";
	$pss="kinnukutty";
	$db="project";
	$con=mysqli_connect($host,$admin,$pss,$db);
	if(mysqli_connect_errno())
	{
		die("connection failed");
	}
	else
	{
		/* echo "<h1>done</h1>"; */
		$qry="insert into project.payment values ('$email','$file',0);";
		$res=mysqli_query($con,$qry);
		if(!$res)
		{
			echo "<h1>not executedd </h1>" . $res -> error ;
		}
		else
		{
			require  '../phpmailer/PHPMailerAutoload.php';
				function sendmail($to ,$from ,$subject ,$body )
				{
					$mail=new PHPMailer();
					$mail->setFrom($from);
					$mail->addAddress($to);
					
					$mail->Subject= $subject;
					$mail->Body=$body;
					$mail->isHTML(false);
					return $mail->send();
				}
				$from=$email;
				$to="project2020web@gmail.com";
				$subject="Payment done -Reciept";
				$body="Payment has been recieved from " .$email;
				
				if(sendmail($to,$from,$subject,$body))
				{
					echo "email sent";
					/* now i am trying to send mail to the user */

							$to=$email;
							$sub="Thank you for making the payment";
							$msg="Good day, Thank you for making the payment of Rs.100 . Kindly wait till your PRIME ACCOUNT gets activated by our admin.
								You are going to recieve a activation mail once its done.
								We will appriciate your patience.
							-Hitched.com";
							$head="From: project2020web@gmail.com";

								if(mail($to, $sub, $msg,$head))
								{
									echo "done successfully";
									header("location:Thankyou.php"); 

								}
								else
								{
									echo "nah!!! error sending";
								}

						
						
				}
				else
				{
					echo "not sent";
				}

							
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Find-more</title>
	<link rel="stylesheet" type="text/css" href="../css/Finish-transaction.css">
</head>
<body >
	<div class="container">
		<h3>
		Hey there in-order to gain access for more information.
		(or to add more personal information such as videos , images, horoscope) 
		</h3>
		<h5>
		Please make a payment of 100 Rs. Using the Below QR CODE OF <em>PHONEPE</em>
		</h5>
		<img src="../images/Phonepay.jpg" style="width: 400px; height: 500px;">

		<div class="paytag">
			<form action="" method="post" enctype="multipart/form-data">
				<h2 style="font-family: monospace ;">
					Please send us your payment details once you are done paying.
				</h2>
				<input type="email" name="email" placeholder="Your registered mail id" required>
				<input type="file" name="image"  id="image" required >
                <input type="submit" name="submit" class="submit-pay">
			</form>
		</div>
	</div>
	<div class="logout">
		<button class="submit2" ><a href="logout.php">Logout</a></button>

	</div>

</body>
</html>


