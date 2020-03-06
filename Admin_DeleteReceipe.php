<?php
include_once 'connection.php';
$id=$_GET['id'];
$sql1="Delete from ingredients where receipe_id='".$id."'";
$sql2="Delete from procedures where receipe_id='".$id."'";
$sql3="Delete from receipe where id='".$id."'";
if ($result=mysqli_query($conn,$sql1))
{
	if ($result=mysqli_query($conn,$sql2))
	{
		if ($result=mysqli_query($conn,$sql3))
		{
			header("Location: Admin_ViewReceipe.php");
		}
	}
}
else
{
	echo "<div class='alert-danger'>Deletion Failed!<div>";
}