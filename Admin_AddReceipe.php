<?php
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    include_once'connection.php';
   $tit=mysqli_real_escape_string($conn,$_POST['title']);
   $dat=mysqli_real_escape_string($conn,$_POST['date']);
   $cat=mysqli_real_escape_string($conn,$_POST['category']);
   $int=mysqli_real_escape_string($conn,$_POST['intro']);
   $pti=mysqli_real_escape_string($conn,$_POST['ptime']);
   $cti=mysqli_real_escape_string($conn,$_POST['ctime']);
   $ser=mysqli_real_escape_string($conn,$_POST['serving']);
   $lev=mysqli_real_escape_string($conn,$_POST['level']);

$filename=$_FILES['pic']['name'];
    move_uploaded_file($_FILES['pic']['tmp_name'], 'images/Receipe/' . $filename);
                
    $sql="INSERT INTO receipe(title,_date,category,image,intro,prep_time,cook_time,serving_size,_level)
    				 VALUES ('".$tit."','".$dat."','".$cat."','".$filename."','".$int."','".$pti."','".$cti."','".$ser."','".$lev."')";
    if($result=mysqli_query($conn,$sql))
    {
    	$id=mysqli_insert_id($conn);
        header("Location: Admin_AddReceipe_Ing.php?rid=".$id);
    }
    else
    {

        $error = "Not Added.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login Zeelicious Foods</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util_login.css">
	<link rel="stylesheet" type="text/css" href="css/main_login.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form method="post" enctype="multipart/form-data">
					<span class="login100-form-title">
						Add Receipe
					</span>
                    <?php if(isset($error)) {?>
                        <span style="color: red"><?= $error ?></span>
                    <?php } ?>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name="title" placeholder="Title" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="date" name="date" placeholder="Date" required>
						<span class="focus-input100"></span>
					</div>

					Category
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<select name="category">
							<option name="breakfast">Breakfast</option>
							<option name="lunch">Lunch</option>
							<option name="salad">Salad</option>
							<option name="dinner">Dinner</option>
						</select>
						<span class="focus-input100"></span>
					</div>
					Introduction
					<div style="border-color: red" class="wrap-input100 validate-input" data-validate = "Password is required">
						<textarea name="intro" cols="40" rows="10" required></textarea>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" min=0 name="ptime" placeholder="Preparation Time" required>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" min=0 name="ctime" placeholder="Cook Time" required>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" min=0 name="serving" placeholder="Serving Size" required>
						<span class="focus-input100"></span>
					</div>
					Level
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<select name="level">
							<option name="veryeasy">Very Easy</option>
							<option name="easy">Easy</option>
							<option name="medium">Medium</option>
							<option name="difficult">Difficult</option>
						</select>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="File" name="pic" required>
						<span class="focus-input100"></span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Add
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>