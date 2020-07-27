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
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment-check</title>
	<link rel="stylesheet" type="text/css" href="">
</head>
<body>
	<div class="container">
			
				<button class="button" ><a href="../display/logout.php">Logout</a></button><br>
			
			<?php
				$ch="";
				$contact;
				$qry="select * from project.payment p,project.main1 m , project.viewtable v, project.checktable c   where 
						p.email=m.email and m.email=v.email and v.contact=c.contact and c.checkval=1 and p.permit=0 ";
				$res=mysqli_query($con,$qry);
				if(!$con->query($qry))
				{
					echo("retrival failed" . $con -> error);
				}
				$record=mysqli_num_rows($res);
	            if($record==0)
	            {
	              $data_error="all data checked";
	              $valid="false";
	            }
				else
				{/*
					echo "<table >";
					echo "<tr>";echo "<th>Contact</th><th>Dob</th><th>Age</th><th>Gender</th><th>Marital status</th><th>Kids</th><th>Religion</th><th>Qualification</th><th>Image</th><th>Height</th><th>Weigth</th><th>Work profile</th><th>City</th><th>Complexion</th><th>Address</th><th>Diet</th><th>Workplace</th><th>Salary</th>"; */

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
							

							if($key=="email")
							{	
								$ch=$value;

							}
							if($key=="contact")
							{
								$contact=$value;
							}  
							
						}
						echo "<a href=\"nopermit.php?email={$ch}\">cancell-request-to-prime</a><br/>";
						echo "<a href=\"permit.php?contact={$contact}&email={$ch}\">Activate-as-primeuser</a><br/>";
						echo "<br /><hr /><br />";


					}

				}
				mysqli_free_result($res);

			?>


</div>
</body>
</html>
