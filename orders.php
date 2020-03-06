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

<!-- LOADER 
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
                <li><a style="color:blue!important" href="orders.php">Orders</a></li>
                <li><a style="color:red!important" href="">Downloads</a></li>
                <li><a style="color:red!important" href="address.php">Addresses</a></li>
                <li><a style="color:red!important" href="">Payment Methods</a></li>
                <li><a style="color:red!important" href="">Account Details</a></li>
                <li><a style="color:red!important" href="logout.php">Logout</a></li>
            </ul>   
        </nav>
        </div>
   <div class="col-sm-9 col-md-9" >
   		<div class="limiter">
					
						<table class="table table-striped">
							<thead>
								<tr style="background-color: black;font-color:white">
									<th >Order</th>
									<th >Date</th>
                                    <th>Status</th>
									<th >Total</th>
									<th >Action</th>
								</tr>
							</thead>
					</div>
					<?php
if(isset($_SESSION['user']['id']))
$sql = 'select * from orders where user_id='.$_SESSION['user']['id'];
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)>0) {
        
            while ($row = mysqli_fetch_assoc($result)) {

             
                $id = $row['id'];
                $date = $row['date'];
                $status=$row['status'];
                $total = $row['total'];

                echo  '
						<tbody>
								<tr >
								<td >'.$id.'</td>
									<td >'.$date.'</td>
                                    <td >'.$status.'</td>
									<td >'.$total.'</td>
									<td ><a style="color:red!important" href="order_details.php?oid='.$id.'">View</a></td>
        							
								</tr>

								
					
					

                   ';
            }
        }
    


?>


		</tbody>
		</table>
					
				
			</div>
		</div>
	</div>
</div></body>

</body>
</html>


    

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