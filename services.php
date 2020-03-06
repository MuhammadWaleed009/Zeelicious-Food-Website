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

    <link rel="stylesheet" href="css/cstyle.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="style.css">
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

<?php include 'template/header.php'; ?>

<div class="banner-area banner-bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner">
                    <h2>Products</h2>
                    <ul class="page-title-link">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">Products</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="services" class="parallax section lb">
    <div class="container">
        <!-- end title -->


        <?php
        $sql = 'select * from products where category="Uncategorized"';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $count = 0;
            while ($row = mysqli_fetch_assoc($result)) {

                if ($count == 0) {
                    echo "<div class='owl-services owl-carousel owl-theme'>";
                }

                $path = $row['image'];
                $desc = $row['description'];
                $price = $row['price'];
                $id = $row['id'];

                echo
                    '<div class="service-widget">
                            <form action="showProduct.php?id="' . $id . '" method="post">
                                <div class="post-media wow fadeIn">
                                    <a type="submit" href="showProduct.php?id=' . $id . '" class="hoverbutton global-radius"><i class="flaticon-unlink"></i></a>
                                    <img src="images/Product and service/' . $path . '" alt="" style="height:300px; width:300px">
                                </div>
                            </form>
					            <div class="service-dit">
						          <h3>' . $desc . '</h3>
						          <h4>Price: ' . $price . '<h4>
					            </div>

                            </div>';
                if ($count == 2) {
                    echo "</div><br>";
                }
                $count = ($count + 1) % 3;
            }
        }
        ?>

    </div><!-- end row -->
</div>

</div><!-- end container -->


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