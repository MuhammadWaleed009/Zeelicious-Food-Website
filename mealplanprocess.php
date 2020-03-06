<?php 
include_once 'connection.php';
$weeks=$_GET['weeks'];
$temp=$weeks+1;
$mid=$_GET['mid'];
$sql="select * from mealplans where id='".$mid."'";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$category=$row['category'];
$_POST['a10'];
$_POST['a11'];
$_POST['a12'];
$_POST['a13'];
$_POST['a14'];
$_POST['a15'];
$_POST['a16'];
$sql1="INSERT INTO mealplan_table(mealplans_id,name,week,Day,beforeBreakfast,breakfast,midDaySnack,lunch,eveningSnack,dinner,calories)
		VALUES('".$mid."','".$category."','".$temp."','Monday','".$_POST['a10']."','".$_POST['a11']."','".$_POST['a12']."','".$_POST['a13']."','".$_POST['a14']."','".$_POST['a15']."','".$_POST['a16']."'),
			
				('".$mid."','".$category."','".$temp."','Tuesday','".$_POST['a20']."','".$_POST['a21']."','".$_POST['a22']."','".$_POST['a23']."','".$_POST['a24']."','".$_POST['a25']."','".$_POST['a26']."'),
				
				('".$mid."','".$category."','".$temp."','Wednesday','".$_POST['a30']."','".$_POST['a31']."','".$_POST['a32']."','".$_POST['a33']."','".$_POST['a34']."','".$_POST['a35']."','".$_POST['a36']."'),
				
				('".$mid."','".$category."','".$temp."','Thursday','".$_POST['a40']."','".$_POST['a41']."','".$_POST['a42']."','".$_POST['a43']."','".$_POST['a44']."','".$_POST['a45']."','".$_POST['a46']."'),
				
				('".$mid."','".$category."','".$temp."','Friday','".$_POST['a50']."','".$_POST['a51']."','".$_POST['a52']."','".$_POST['a53']."','".$_POST['a54']."','".$_POST['a55']."','".$_POST['a56']."'),
				
				('".$mid."','".$category."','".$temp."','Saturday','".$_POST['a60']."','".$_POST['a61']."','".$_POST['a62']."','".$_POST['a63']."','".$_POST['a64']."','".$_POST['a65']."','".$_POST['a66']."'),
				
				('".$mid."','".$category."','".$temp."','Sunday','".$_POST['a70']."','".$_POST['a71']."','".$_POST['a72']."','".$_POST['a73']."','".$_POST['a74']."','".$_POST['a75']."','".$_POST['a76']."')
		";
if($result1=mysqli_query($conn,$sql1))
{
	header("Location: Admin_AddMealTable.php?mid=".$mid."&weeks=".$weeks);
}
if($weeks==0)
{
	header("Location: index.php");
}