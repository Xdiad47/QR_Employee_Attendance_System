<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['staff'])|| ($_SESSION['staff']==''))
{
 
 header("Location:../index.php");
}
else {
     $id=$_SESSION['staff'];
	 $name=$_SESSION['name'];
	 $emp_id=base64_decode($_GET['id']);
	 $query = "SELECT * FROM employee_info WHERE emp_id=$emp_id";
	 $result=mysqli_query($conn, $query);
	 $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Supervisor | Employee REgistration </title>
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
              
              <li class="nav-item  "><a class="nav-link" href="reg_employee.php"><i class="fa fa-users"></i> <span>Register Employee</span></a></li>
              <li class="nav-item  btn-primary"><a class="nav-link" href="emp_details.php"><i class="fa fa-book"></i> <span>Employee Details</span></a></li>
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
<strong>Update Employee</strong></div>
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
				  <?php 
				    $dpt=$_SESSION['dept'];
					$querys = "SELECT * FROM department";
					$results=mysqli_query($conn, $querys);
					while($rows = mysqli_fetch_assoc($results))
						{
					?>
                    <hr>
                    <option value="<?php echo $rows['dept_id']; ?>
					 "><?php echo $rows['dept_name']; ?></option>
					<hr>
                    <?php
						}
						?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"><strong>Phone Number</strong></label>
                  <input type="text" class="form-control" name="phone" id="exampleInputPassword1" value="<?php echo $row['emp_phone'];?>" placeholder="Ph No">
                </div>
				<div class="form-group">
                  <label for="exampleInputPassword1"><strong>Employee Salary</strong></label>
                  <input type="text" class="form-control" id="exampleInputPassword1" name="salary" value="<?php echo $row['emp_salary'];?>" placeholder="Salary">
                </div>
                
              </div>       
              
			  <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Employee Designation</strong></label>
                  <select class="form-control" name="desig">
                    
				  <?php 
				    $des=$row['designation_id'];
					$qu = "SELECT * FROM designation";
					$res=mysqli_query($conn, $qu);
					while($ro = mysqli_fetch_assoc($res))
						{
					?>
                    <hr>
                    <option value="<?php echo $ro['designation_id']; ?>" <?php if($ro['designation_id']==$row['designation_id']){ echo 'selected'; } ?>><?php echo $ro['designation_name']; ?></option>
					<hr>
                    <?php
						}
						?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1"><strong>Email address</strong></label>
                  <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $row['emp_email'];?>" name="email" placeholder="Enter email">
                </div>
				
              </div>
			  <p>
			  <?php
			  if(isset($_POST['update'])){
                $dept=$_POST['dept'];
				if(empty($dept)){
					echo "<p>Please Select Department</p>";
				}
				$desig=$_POST['desig'];
				if(empty($desig)){
					echo "<p>Please Select Designation</p>";
				}
				$phone=$_POST['phone'];
				if(!preg_match("/^[0-9]*$/",$phone)){
					echo "<p>Enter Valid Phone number</p>";
				}
				$email=$_POST['email'];
				if(!preg_match("/^[0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/",$email)){
					echo "<p>Please enter correct email</p>";
				}
				$salary=$_POST['salary'];
				if(!preg_match("/^[0-9]*$/",$salary)){
					echo "<p>Enter Salary in number</p>";
				}
				else{
				
				$sql = "UPDATE  employee_info SET dept_id='$dept',designation_id='$desig',emp_phone='$phone',emp_email='$email',emp_salary='$salary' Where emp_id=$emp_id";
				$query=mysqli_query($conn,$sql);
				if(!$query){
					echo "<script> alert('Not Updated');</script></p>";
				}
				else{
					echo "<script> alert('Employee Updated Successfully');</script>";
				}
				}
				}
				?>
			  </p>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="update">Update</button>
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