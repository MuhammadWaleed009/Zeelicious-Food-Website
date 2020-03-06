<?php
include_once 'connection.php';

?>
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

<!-- LOADER >
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
<?php include 'template/header.php';?>

	
<body>
 <br><br><br><br>   
<div class="container">
    <div class="row">
        <div class="col-sm-3 col-md-3" >
            <h2 style="text-bold:!important">My Account</h2>
            <nav class="text1">
            <ul>
                <li><a style="color:red!important" href="dashboard.php">Dashboard</a></li>
                <li><a style="color:red!important" href="orders.php">Orders</a></li>
                <li><a style="color:red!important" href="">Downloads</a></li>
                <li><a style="color:blue!important" href="">Addresses</a></li>
                <li><a style="color:red!important" href="">Payment Methods</a></li>
                <li><a style="color:red!important" href="">Account Details</a></li>
                <li><a style="color:red!important" href="logout.php">Logout</a></li>
            </ul>   
        </nav>
        </div>
   <div class="col-sm-9 col-md-9" >
    <table>
    
        <th><h2>Billing Address</h2></th><th> </th><th><h2>Shipping Address</h2></th><th> </th><tr><td>
<?php
$uid=$_SESSION['user']['id'];
$chk="select * from address WHERE `USER_ID`='".$uid."' and `TYPE`='billing'";
$drow=mysqli_query($conn, $chk);
echo "<div class='col-md-12'>";
if(mysqli_num_rows($drow)>0) {
    $rows = mysqli_fetch_assoc($drow) ;

    echo $rows['fname']." ".$rows['lname']." ".$rows['company']." ".$rows['country']." ".$rows['city']." ".$rows['state']." ".$rows['address1']." ".$rows['address2']."

    
    ";
} else {

}
echo "
    </td><td>
    <a style='color:red!important' href='billing_address.php'>Edit</a></td><td>";
$chk1="select * from address WHERE `USER_ID`='".$uid."' and `TYPE`='shipping'";
$drows1=mysqli_query($conn, $chk1);
echo "<div class='col-md-12'>";
if(mysqli_num_rows($drows1)>0) {
    $rows1 = mysqli_fetch_assoc($drows1) ;

    echo "<br> <p>".$rows1['fname']." ".$rows1['lname']." ".$rows1['company']." ".$rows1['country']." ".$rows1['city']." ".$rows1['state']." ".$rows1['address1']." ".$rows1['address2']." ";
} else {

}
echo "</td><td>
    <a style='color:red!important' href='shipping_address.php'>Edit</a>
    </td>
    </table>";
?>


</div>


</div>


</div>

</div>

</div>
</body>


    

<?php include 'template/footer.php';?>


<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

<!-- ALL JS FILES -->
<script src="js/all.js"></script>
<!-- ALL PLUGINS -->
<script src="js/custom.js"></script>
<script src="js/portfolio.js"></script>
<script src="js/hoverdir.js"></script>

</body>
</html>