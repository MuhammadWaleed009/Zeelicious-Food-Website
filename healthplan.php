<?php
include_once 'connection.php'
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
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

<?php include 'template/header.php'; ?>

   	<div class="banner-area banner-bg-1" style="background-image: url('uploads/foodbanner.jpg');">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="banner">
						<h2>Pricing</h2>
						<ul class="page-title-link">
							<li><a href="#">Home</a></li>
							<li><a href="#">HEALTHY MEAL PLAN PACKAGES</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div id="about" class="section wb">
        <div class="container">
			<div class="section-title text-center">
                <h3>HEALTHY MEAL PLANS PACKAGES</h3>
            </div><!-- end title -->
                    <div class="row">
                       <?php
                            $sql='select * from mealplans';
                            $result=mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result))
                            {
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    $cat=$row['category'];
                                    $price=$row['price'];
                                    $id=$row['id'];
                                    $weeks=$row['weeks'];
                                    $total=$price*$weeks;
                                

                                   echo
                                    '<div class="col-md-4 col-sm-6">
                                        <div class="pricingTable">
                                            <div class="pricingTable-header">
                                                <h3 class="title">'.$cat.'</h3>
                                            </div>
                                            <div class="price-value">
                                                <div class="value">
                                                    <span ></span>
                                                    <span class="amount">Buy</span>
                                                    <span class="month"></span>
                                                </div>
                                            </div>
                                            <ul class="pricing-content">
                                                <li></li>
                                            </ul>
                                            <form method="post" action="showMeal.php?id="'.$id.'">
                                            <a type="submit" href="showMeal.php?id='.$id.'" class="pricingTable-signup">Subscribe to this plan</a>
                                            </form>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                     </div><!-- end row -->
                </div>
        </div><!-- end container -->
    </div><!-- end section -->

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