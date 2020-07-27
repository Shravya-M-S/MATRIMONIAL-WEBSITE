<?php
$login_error="";

?>



<!DOCTYPE html>
<html>
<head>
	<title>Verify yourself</title>
	<meta name="viewport" content="user-scalable=no,width=device-width">
	<link rel="stylesheet" type="text/css" href="/css/verify.css">
</head>
<body onload="document.adminverify.email.focus()">
	<div class="login-box">
		<img src="../images/log.jpg" class="avatar">
		<h1>verify here</h1>
	<form name="adminverify" action="#" method="POST">
		<p> Admin's email</p>
			
			<span><?= $login_error ?></span>
			<input type="email" name="email" id="email" placeholder="Enter admini's email" />
			<br>
			<p>Password</p>
			
			<input type="password" name="password" id="password" placeholder="Enter password" />
			<br>
			<input type="submit" name="submit"  value="submit"  />

		
	</form>

	<?php
	$email=$password="";
	function test_input($data)
	{
		$data=trim($data);
		$data=stripslashes($data);
		$data=htmlspecialchars($data);
		return $data;
	}
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	$valid="false";
		if(empty($_POST["email"]))
		{
			$email_err="email is required";
			$valid="false";
					
		}
		else
		{
			$email = test_input($_POST["email"]);
					
			if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
			{
				$email_err="invalid email id format ";
				$valid="false";
						
			}
		}
		if($valid)
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
			else
			{
				//echo "chalo db connected";
				
				$password=test_input($_POST["password"]);
				$email = test_input($_POST["email"]);

				//echo $password ." " . $email;
				
				$qry="select * from project.adminverify";
				$res=mysqli_query($con,$qry);
				if(!$res)
				{
					echo "error " . $con -> error;
				}
				$record=mysqli_num_rows($res);
            	if($record==0)
	            {
	              $login_error="Invalid user name";
	              $valid="false";
	            }
				else{
					$count=1;

					while($row=mysqli_fetch_assoc($res))
					{
						foreach ($row as $key => $value) {
							
							if($count==1)
							{
								$value1=$value;
								$count++;
							}
							else
							{
								$value2=$value;
								break;
							}
							
							
							
						}
					}
					if($value1==$email)
					{
						if($value2==$password)
						{
							//echo "login permitted";
							header("location:adminlog.php");
						}
					}
					else
					{
						echo "wrong wrong dont u dare!!!";
								
					} 
				} 
			}
		}
	}
	?>

</div>
</body>
</html>