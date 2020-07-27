<?php
  session_start();
  $email=$password=$login_error="";
  function test_input($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }

  if($_SERVER["REQUEST_METHOD"]=="POST")
  { $valid="true"; 
    
    $email=$_POST["email"];
    $password=$_POST["password"];
    $a=0;
    //echo $email . " " . $password;
    
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
            $qry="select v.gender , v.contact , v.email from project.viewtable v , project.checktable c where v.email=('$email') and v.contact=c.contact and c.checkval=1 and v.password=('$password')";
            $res=mysqli_query($con,$qry);
           
            if(!$res)
            {
               echo("retrival failed".$res -> error);
            }
            $record=mysqli_num_rows($res);
            if($record==0)
            {
              $login_error="Invalid user name";
              $valid="false";
            }

             else
            {

               while($row=mysqli_fetch_assoc($res))
               {
                foreach ($row as $key => $value) {
                  
                    if($key=="gender")
                    {
                        $_SESSION['gender']=$value;
                    }
                    else if($key=="contact")
                    {
                      $_SESSION['contact']=$value;
                     }
                    else if($key=="email")
                   {
                      $_SESSION['email']=$value;
                    }

                    
                  }

              }
              if($valid && ($_SESSION['gender']!=="") && ($_SESSION['contact']!="") && ($_SESSION['email']!=""))
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
                     header("location:../display/Hitched.php");

                  }
                  else
                  {
                   header("location:../display/Hitched-prime.php"); 
                   
                  }




               
                exit(0);
              }


           }
           
         } 
        

  
  }
?>


<html>
<head>
<title> login form </title>
<link rel="stylesheet" type="text/css" href="../css/logextra.css">
</head>
<body>

<div class="container">
  <form action="" method="post" >
    <div class="row">
      <h2 style="text-align:center">Login with Social Media or Manually</h2>
      <div class="vl">
       <!-- <span class="vl-innertext">or</span> -->
      </div>

      <div class="col">
        <a href="#" class="fb btn">
          <i class="fa fa-facebook fa-fw"></i> Login with Facebook
        </a>
        <a href="#" class="twitter btn">
          <i class="fa fa-twitter fa-fw"></i> Login with Twitter
        </a>
        <a href="#" class="google btn">
          <i class="fa fa-google fa-fw"></i> Login with Google+
        </a>
      </div>

      <div class="col">
        <div class="hide-md-lg">
          <h2 style="text-align:center">Or sign in manually:</h2>
        </div>
        <span class="error2"><?= $login_error ?></span>
        <input type="email" name="email" placeholder="Email id" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
      </div>

    </div>
  </form>
</div>
<div class="Home">
    <button class="submit2" ><a href="../Welcome.php">Home</a></button>

  </div>

</body>
</html>