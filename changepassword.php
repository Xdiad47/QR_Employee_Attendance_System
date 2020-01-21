<?php
class password
{
    public $pass;
    public $email;
    public $otp;
	function getAdmin($a,$b,$c)
	{
            include 'connect.php';
            $this->email=$a;
            $this->pass=$b;
            $this->otp=$c;
            $updates = "UPDATE super_admin SET password = '$this->pass', otp=$this->otp where email_id='$this->email' ";
            $passwords=mysqli_query($conn, $updates);
            if($passwords){
            ?>
            <script type="text/javascript">
            if(confirm("Reset Password successfully")){
              window.location.href="index.php";}
            </script>
            <?php
            }
            else{
                ?>
            <script type="text/javascript">
            if(confirm("unable to change password")){
              window.location.href="index.php";}
            </script>
                <?php
            }
            
	}
        function getUsers($a,$b,$c)
        {
            include 'connect.php';
            $this->email=$a;
            $this->pass=$b;
            $this->otp=$c;
            $update = "UPDATE employee_info SET emp_password = '$this->pass', otp=$this->otp where emp_email='$this->email' ";
            $password=mysqli_query($conn, $update);
            if($password){
				
            ?>
            <script type="text/javascript">
            if(confirm("Reset Password successfully")){
              window.location.href="index.php";}
            </script>
            <?php
            }
            else{
                ?>
            <script type="text/javascript">
            if(confirm("unable to change password")){
              window.location.href="index.php";}
            </script>
                <?php
            }
            
	}
    
}

$re= new password(); 	
session_start();
$otp=0;
$email=$_SESSION['email'];
$pass=md5($_POST["pass"]);
$cpass=md5($_POST["cpass"]);
if($pass!=$cpass){
            echo "<p>Password Did not Match </p>";
    }
    else {
        $re->getAdmin($email,$pass,$otp);
        $re->getUsers($email,$pass,$otp);
        
    }
 ?>