<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['staff'])|| ($_SESSION['staff']==''))
{
 
 header("Location:../index.php");
}
else {
     $id=$_SESSION['staff'];
     $sql="SELECT * FROM employee_info WHERE emp_email='$id'";
     $query=mysqli_query($conn, $sql);
	 $row=mysqli_fetch_assoc($query);
	 $name=$row['emp_name'];
	 $dept=$row['dept_id'];
	 $_SESSION['dept'] =$dept;
	  $_SESSION['name']=$name;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title>Supervisor | Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    <header class="app-header navbar">
       <a href="#"><h2><font color="blue"> QR</font>-<font color="gold">Attendance</h2></font></font></a>
    </header>
    <div class="app-body">
      <div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
              <li class="nav-item  btn-primary"><a class="nav-link" href="index.php"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>  
          </ul>
        </nav>  
      </div>
      <main class="main">
         <ol class="breadcrumb">
          
          <li class="breadcrumb-item">
              <strong>
			  <a  href="../logout.php"><i class="fa fa-key"></i> <span>Logout</span></a>
              </strong>  
          </li>
          </ol>
                   
        <div class="container-fluid">
          <div class="animated fadeIn">
              <div class="row">
                <table  class="table table-bordered table-striped">
                <thead>
                <tr style="background-color:white;">
                  
                  <th><center>Register Employee<center>
				  <h3><i class="fa fa-user-plus"></i></h3>
				  <a href="reg_employee.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </th>
				  <th><center>Employee Details<center>
				  <h3><i class="fa fa-book"></i></h3>
				  <a href="emp_details.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </th>
				  <th><center>Attendance Report<center>
				  <h3><i class="fa fa-book"></i></h3>
				  <a href="report.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				  </th>
				  
                </tr>
				<tr style="background-color:white;">
				<th><center>Take Attendance<center>
				  <h3><i class="fa fa-search"></i></h3>
				  <form method="POST" action="#">
				  <button class="btn btn-danger" type="submit" name="scan">Scan QR <i class="fa fa-arrow-circle-right"></i></button>
				  </form>
				  </th>
				  </tr>
                </thead>
				<?php
				if(isset($_POST['scan'])){
					$_SESSION['employee']=$id;
					$_SESSION['employee_dept']=$dept;
					?>
					<script>
					window.location.href="../scans.php";
					</script>
					<?php
				}
				?>
                </table>
              </div>            
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



