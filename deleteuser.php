<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	$email=$_GET['email'];
	/*echo $email;*/
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
		{	/*
			$qry="select * from project.viewtable where email=('$email')"; 
			$res=mysqli_query($con,$qry);
			if(!$res)
			{
				 echo("retrival failed". $res -> error);
			}
			else
			{

					while($row=mysqli_fetch_assoc($res))
					{
						foreach ($row as $key => $value) {
							
						
							if($key=="img")
							{
								echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img'] ).'" height="200" width="200" class="img-thumnail" />';
								echo "<br />";

							}
							else 
							echo ucfirst($key) .": {$value}<br />"; //here ucfirst is for making the first alpabeht uppercase
					}
				}

			}	*/


			$qry1="select contact from project.viewtable where email=('$email')";
			$res1=mysqli_query($con,$qry1);
			if(!$res1)
			{
				die("error" . $res1 -> error);
			}
			else
			{
					while($row1=mysqli_fetch_assoc($res1))
					{
						foreach ($row1 as $key1 => $value1) {
							
						
							
							/*echo ucfirst($key1) .": {$value1}<br />"; //here ucfirst is for making the first alpabeht uppercase */
							$contact=$value1;
							/* echo $contact; */
							$qry2="delete from project.checktable where contact=('$contact')";
							$res2=mysqli_query($con,$qry2);
							if(!$res2)
							{
								echo("retrival failed". $res2 -> error);
							}
							else{
								/* echo "done deleting "; */
								$qry="delete from project.viewtable where email=('$email')";
								$res=mysqli_query($con,$qry);
								if(!$res)
								{
										echo("retrival failed". $res -> error);
								}		
								else
								{
				
									$qry="delete from project.main1 where email=('$email')";
									$res=mysqli_query($con,$qry);
									if(!$res)
									{
										echo("retrival failed". $res -> error);
									}	
									else{
										$to=$_GET['email'];
										$sub="Access Denied";
				$msg="hey there, We are NOT permitting your acces to our website. Kindly Register with valid data agin inorder to use our services.
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


								}

							}		


					}
				}
			}
			/*
			*/

		}
?>
</body>
</html>