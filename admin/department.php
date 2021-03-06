<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['email'])|| ($_SESSION['email']==''))
{
 
 header("Location:../index.php");
}
else {
     $id=$_SESSION['email'];
	 $name= $_SESSION['name'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin | department </title>
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
              <li class="nav-item  btn-primary"><a class="nav-link" href="department.php"><i class="fa fa-graduation-cap"></i> <span>Department</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="reg_employee.php"><i class="fa fa-users"></i> <span>Register Employee</span></a></li>
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
<strong>Enter Department</strong></div>
<div class="card-body">
<form class="form-inline" action="" method="POST">
<div class="form-group">
<input class="form-control"  type="text" name="deptname" placeholder="Enter New Department">
</div>
<?php
include("../connect.php");
if(isset($_POST['dept'])){
	$dept=$_POST['deptname'];
	$sql = "INSERT INTO department(dept_name) VALUES ('$dept')";
	$query=mysqli_query($conn,$sql);
	if(!$query){
		echo "<p>Error in Addding Department </p>";
	} 
	
}
?>
</div>
<div class="card-footer">
<button class="btn btn-sm btn-primary" type="submit" name="dept" >
<i class="fa fa-dot-circle-o"></i> Submit</button>

</form>
</div>
<div class="card">
<div class="card-header">
	<i class="fa fa-align-justify"></i>All Department</div>
  <div class="card-body">
	<table class="table table-responsive-sm table-bordered table-striped table-sm">
	  <thead>
		<tr>
		  <th>Sl.no</th>
		  <th>Department</th>
		  <th>Action</th>
		</tr>
	  </thead>
	  <tbody>
		<?php 
			$query = "SELECT * FROM department ";
			$result=mysqli_query($conn, $query);
			$num=1;
			while($row = mysqli_fetch_assoc($result))
				{
			?>

		<tr>
			<td hidden><?php echo $row['dept_id']; ?></td>
			<td style="width:20%"><?php echo $num; ?></td>
			<td style="width:60%"><?php echo $row['dept_name']; ?></td>
			<td style="width:20%"><a class="btn btn-primary" href="admin/updatedept.php?id=<?php echo $row['dept_id']; ?>">Update</a></td>
		</tr>
		<?php 
			$num++; 
				   }
				
				   
		?>

	  </tbody>
	</table>
	
  </div>
</div>
</div>
<!-- /.col-->
</div>
  </div>
</div>
</main>
</div>
</body>
</html>
<?php
}
?>