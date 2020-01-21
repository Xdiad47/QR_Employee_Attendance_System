<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Verification | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/AdminLTE.min.css">
  <link rel="stylesheet" href="css/_all-skins.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-color:maroon;">
<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><font color="white">Online Attendance</font></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Enter OTP that has send to your mail</p>

    <form action="#" method="POST">
      <div class="form-group has-feedback">
        <input type="email" class="form-control"name="email" placeholder="Email" value="<?php session_start(); echo $_SESSION['email'];?>" required readonly>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="otp" placeholder="OTP" maxlength="4" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <?php
	  
		if(isset($_POST['validate'])){
class verify
{
    public $email;
    public $otp;
	function getAdmin($a,$b)
	{
            include 'connect.php';
            $this->email=$a;
            $this->otp=$b;
            $sql="SELECT * from super_admin WHERE email_id='$this->email' and otp='$this->otp'";
            $query=mysqli_query($conn, $sql);
				$checkuser=mysqli_num_rows($query);
				if($checkuser==1){ 
				$_SESSION['email']=$this->email;
				header("Location:resetpass.php");
			}
			else{
				echo "OTP didn't match";
			}
		
	}
       function getUser($a,$b)
	{
            include 'connect.php';
            $this->email=$a;
            $this->otp=$b;
            $sql="SELECT * from employee_info WHERE emp_email='$this->email' and otp='$this->otp'";
            $query=mysqli_query($conn, $sql);
				$checkuser=mysqli_num_rows($query);
				if($checkuser==1){ 
				$_SESSION['email']=$this->email;
				header("Location:resetpass.php");
			}
			else{
				echo "OTP didn't match";
			}
		
	}
    
}
$email=$_POST["email"];
$otp=$_POST["otp"];
$re= new verify(); 	
$re->getAdmin($email,$otp);
$re->getUser($email,$otp);
    }    
 ?>
      <div class="row">
        
		<div class="col-xs-12">
          <button type="submit" class="btn btn-block btn-social btn-facebook btn-flat" name="validate" >
		   <i class="fa fa-key"></i> Verify
		  </button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	 
  </div>
  
</div>

  
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
