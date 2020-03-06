<?php
include_once 'connection.php';
$rid=$_GET['rid']; 
foreach($_POST['procedures'] as $key => $value)
{	
	$sql="insert into procedures(receipe_id, pro_description) values ('".$rid."','".$value."')";
	if($result=mysqli_query($conn,$sql))
	{
		header("Location: index.php");
	}
}
?>