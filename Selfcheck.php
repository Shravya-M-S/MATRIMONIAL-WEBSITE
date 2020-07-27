<!DOCTYPE html>
<html>
<head>
	<title>Self-check</title>
</head>
<body>
	<?php
	session_start();
	$email=$_SESSION['email'];

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
		$q="select * from project.payment where email='$email' and permit=1";
		$r=mysqli_query($con,$q);
		if(!$r)
		{
			die("query failed " . $r);
		}
		else
		{
			if(mysqli_num_rows($r)==1)
			{
				header("location:Prime-user.php");
			}
			else
			{
				header("location:Finish-transaction.php");
			}
						
		}
	}
	?>

</body>
</html>