<?php
	session_start();
	$contact=$email=$gender="";
	if($_SESSION['email']=="") die("cannot!!!!");
	$contact=$_SESSION['contact'];
	$email=$_SESSION['email'];

	$gender=$_SESSION['gender'];

	//echo $contact . "  " . $email . " " . $gender;
	$_SESSION['MYEMAIL']=$email;
	$host="localhost";
	$admin="root";
	$pss="kinnukutty";
	$db="project";
	$con=mysqli_connect($host,$admin,$pss,$db);
	if(mysqli_connect_errno())
	{
		die("connection failed");
	}
	$search_err="";

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Hitched</title>
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<div class="one">	
		<form action="Hitched.php" method="post">
			<a href="Selfcheck.php?email=<? $email ?>" ><img src="../images/log.jpg" class="avatar"></a>
			<input type="text" class="search" name="q" placeholder="search here and also select criteria in the selector">
			<select name="column" class="selector">
				<option value="#">Select filter</option>
				<option value="name">Name</option>
				<option value="age">Age</option>
				<option value="wrkp">Work profile</option>
				<option value="qual">Qualification</option>
			</select>
			<input type="submit" name="submit" class="submit" value="search">
			<span class="error2"><?= $search_err ?></span>
			<button class="submit2" ><a href="logout.php">Logout</a></button>

	    </form>


	 <!--   <button class="button" ><a href="../forms1.php">Logout</a></button> -->
	 <div class="container">
			 <?php
			$search_err="";
			if(isset($_POST['submit']))
			{

			$host="localhost";
			$admin="root";
			$pss="kinnukutty";
			$db="project";
			$con=mysqli_connect($host,$admin,$pss,$db);
			if(mysqli_connect_errno())
			{
				die("connection failed");
			}
			else{	
				$q=$con->real_escape_string($_POST['q']); //used to protect data

				
				$column=$con->real_escape_string($_POST['column']);
				if($column=="" || ($column!="name" && $column!="age" && $column!="wrkp" && $column!="qual"))//this is done to keep our data safe is someone tries to change it.
				{
					$column="name";//default selector/filter
				}
				/*echo "select distinct(m.name), v.img  from project.main1 m  , project.viewtable v where m.$column like '%$q%' and m.email=v.email  "; */
				if($gender=="Female")
				{
						$data=mysqli_query($con,"select v.img , m.name, v.age ,v.religion ,v.qual, v.ms,v.kids , v.ht , v.wt, v.wrkp ,v.city ,v.sal ,v.email  from project.main1 m  , project.viewtable v , project.checktable c where m.$column like '%$q%' and m.email=v.email and v.gender='male' and c.contact=v.contact and c.checkval=1");
						if(mysqli_num_rows($data)>0)
						{
							while($row2=mysqli_fetch_assoc($data))
							{
								echo "
										<div class=\"box\">
										<div class=\"imgBox\">";
								foreach ($row2 as $key => $value) {
											
										
											if($key=="img")
											{
												echo '<img src="data:image/jpeg;base64,'.base64_encode($row2['img'] ).'"" />';

											}
											else if($key=="name")
									{
										echo "</div>
												<div class=\"details\">
												<div class=\"content\"> ";
										echo ucfirst($key) .": {$value}<br />";
									
									}
									else if($key=="age")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="religion")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="qual")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ms")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="kids")
									{
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ht")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="wt")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="wrkp")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="city")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="sal")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
											
											else if($key=="email")
											{	
												
												echo "<form method=\"post\" action=\"transaction.php\" style=\"
												top: 30px; left:20px; height:30px; width:30px; background: blue; \">
																	<input type=\"submit\" name=\"Payment\" value=\"Read-more\">
																</form>";
											}
											else if($key=="contact")
											{
												
											}  
												else if($key=="psswd")
											{
												
											}  
											else 
											echo ucfirst($key) .": {$value}<br />";
										}
										echo "
									
									</div>
									</div>
									</div>";
										
								
							}
						}

						else
						{
							$search_err="no such data found";
						}
					}
				else if($gender=="Male")
				{
						
						$data=mysqli_query($con,"select  v.img , m.name , v.age ,v.religion ,v.qual, v.ms, v.kids , v.ht , v.wt, v.wrkp ,v.city ,v.sal ,v.email  from project.main1 m  , project.viewtable v , project.checktable c  where m.$column like '%$q%' and m.email=v.email and v.gender='female' and c.contact=v.contact and c.checkval=1");
						if(mysqli_num_rows($data)>0)
						{

							while($row2=mysqli_fetch_assoc($data))
							{
								echo "
										<div class=\"box\">
										<div class=\"imgBox\">";
								foreach ($row2 as $key => $value) {
											
											
											if($key=="img")
											{
												echo '<img src="data:image/jpeg;base64,'.base64_encode($row2['img'] ).'"" />';
												

											}
											else if($key=="name")
									{
										echo "</div>
												<div class=\"details\">
												<div class=\"content\"> ";
										echo ucfirst($key) .": {$value}<br />";
									
									}
									else if($key=="age")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="religion")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="qual")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ms")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
										else if($key=="kids")
									{
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ht")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="wt")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="wrkp")
									{	
										
									/* 	echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="city")
									{	
										
									/* 	echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="sal")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
											else if($key=="email")
											{	
												
													echo "<form method=\"post\" action=\"transaction.php\" style=\"
												top: 30px; left:20px; height:30px; width:30px; background: blue; \">
																	<input type=\"submit\" name=\"Payment\" value=\"Read-more\">
																</form>";
											}
											else if($key=="contact")
											{
												
											}  
												else if($key=="psswd")
											{
												
											}  
											else 
											echo ucfirst($key) .": {$value}<br />";
										}
										echo "
									
									</div>
									</div>
									</div>";
								
							}
						}

						else
						{
							$search_err="no such data found";
						}
					}		
				}
			
				echo "<br>end of search";
				

			}
		?>
</div>
</div>

</div>
<div class="container">
	<?php
		$ch=$em="";
		$contact;
		if($gender=="Female")
		{	$qry="select v.img, m.name , v.age ,v.religion ,v.qual, v.ms , v.ht , v.wt, v.wrkp ,v.city ,v.sal ,v.email from project.main1 m, project.viewtable v , project.checktable c where c.checkval=1 and v.contact=c.contact and v.email=m.email and v.gender='male';";
						$res=mysqli_query($con,$qry);
						if(!$res)
						{
							echo("retrival failed".$res -> error);
						}
						else
						{
							while($row=mysqli_fetch_assoc($res))
							{
								
								//$count=1;
								echo "
										<div class=\"box\">
										<div class=\"imgBox\">";
								foreach ($row as $key => $value) {
										
								
									if($key=="img")
									{
										
										//$str.='<img src="data:image/jpeg;base64,'.base64_encode($row['img'] ).'" " />';
											echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img'] ).'"" />';
										

									}
									else if($key=="name")
									{
										echo "</div>
												<div class=\"details\">
												<div class=\"content\"> ";
										echo ucfirst($key) .": {$value}<br />";
									
									}
									else if($key=="age")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="religion")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="qual")
									{	
										/*
										echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ms")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ht")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */ 
									}
									else if($key=="wt")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />";  */
									}
									else if($key=="wrkp")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="city")
									{	
										
										/*  echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="sal")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
										

									}


									else if($key=="email")
									{	/*
										$_SESSION['email']=$value;
										echo "<a href=\"Details.php\">Show more</a>";	
										*/
										/*
										$em=$value;
										echo "<a href=\"Details.php?email={$em}\">Show more</a>";
										*/
										
										echo "<form method=\"post\" action=\"transaction.php\" style=\"
												top: 30px; left:20px; height:30px; width:30px; background: blue; \">
																	<input type=\"submit\" name=\"Payment\" value=\"Read-more\">
																</form>";

									}




								/*}
								$str.="</p>
									</div>
									</div>
									</div>";
								echo $str; */
							}
								echo "
									
									</div>
									</div>
									</div>";
								


							}

						}
						mysqli_free_result($res);
				
				
		}
		else if($gender=="Male")
		{
					$qry="select v.img, m.name , v.age ,v.religion , v.ms , v.ht , v.wt, v.wrkp ,v.city ,v.sal from project.main1 m, project.viewtable v , project.checktable c where c.checkval=1 and v.contact=c.contact and v.email=m.email and v.gender='Female';";
						$res=mysqli_query($con,$qry);
						if(!$res)
						{
							echo("retrival failed".$res -> error);
						}
						else
						{
							while($row=mysqli_fetch_assoc($res))
							{
								
								//$count=1;
								echo "
										<div class=\"box\">
										<div class=\"imgBox\">";
								foreach ($row as $key => $value) {
										
								
									if($key=="img")
									{
										
										//$str.='<img src="data:image/jpeg;base64,'.base64_encode($row['img'] ).'" " />';
											echo '<img src="data:image/jpeg;base64,'.base64_encode($row['img'] ).'"" />';
										

									}
									else if($key=="name")
									{
										echo "</div>
												<div class=\"details\">
												<div class=\"content\"> <p>";
										echo ucfirst($key) .": {$value}<br />";
									
									}
									else if($key=="age")
									{	
										
										echo ucfirst($key) .": {$value}<br />";
									}
									else if($key=="religion")
									{	
										
										echo ucfirst($key) .": {$value}<br />"; 
									}
									else if($key=="qual")
									{	
										/*
										echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ms")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="ht")
									{	
										
									/*	echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="wt")
									{	
										
									/*	echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="wrkp")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="city")
									{	
										
									/*	echo ucfirst($key) .": {$value}<br />"; */
									}
									else if($key=="sal")
									{	
										
										/* echo ucfirst($key) .": {$value}<br />"; */ /* meanin you are not displaying any of these */
										

									}
									else if($key=="email")
									{	/*
										$_SESSION['email']=$value;
										echo "<a href=\"Details.php\">Show more</a>";	
										*//*
										$em=$value;
										echo "<a href=\"Details.php?email={$em}\">Show more</a>"; */

										echo "<form method=\"post\" action=\"transaction.php\" style=\"
												top: 30px; left:20px; height:30px; width:30px; background: blue; \">
													<input type=\"submit\" name=\"Payment\" value=\"Read-more\">
												</form>";
										
									}








								/*}
								$str.="</p>
									</div>
									</div>
									</div>";
								echo $str; */
							}
								echo "
									</p>
									</div>
									</div>
									</div>";
								


							}

						}
						mysqli_free_result($res);
				
		}
	?>

</div>
<!--
<div class="options">
	<ol>
		<li><a href="../forms1.php">Logout</a></li>
		<li><a href="#">check</a></li>
	</ol>
</div>
-->
</body>
</html>
				