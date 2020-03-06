<?php
if(isset($_SESSION['user'])) {
    header("Location: my_account.php");
}
if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    include_once'connection.php';
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $pwd=mysqli_real_escape_string($conn,$_POST['password']);
    if($email=="admin@zeelicious.com" && $pwd=="Zeeliousfoods19@")
     header("Location: AdminPanel.php");
    else
{
    $sql="select * from _user where email='$email' and password='$pwd'";
    if($result=mysqli_query($conn,$sql))
    {
        if(mysqli_num_rows($result))
        {
            $_SESSION['user'] = mysqli_fetch_assoc($result);
            if(isset($_GET["redirect"])) {
                header("Location: " . $_GET["redirect"]);
            } else {
                header("Location: my_account.php");
            }
        }
        else
        {

            $error = "Incorrect username or password.";
        }
    }
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
						Member Login
					</span>
                    <?php if(isset($error)) {?>
                        <span style="color: red"><?= $error ?></span>
                    <?php } ?>
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="signup.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>