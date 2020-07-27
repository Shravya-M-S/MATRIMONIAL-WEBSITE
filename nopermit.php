


<!DOCTYPE html>
<html>
<head>
	<title>Permit cancelled</title>
</head>
<body>
			<?php
				$email=$_GET['email'];
	
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
			$qry1="select distinct(p.email)  from project.payment p , project.main1 m where p.email=('$email') and p.email=m.email";
			$res1=mysqli_query($con,$qry1);
			if(!$res1)
			{
				die("error" . $res1 -> error);
			}
			$record=mysqli_num_rows($res1);
	        if($record==0)
	        {
	              $data_error="no data found";
	              $valid="false";
	        }
			else
			{
					while($row1=mysqli_fetch_assoc($res1))
					{
						foreach ($row1 as $key1 => $value1) {
							
						
							
							
							$email=$value1;
							
							$qry2="delete from project.payment where email=('$email')";
							$res2=mysqli_query($con,$qry2);
							if(!$res2)
							{
								echo("retrival failed". $res2 -> error);
							}
							else{
								
								
				
										$to=$_GET['email'];
										$sub="Access Denied";
										$msg="hey there, We are NOT permitting your acces to PRIME ACCOUNT in our website. Kindly send us the right payment receipt if your transaction was successful.
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


								}

							}		


					}
				}
			
			

		
?>
	

</body>
</html>