<?php
include_once 'connection.php';
$id=$_GET['id'];
$sql="Delete from mealplans where id='".$id."'";
if ($result=mysqli_query($conn,$sql))
{
	header("Location: Admin_ViewPlans.php");
}
else
{
	echo "<div class='alert-danger'>Deletion Failed!<div>";
}