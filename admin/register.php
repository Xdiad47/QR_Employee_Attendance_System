<?php
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
				$gen=$_POST['gen'];
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
						
					  echo "<script> alert('Error..........! Only image file allowed');</script>";
					   return; 
				}
				else{
				$result = move_uploaded_file($tempFileName,$fileTarget);
				$sql = "INSERT INTO employee_info(dept_id,designation_id,emp_name,emp_gender,emp_phone,emp_email,emp_password,emp_photo,emp_salary) VALUES ($dept,$desig,'$name','$gender',$phone,'$email','$pass','$fileTarget',$salary)";
				$query=mysqli_query($conn,$sql);
				if(!$query){
					echo "<p>Error in Addding Department </p>";
				}
				else{
					echo "<script> alert('Employee Registered Successfully');</script>";
				}
				}
				?>