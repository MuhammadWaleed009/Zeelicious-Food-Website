<?php
include_once 'connection.php';
$id=$_GET['id'];
$sql="Delete from products where id='".$id."'";
if ($result=mysqli_query($conn,$sql))
{
	header("Location: Admin_ViewProduct.php");
}
else
{
	echo "<div class='alert-danger'>Deletion Failed!<div>";
}