<?php
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    include_once'connection.php';
    $desc=mysqli_real_escape_string($conn,$_POST['description']);
    $cat=mysqli_real_escape_string($conn,$_POST['category']);
    $pri=mysqli_real_escape_string($conn,$_POST['price']);
    $img=mysqli_real_escape_string($conn,$_POST['img']);

    $sql="INSERT INTO products(image,description,category,price) VALUES ('".$img."','".$desc."','".$cat."','".$pri."')";
    if($result=mysqli_query($conn,$sql))
    {
        header("Location: my_account.php");
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
						Add Product
					</span>
                    <?php if(isset($error)) {?>
                        <span style="color: red"><?= $error ?></span>
                    <?php } ?>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="description" placeholder="Description" required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="text" name="category" placeholder="Category" required>
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input">
						<input class="input100" type="Number" name="price" placeholder="Price" min=1 required>
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="File" name="img" required>
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