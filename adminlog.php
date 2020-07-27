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
	<title>Admin login</title>
	<link rel="stylesheet" type="text/css" href="../css/adminlog.css">
</head>
<body>
	<div class="container">
			
				<button class="button" ><a href="../display/logout.php">Logout</a></button><br>
			
			<?php
				$ch="";
				$contact;
				$qry="select * from project.main1 m , project.viewtable v, project.checktable c   where v.contact=c.contact and c.checkval=0 and m.email=v.email ";
				$res=mysqli_query($con,$qry);
				if(!$con->query($qry))
				{
					echo("retrival failed" . $con -> error);
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
						echo "<a href=\"deleteuser.php?email={$ch}\">delete</a><br/>";
						echo "<a href=\"insertuser.php?contact={$contact}&email={$ch}\">insert</a><br/>";
						echo "<br /><hr /><br />";


					}

				}
				mysqli_free_result($res);

			?>
</div>
<div class="nextpage">
	<a href="payment-check.php"  style="border:none;
	padding: 8px 20px;
	border-radius: 10px;	
	font-family: sans-serif;
	font-size: 16px;
	
	background-color: #c5ecfd; 
	color: black;
	text-align: center;
	text-shadow: 0px 2px 10px white;
	width: 200px;">Payment-page</a>
</div>
</body>
</html>
