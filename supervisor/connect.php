<?php
$conn=mysqli_connect("localhost","root","");
if(!$conn)
{
    die(" opps Database connection Failed!!!".mysqli_connect_errno());
}
$select_db=mysqli_select_db($conn,"marakpvt");
if(!$select_db)
{
    die("Database selection failed!!");
    mysqli_connect_errno();
    
}
?>