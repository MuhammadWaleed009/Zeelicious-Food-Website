<?php
session_start();
 if(!isset($_SESSION['user'])) {
    header("Location: login.php");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>Zeeliciousfoods | Easy recipes, food reviews, kitchen tips and tricks and health benefits of foods</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.png"/>
    <link rel="apple-touch-icon" href="images/favicon.png">

    <link rel="stylesheet" href="css/cstyle.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!-- Modernizer for Portfolio -->
    <script src="js/modernizer.js"></script>


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<!-- LOADER -->
<div id="preloader">
    <div class="loader">
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__bar"></div>
        <div class="loader__ball"></div>
    </div>
</div><!-- end loader -->
<!-- END LOADER -->

<?php include 'template/header.php'; ?>
<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-4 col-md-4">
            <h2 style="text-bold:!important">My Account</h2>
            <nav class="text1">
                <ul>
                    <li><a style="color:red!important" href="dashboard.php">Dashboard</a></li>
                    <li><a style="color:red!important" href="orders.php">Orders</a></li>
                    <li><a style="color:red!important" href="#">Downloads</a></li>
                    <li><a style="color:red!important" href="address.php">Addresses</a></li>
                    <li><a style="color:red!important" href="#">Payment Methods</a></li>
                    <li><a style="color:red!important" href="#">Account Details</a></li>
                    <li><a style="color:red!important" href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-sm-8 col-md-8">
            <p> Hello admin (not admin?<a href="logout.php"> Log out</a>)</p>
            <p>From your account dashboard you can view your <a href="#">recent orders</a>, manage your shipping and
                billing addresses, and edit your password and account details.</p>
        </div>
    </div>

</div>
<hr>
<?php include 'template/footer.php'; ?>


<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="js/all.js"></script>
<!-- ALL PLUGINS -->
<script src="js/custom.js"></script>
<script src="js/portfolio.js"></script>
<script src="js/hoverdir.js"></script>

</body>
</html>