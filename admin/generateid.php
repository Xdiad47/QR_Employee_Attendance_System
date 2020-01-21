<?php
session_start();
include '../connect.php';
if(!isset($_SESSION['email'])|| ($_SESSION['email']==''))
{
 
 header("Location:../index.php");
}
else {
    $data=$_GET["id"];
if(count($_POST)){
  include "qr.php";
  $qr = new BarcodeQR();

  if(isset($_POST['url'])){
    $qr->bookmark($_POST['url']);
  
  }elseif(isset($_POST['only_url'])){
    $qr->url($_POST['only_url']);
  }
}
$size = array('5'=>'232','6'=>'290');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Admin | QR Code </title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap.min.js"></script>
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
              <li class="nav-item"><a class="nav-link" href="department.php"><i class="fa fa-graduation-cap"></i> <span>Department</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="reg_employee.php"><i class="fa fa-users"></i> <span>Register Employee</span></a></li>
              <li class="nav-item   btn-primary "><a class="nav-link" href="emp_details.php"><i class="fa fa-book"></i> <span>Employee Details</span></a></li>
              <li class="nav-item  "><a class="nav-link" href="report.php"><i class="fa fa-book"></i> <span>Attendance Report</span></a></li>
          </ul>
        </nav>  
    </div>
      <main class="main">
          <ol class="breadcrumb">
		  
              <li class="breadcrumb-item">
		  <a href="logout.php">Logout</a>
              </li>
          </ol>
        <div class="container-fluid">
          <div class="animated fadeIn">
              <div class="row">
                  <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
            <h5>Generate QR code ID</h5>
          </div>
          <div class="widget-content nopadding">
            <form action="" method="POST" class="form-horizontal">
                <div class="control-group">
              <div class="controls" hidden>
                  
                  <input type="text" hidden name="url" value='<?php   $data=base64_encode($_GET["id"]); $ul="http://localhost/onlineattendance/processing.php?employee=$data";echo $ul;  ?>' >
              </div>
            </div>
            
              
              
                <button type="submit" class="btn btn-info"><i class="icon-qrcode"></i>Generate QR</button><br>
				<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;" id="btnExport" class="btn" value="download">
                   <i class="fa fa-download"></i> Generate PDF
                </button>
				<table class="table table-responsive-sm table-bordered table-striped table-sm" id="tblCustomers" cellspacing="0" cellpadding="0" style="background-color:blue;">
				  <thead>
					<tr>
					  <th colspan="2"><center>Marak Pvt Ltd. Identification</center></th>
					</tr>
					<?php
					$i=base64_decode($data);
					$query = "SELECT * FROM employee_info ";
			        $result=mysqli_query($conn, $query);
			        $row = mysqli_fetch_assoc($result);
					?>
					<tr>
					<td style="height:100px; width:100px;"><img src="<?php echo $row['emp_photo']; ?>" style="height:100px; width:100px;" ></td>
					
					<td >
					<?php if(count($_POST)){
                    
						$img = "qrcode".time().".png";
						if(!isset($_POST['img_size'])) $_POST['img_size'] = 174;
						$qr->generate($_POST['img_size'], "qrimage/".$img);?>
						  
                          <img src="qrimage/<?php echo $img?>" style="float:right;" width="<?php echo $_POST['img_size']?>" height="<?php echo $_POST['img_size']?>" >
						<?php } 
                    ?>
					
					</td>
					
					</tr>
					<tr>
					    <td colspan="2"><strong>
						<?php
						echo $row['emp_name']."<br>";
						echo $row['emp_email']."<br>";
						$dept=$row['dept_id'];
						$querys = "SELECT * FROM department where dept_id=$dept";
						$results=mysqli_query($conn, $querys);
						$rows = mysqli_fetch_assoc($results);
						echo $rows['dept_name'];
						?></strong</td>
					</tr>
                 </thead>
                </table>
            </form>
            </div>
          </div>
    </div>
                  
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
                    pdfMake.createPdf(docDefinition).download("<?php echo $row['emp_name'];?>.pdf");
                }
            });
        });
    </script>
    </body>
</html>

<?php
}
?>