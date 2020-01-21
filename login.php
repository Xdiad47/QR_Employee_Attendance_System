<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login | Signup</title>
</head>
<body style="background-color:blue;">
    <div id="logreg-forms" >
        <form class="form-signin" method="POST" action="#">
            <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Log-in</h1>
            
           
            <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email @" required="" autofocus="">
            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required="">
            
            <button class="btn btn-success btn-block" name="getin" type="submit"><i class="fas fa-sign-in-alt"></i> Let Me In</button>
            <a href="forget.php" id="forgot_pswd">Forgot password?</a>
            <hr>
            
            </form>
        <br>
        
<p>
 <?php
 
session_start();
if(isset($_POST['getin'])){
class login
{
    public $pass;
    public $email;
	public $des_id;
    function getAdmin($a,$b)
	{
            include 'connect.php';
            $this->email=$a;
            $this->pass=$b;
            $sql="SELECT * FROM super_admin WHERE email_id='$this->email' and password='$this->pass'";
            $loginquery=mysqli_query($conn, $sql);
            $checkuser=mysqli_num_rows($loginquery);
            if($checkuser==1){ 
            $_SESSION['email']=$this->email;
            header("Location:admin/index.php");
            }
			else{
				?>
				<script>alert("Email or password didnt match");</script>
				<?php
			}
		}
        function getStaff($a,$b,$c)
        {
            include 'connect.php';
            $this->email=$a;
            $this->pass=$b;
            $this->des_id=$c;
            $sql="SELECT * from employee_info WHERE emp_email='$this->email' and emp_password='$this->pass' and designation_id=$this->des_id";
            $loginquery=mysqli_query($conn, $sql);
            $checkuser=mysqli_num_rows($loginquery);
            if($checkuser==1){ 
            $_SESSION['staff']=$this->email;
            header("Location:supervisor/index.php");
            }
			else{
				?>
				<script>aleart("Email or password didnt match");</script>
				<?php
			}
	}
     
}
$re= new login(); 	
$pass= md5($_POST["password"]);
$email=$_POST["email"];
$des=1;
$des_id=$des;
$re->getAdmin($email,$pass);
$re->getStaff($email,$pass,$des_id);

}
 ?>
</p>
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>