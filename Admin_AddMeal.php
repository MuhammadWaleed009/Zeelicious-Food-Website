<?php
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    include_once'connection.php';
    $weeks=mysqli_real_escape_string($conn,$_POST['weeks']);
    $cat=mysqli_real_escape_string($conn,$_POST['category']);
    $pri=mysqli_real_escape_string($conn,$_POST['price']);

    $sql="INSERT INTO mealplans(weeks,category,price) VALUES ('".$weeks."','".$cat."','".$pri."')";
    if($result=mysqli_query($conn,$sql))
    {
    	$id=mysqli_insert_id($conn);
        header("Location: Admin_AddMealTable.php?mid=".$id."&weeks=".$weeks);
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

				<form method="post">
					<span class="login100-form-title">
						Add Meal
					</span>
                    <?php if(isset($error)) {?>
                        <span style="color: red"><?= $error ?></span>
                    <?php } ?>
                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name="category" placeholder="Category" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="number" min=1 name="weeks" placeholder="No of Weeks" required>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="Number" name="price" placeholder="Price per week" min=1 required>
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