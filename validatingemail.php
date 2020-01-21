
<?php
session_start();
class forget
{
	public $email;
	 function getAdmin($a)
	{
		 include 'connect.php';
			$this->email=$a;
			$sql="SELECT * from super_admin WHERE email_id='$this->email'";
			$res = mysqli_query($conn, $sql);
			 $row=mysqli_num_rows($res);
			if($row == 1){
			$r = mysqli_fetch_assoc($res);
			$otp=rand(0000,9999);
			$to = $r['email_id'];
			$_SESSION['email']=$to;
		    $id = $r['admin_id'];
			$subject = "Password Recovery";
			$message = "Please use this OTP to Verify " ."[".$otp."]";
			$update = "UPDATE super_admin SET otp = '$otp' where admin_id=$id";
			if(mysqli_query($conn, $update)){
			if(mail($to, $subject, $message)){
			 ?><script type="text/javascript">
			if(confirm("Enter OTP as Password That Has Sent To Your Mail")){
			  window.location.href="verify.php";}
			</script>
	  <?php
}}}}
		function getUsers($a){	
			include 'connect.php';
			$this->email=$a;
			$sql="SELECT * from  employee_info WHERE emp_email='$this->email'";
			$res = mysqli_query($conn, $sql);
			 $row=mysqli_num_rows($res);
			if($row == 1){
			$r = mysqli_fetch_assoc($res);
			$otp=rand(0000,9999);
		    $to = $r['emp_email'];
			$id= $r['emp_id'];
			$_SESSION['email']=$to;
			$subject = "Password Recovery";
			$message = "Please use this OTP to Verify " ."[".$otp."]";
			$update = "UPDATE employee_info SET otp = '$otp' where emp_id=$id";
			if(mysqli_query($conn, $update)){
			if(mail($to, $subject, $message)){
			 ?><script type="text/javascript">
			if(confirm("Enter OTP as Password That Has Sent To Your Mail")){
			  window.location.href="verify.php";}
			</script>
	  <?php
		}}}}
		
}

$email=$_POST["email"];
if(!preg_match("/^[0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/",$email)){
	 echo "<p>Please enter correct email</p>";
  }
  else{
$re= new forget();
$re->getAdmin($email);
$re->getUsers($email);

  }
 
?>		  
