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
		$contact=$_GET['contact'];
		$qry="update project.checktable set checkval=1 where contact=('$contact');";
		$res=mysqli_query($con,$qry);
		if(!$res)
		{
			die("update failed ");
		}
		else
		{
			/* echo "done updating"; */
			
				$to=$_GET['email'];
				$sub="Access granted";
				$msg="hey there, We are permitting your acces to our website. Kindly login and enjoy our services.
				-Hitched.com";
				$head="From: project2020web@gmail.com";

					if(mail($to, $sub, $msg,$head))
					{
						echo "done successfully";
						header("location:adminlog.php");

					}
					else
					{
						echo "nah!!! error sending";
					}

			
			 
		}
		


		

	?>

</body>
</html>