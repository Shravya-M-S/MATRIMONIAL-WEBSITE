<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/prime.css">
</head>
<body>
	<div class="leftcontainer">
		<?php
		session_start();
				if(isset($_SESSION['email'])){
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
					$q="select v.img , m.name ,m.email, v.contact ,v.date, v.qual, v.wrkp ,v.addr ,v.city from project.main1 m, project.viewtable v where m.email='$email' and m.email=v.email";
					$r=mysqli_query($con,$q);
					if(!$r)
					{
						die("query failed " . $r);
					}
					else
					{
						while($row=mysqli_fetch_assoc($r))
						{
							foreach ($row as $key => $value) {
								if($key=="img")
								{
									echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img'] ).'"" /><br /><br />';
								}
								else if($key=="name")
								{
										echo "<h2 > {$value}</h2><br />";
								}
								else 
								echo " {$value}<br />";
							}
						}
					}
				}
		}
		?>
	</div>
<div class="container">
	<div class="left">
		<?php
		$q2="select name from project.videos where email='$email'";
		$res2=mysqli_query($con,$q2);
		if(!$res2)
		{
			die("query failed " . $res2);
		}
		else
		{
			if(mysqli_num_rows($res2)==1)
			{
				while($row=mysqli_fetch_assoc($res2))
				{
					
					$name=$row['name'];
					
				}
				echo "<h2>Happy family video</h2> <br />";
				echo "<video width='300' height='600' controls><source src='../dbvideos/upload/".$name."' type='video/webm'></video>";
			}
			else
			{
				?>
				
				<form method="post" enctype="multipart/form-data">
					<!-- where ever u have this code file , in the same folder , u should a new folder called upload -->
					<input type="email" name="email-user" value="<?=$email ?>" readonly><br />
					<input type="file" name="file" /><br />
					<input type="submit" name="submit" value="submit" />
					
				</form>
				
				<?php
				if(isset($_POST['submit']))
				{
					$name=$_FILES['file']['name'];
					$temp=$_FILES['file']['tmp_name'];

					move_uploaded_file($temp,"../dbvideos/upload/".$name);
					$q3="insert into project.videos  values ('$email','$name')";
					
					$res3=mysqli_query($con,$q3);
					if(!$res3)
					{
									die("query failed " . $res3);
					}
					else
					{
									echo "done uploading to database file: ".$name;
					}
						
					


				}
			}
		}
		?>
		
	</div>
	<div class="rightup">
	<?php
		$q4="select image from project.imagestable where email='$email'";
		$res4=mysqli_query($con,$q4);
		if(!$res4)
		{
			die("query failed 12" . $res4);
		}
		else
		{
			if(mysqli_num_rows($res4)==1)
			{
				while($row10=mysqli_fetch_assoc($res4))
				{
					echo "Family picture<br /><br />";
					echo '<img src="data:image/jpeg;base64,'.base64_encode($row10['image'] ).'"" />';
					

					
				}
				
			}
			else
			{
				?>
				
				<form method="post" enctype="multipart/form-data">
					<!-- where ever u have this code file , in the same folder , u should a new folder called upload -->
					<input type="email" name="email-user" value="<?=$email ?>" readonly><br />
					<input type="file" name="image" /><br />
					<input type="submit" name="submit2" value="upload" />
					
				</form>
				
				<?php
				if(isset($_POST['submit2']))
				{
					$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));  
					$q5="insert into project.imagestable  values ('$email','$file')";
					
					$res5=mysqli_query($con,$q5);
					if(!$res5)
					{
									die("query failed 3" . $res5);
					}
					else
					{
									echo "done uploading to database file: ";
					}
						
					


				}
			}
		}
		?>
		


		
	</div>
	<div class="rightbottom">
		

	</div>
	<div class="logout">
		<button class="submit2" ><a href="logout.php">Logout</a></button>
	</div>
</div>
</body>
</html>