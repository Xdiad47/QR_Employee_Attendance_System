<!DOCTYPE html>
<html lang="en">

<head>
	<title>Processing......</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<style>
		.prog {
			height: 150px;
		}

		.prog1 {
			height: 150px;
		}

		.proc {
			height: 415px;
			background-color: green;
		}
	</style>
</head>

<body>
	<div class="progress prog">
		<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%"></div>
	</div><?php
			date_default_timezone_set("Asia/kolkata");

			include("connect.php");
			session_start();

			if (isset($_SESSION['adminstrative']) || isset($_GET['employee'])) {
				$s_email = $_SESSION['adminstrative'];
				$employee = $_GET['employee'];
				$e_id = base64_decode($employee);
				$select_employee_id = "select * from employee_info where emp_id=$e_id";
				$run_query = mysqli_query($conn, $select_employee_id);
				$checkuser = mysqli_num_rows($run_query);
				if ($checkuser == 0) {
			?><div class="col-md-12 col-sm-12 proc">
				<div class="row justify-content-center">
					<div class="col-md-6">
						<div class="clearfix">
							<h4 class="pt-3">Un-Authorized Access</h4>
							<p class="text-muted">Access to this page is forbidden</p><a class="btn btn-warning btn-big" href="scans.php">Scan Your Code First</a>
						</div>
					</div>
				</div>
			</div>
			<?php
				} else {
					$get = mysqli_fetch_assoc($run_query);
					$today_date = date("Y-m-d");
					$time_in = date("Y-m-d h:i:sa");
					$get_id = $get['emp_id'];
					$cheack_attendance = "SELECT * FROM employee_attendance WHERE emp_id=$get_id and atten_date='$today_date'";
					$execute = mysqli_query($conn, $cheack_attendance);
					$get_attendance = mysqli_num_rows($execute);
					if ($get_attendance == 0) {
						$check_in = "INSERT INTO employee_attendance (emp_id,emp_time_in,atten_date) VALUES ($get_id,'$time_in','$today_date')";
						$req_checkin = mysqli_query($conn, $check_in);
						if ($req_checkin) {
			?><script type="text/javascript">
						if (confirm("Attendance Taken")) {
							window.location.href = "scans.php";
						}
					</script><?php
							} else {
								?><script type="text/javascript">
						if (confirm("Please Scan Again")) {
							window.location.href = "scans.php";
						}
					</script><?php
							}
						} else if ($get_attendance == 1) {
							$time_out = date("Y-m-d h:i:sa");
							$update_attendance = "UPDATE employee_attendance SET emp_time_out='$time_out' WHERE emp_id=$get_id";
							$req_checkout = mysqli_query($conn, $update_attendance);
							if ($req_checkout) {
								?><script type="text/javascript">
						if (confirm("Checked Out")) {
							window.location.href = "scans.php";
						}
					</script><?php
							} else {
								?><script type="text/javascript">
						if (confirm("Please Scan Again")) {
							window.location.href = "scans.php";
						}
					</script><?php
							}
						}
					}
				} else if (isset($_SESSION['employee']) && isset($_SESSION['employee_dept'])) {
					$employee = $_GET['employee'];

					$e_id = base64_decode($employee);
					$select_employee_id = "select * from employee_info where emp_id=$e_id";
					$run_query = mysqli_query($conn, $select_employee_id);
					$checkuser = mysqli_num_rows($run_query);
					if ($checkuser == 0) {
						$get = mysqli_fetch_assoc($run_query);
						$get_id = $get['emp_id'];
						$sup_dept = $_SESSION['employee_dept'];
						$emp_dept = $get['dept_id'];
						if ($sup_dept !== $emp_dept) {
								?><div class="col-md-12 col-sm-12 proc">
					<div class="col-md-3 col-sm-3"></div>
					<div class="row justify-content-center">
						<div class="col-md-6">
							<div class="clearfix">
								<h4 class="pt-3">Sorry Attendance Cannot be taken</h4>
								<p class="text-muted">Employee Didnt Match</p><a class="btn btn-warning btn-big" href="scans.php">Scan Again</a>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3"></div>
				</div><?php
						}
						if ($sup_dept == $emp_dept) {
							$today_date = date("Y-m-d");
							$time_in = date("Y-m-d h:i:sa");
							$cheack_attendance = "SELECT * FROM employee_attendance WHERE emp_id=$get_id and atten_date='$today_date'";
							$execute = mysqli_query($conn, $cheack_attendance);
							$get_attendance = mysqli_num_rows($execute);
							if ($get_attendance == 0) {
								$check_in = "INSERT INTO employee_attendance (emp_id,emp_time_in,atten_date) VALUES ($get_id,'$time_in','$today_date') WHERE emp_id=$get_id";
								$req_checkin = mysqli_query($conn, $check_in);
								if ($req_checkin) {
						?><script type="text/javascript">
							if (confirm("Attendance Taken")) {
								window.location.href = "scans.php";
							}
						</script><?php
								} else {
									?><script type="text/javascript">
							if (confirm("Please Scan Again")) {
								window.location.href = "scans.php";
							}
						</script><?php
								}
							} else if ($get_attendance == 1) {
								$time_out = date("Y-m-d h:i:sa");
								$update_attendance = "UPDATE employee_attendance SET emp_time_out='$time_out' WHERE emp_id=$get_id";
								$req_checkout = mysqli_query($conn, $update_attendance);
								if ($req_checkout) {
									?><script type="text/javascript">
							if (confirm("Checked Out")) {
								window.location.href = "scans.php";
							}
						</script><?php
								} else {
									?><script type="text/javascript">
							if (confirm("Please Scan Again")) {
								window.location.href = "scans.php";
							}
						</script><?php
								}
							}
						}
					}
				} else {
									?><div class="col-md-12 col-sm-12 proc">
			<div class="row justify-content-center">
				<div class="col-md-3 col-sm-3"></div>
				<div class="col-md-6">
					<div class="clearfix">
						<h4 class="pt-3">Un-Authorized Access</h4>
						<p class="text-muted">Access to this page is forbidden</p><a class="btn btn-warning btn-big" href="scans.php">Please Try Again</a>
					</div>
				</div>
				<div class="col-md-3 col-sm-3"></div>
			</div>
		</div><?php

				}
				?><div class="progress prog">
		<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%"></div>
	</div>
</body>

</html>