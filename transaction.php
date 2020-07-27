<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST")
{

	echo $_SESSION['MYEMAIL'];
	$email=$_SESSION['MYEMAIL'];
	/*  header("location:Finish-transa
	ction.php"); */


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
	 $q="select * from project.payment where email='$email' and permit=1;";
                  $r=mysqli_query($con,$q);
                  if(!$r)
                  {
                     echo("retrival failed".$r -> error);
                  }
                  $record=mysqli_num_rows($r);
                  if($record==0)
                  {
                     header("location:Finish-transaction.php");

                  }
                  else
                  {
                   header("location:../display/Hitched-prime.php"); 
                   
                  }
              }
}

?>