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
	 $dpt=$_SESSION['dept'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Supervisor | Employee Details </title>
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
              <li class="nav-item    "><a class="nav-link" href="emp_details.php"><i class="fa fa-book"></i> <span>Employee Details</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="report.php"><i class="fa fa-book"></i> <span>Attendance Report</span></a></li>
          </ul>
        </nav>  
    </div>
      <main class="main">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
              <strong>Admin:&nbsp;&nbsp;<?php echo $name; ?></strong>
          </li>
		  <strong>
			  <a  href="../logout.php"><i class="fa fa-key"></i> <span>Logout</span></a>
              </strong>
        </ol>
        <div class="container-fluid">
            <div class="animated fadeIn">

<div class="card">
<div class="card-header">
	<i class="fa fa-align-justify"></i>Employee attendence</div>
  <div class="card-body">
<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btnExport" class="btn" value="download">
            <i class="fa fa-download"></i> Generate PDF
          </button>
	<table class="table table-responsive-sm table-bordered table-striped table-sm " id="tblCustomers" cellspacing="0" cellpadding="0">
	  <thead>
		<tr>
		  <th><center>Emp ID</center></th>
		  <th><center>Emp Name</center></th>
		  <th><center>Time In</center></th>
		  <th><center>Time Out</center></th>
		  <th ><center>Date</center></th>
		</tr>
	  </thead>
	  <tbody>
		<?php 
		$desid=2;
		$dpt=$_SESSION['dept'];
		$emp="SELECT * from employee_info WHERE dept_id=$dpt and designation_id=$desid";
		$results=mysqli_query($conn, $emp);
		$check=mysqli_num_rows($results);
		if($check==1){
			$rows = mysqli_fetch_assoc($results);
			$emp_id=$rows['emp_id'];
			$query = "SELECT * FROM employee_attendance where emp_id IN($emp_id)";
			$result=mysqli_query($conn, $query);
			
			while($row = mysqli_fetch_assoc($result))
				{
			?>

		<tr>
			<td ><?php echo $row['emp_id']; ?></td>
			<td><?php 
			$eid=$row['emp_id'];
			$querys = "SELECT * FROM employee_info Where emp_id=$eid";
			$results=mysqli_query($conn, $querys);
			$rows = mysqli_fetch_assoc($results);
			echo $rows['emp_name'];
			?></td>
			<td >
			<?php echo $row['emp_time_in']; ?>
			</td>
			<td ><?php echo $row['emp_time_out']; ?></td>
			<td ><?php echo $row['atten_date']; ?></td>
			
		</tr>
		<?php 
				   }
		}
		else{
			?>
		<tr>
		<td colspan="5">No Attendance Found</td>
		</tr>
			<?php	
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
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script type="text/javascript">
        $("body").on("click", "#btnExport", function () {
            html2canvas($('#tblCustomers')[0], {
                onrendered: function (canvas) {
                    var data = canvas.toDataURL();
                    var docDefinition = {
                        content: [{
                            image: data,
                            width: 500
                        }]
                    };
                    pdfMake.createPdf(docDefinition).download("attendance.pdf");
                }
            });
        });
    </script>
</body>
</html>
<?php
}
?>