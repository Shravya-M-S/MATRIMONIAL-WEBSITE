<!DOCTYPE html>
<html>
<head>
	<title>Inserting user</title>
</head>
<body>
	<?php
		
		$host="localhost";
		$admin="root";
		$pss="kinnukutty";
		$db="project";
		$con=mysqli_connect($host,$admin,$pss,$db);
		if(mysqli_connect_errno())
		{
			die("connection failed");
		}
		$email=$_GET['email'];
		$qry="update project.payment set permit=1 where email=('$email');";
		$res=mysqli_query($con,$qry);
		if(!$res)
		{
			die("update failed ");
		}
		else
		{
			
			
				$to=$_GET['email'];
				$sub="You are now a PRIME USER";
				$msg="hey there, We are permitting your acces as PRIME USER in our website. 
				Thank you for your payment , we hope ull enjoy our services.
				Kindly login and enjoy our services.
				-Hitched.com";
				$head="From: project2020web@gmail.com";

					if(mail($to, $sub, $msg,$head))
					{
						echo "done successfully";
						header("location:payment-check.php"); 

					}
					else
					{
						echo "nah!!! error sending";
					}

			
			
		}
		


		

	?>

</body>
</html>