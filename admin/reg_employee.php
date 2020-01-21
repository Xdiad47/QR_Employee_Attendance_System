<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['email'])|| ($_SESSION['email']==''))
{
 
 header("Location:../index.php");
}
else {
     $id=$_SESSION['email'];
	 $name=$_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin | Employee REgistration </title>
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> Online</font><font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
              <li class="nav-item "><a class="nav-link" href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="department.php"><i class="fa fa-graduation-cap"></i> <span>Department</span></a></li>
              <li class="nav-item  btn-primary"><a class="nav-link" href="reg_employee.php"><i class="fa fa-users"></i> <span>Register Employee</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="emp_details.php"><i class="fa fa-book"></i> <span>Employee Details</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="report.php"><i class="fa fa-book"></i> <span>Attendance Report</span></a></li>
          </ul>
        </nav>  
    </div>
      <main class="main">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <strong>Admin:&nbsp;&nbsp;<?php echo $name; ?></strong>
          </li>
		  <li class="breadcrumb-item">
		  <strong>
			  <a  href="../logout.php"><i class="fa fa-key"></i> <span>Logout</span></a>
              </strong>
			  </li>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">
<div class="card">
<div class="card-header">
<strong>Employee Registration</strong></div>
<div class="card-body">
<div class="row">
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <form method="POST" action="#" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Department</strong></label>
                  <select class="form-control" name="dept">
				  <option>Select Department</option>
				  <?php 
					$query = "SELECT * FROM department ";
					$result=mysqli_query($conn, $query);
					while($row = mysqli_fetch_assoc($result))
						{
					?>
                    <hr>
                    <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['dept_name']; ?></option>
					<hr>
                    <?php
						}
						?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Employee Name</strong></label>
                  <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><strong>Phone Number</strong></label>
                  <input type="text" class="form-control" name="phone" id="exampleInputPassword1" placeholder="Ph No">
                </div>
              </div>
              <div class="form-group">
			  <label for="exampleInputEmail1"><strong>Gender</strong></label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="optionsRadios1" value="male">
                      <strong>Male</strong>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="optionsRadios2" value="female">
                      <strong>Female</strong>
                    </label>
                  </div>
                  
                </div>
            
          </div>
          </div>
		  <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            
              <div class="box-body">
			  <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Employee Designation</strong></label>
                  <select class="form-control" name="desig">
                    <option>Select Designation</option>
				  <?php 
					$querys = "SELECT * FROM designation ";
					$results=mysqli_query($conn, $querys);
					while($rows = mysqli_fetch_assoc($results))
						{
					?>
                    <hr>
                    <option value="<?php echo $rows['designation_id']; ?>"><?php echo $rows['designation_name']; ?></option>
					<hr>
                    <?php
						}
						?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Email address</strong></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><strong>Password</strong></label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="pass" placeholder="Password">
                </div>
				<div class="form-group">
                  <label for="exampleInputPassword1"><strong>Employee Salary</strong></label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="salary" placeholder="Salary">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile"><strong>Employee Photo</strong></label>
                  <input type="file" id="exampleInputFile" name="photo">
                </div>
              </div>
			  <p>
			  <?php
			  if(isset($_POST['register'])){
                $dept=$_POST['dept'];
				if(empty($dept)){
					echo "<p>Please Select Department</p>";
				}
				$desig=$_POST['desig'];
				if(empty($desig)){
					echo "<p>Please Select Designation</p>";
				}
				$name=$_POST['name']; 
				if(!preg_match("/^[a-zA-Z ]*$/",$name)){
					echo "<p>Name should contain only alphabet</p>";
				}
				$phone=$_POST['phone'];
				if(!preg_match("/^[0-9]*$/",$phone)){
					echo "<p>Enter Valid Phone number</p>";
				}
				$gen=$_POST['gender'];
				if(empty($gen)){
					echo "<p>Please Select gender</p>";
				}
				$email=$_POST['email'];
				if(!preg_match("/^[0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/",$email)){
					echo "<p>Please enter correct email</p>";
				}
				$pass=md5($_POST['pass']);
				if(empty($pass)){
					echo "<p>Please Enter Password</p>";
				}
				$salary=$_POST['salary'];
				if(!preg_match("/^[0-9]*$/",$salary)){
					echo "<p>Enter Salary in number</p>";
				}
				$image_extension = array("png","jpg","jpeg","PNG","JPG","JPEG");
				$validate_photo = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
				$photo = $_FILES['photo']['name'];
				$target = "../emp_photo/";		
				$fileTarget = $target.$photo;	
				$tempFileName = $_FILES["photo"]["tmp_name"];
				if ($_FILES["photo"]["size"] > 2097152) {
					   echo "<script> alert('Sorry, your File Size is too large. It Should Be less Then 2MB');</script>";
				   return;
				}
				else if (! in_array($validate_photo, $image_extension)) {
						
					  echo "<script> alert('Error..! Only image file allowed');</script>";
					   return; 
				}
				else{
				$result = move_uploaded_file($tempFileName,$fileTarget);
				$sql = "INSERT INTO employee_info(dept_id,designation_id,emp_name,emp_gender,emp_phone,emp_email,emp_password,emp_photo,emp_salary) VALUES ($dept,$desig,'$name','$gen',$phone,'$email','$pass','$fileTarget',$salary)";
				$query=mysqli_query($conn,$sql);
				if(!$query){
					echo "<script> alert('Not Registered');</script></p>";
				}
				else{
					echo "<script> alert('Employee Registered Successfully');</script>";
				}
				}
				}
				?>
			  </p>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="register">Register</button>
              </div>
            </form>
          </div>
          </div>
        </div>
		
</div>
</div>
<!-- /.col-->
</div>
  </div>

</main>
</div>
</body>
</html>
<?php
}
?>