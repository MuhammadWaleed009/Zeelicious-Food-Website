<?php
include_once 'connection.php';
$first=mysqli_real_escape_string($conn,$_POST['fname']);
$last=mysqli_real_escape_string($conn,$_POST['lname']);
$username=mysqli_real_escape_string($conn,$_POST['uname']);
$email=mysqli_real_escape_string($conn,$_POST['email']);
$pswd=mysqli_real_escape_string($conn,$_POST['password']);
if($email=="admin@zeelicious.com")
{
	echo "Cannot use this email";
}
else
{
	$sql="INSERT INTO _user(first,last,username,email,password) VALUES  ('".$first."','".$last."','".$username."','".$email."','".$pswd."')";
	if(mysqli_query($conn,$sql))
	{
		header("Location:login.php");
	}
}
?>