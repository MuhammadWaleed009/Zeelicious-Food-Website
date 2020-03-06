<?php
require_once 'connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
$product_id = $_GET['id'];

if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    if(!isset($_SESSION['user'])) {
        header("Location: login.php?redirect=".(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http') . "://" . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
        return;
    }
    $id = $_SESSION['user']['id'];
    $count = $_POST['count'];
    $sql = "insert into `_cart` values(null,$id,$product_id,'products',$count) on duplicate key update quantity=quantity+$count";
    mysqli_query($conn, $sql);
    header("Location: showProduct.php?id=$product_id");
}

$sql = "SELECT * FROM products WHERE id=$product_id";
$result = mysqli_query($conn, $sql);

if (!mysqli_num_rows($result)) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
$product = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM products WHERE id NOT LIKE($product_id)";
$related_products = mysqli_query($conn, $sql);

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
        <p>Home / <?= $product['category'] ?> / <?= $product['description'] ?><p>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <img src="images/Product and service/<?= $product['image'] ?>" style="height:300px; width:360px">
        </div>
        <div class="col-sm-8">
            <h1><?= $product['description'] ?></h1>
            <p style="color:#e00707;font-size: 18pt"> ₦<?= $product['price'] ?></p>

            <form class="form-horizontal" method="post">
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="number" class="form-control input-lg" name="count" id="count" value="1" min="1"
                               max="100">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="submit" id="submit" class="btn zee-btn" style="float:right;padding:6px 12px;margin:2px">
                            Add to Cart <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
            <h5>Category</h5>
            <p><?= $product['category'] ?></p>
            <h3>Description</h3>
            <p><?= $product['description'] ?></p>
        </div>
    </div>
    <h1 style="margin: 20px 0px">Related Products</h1>
    <div class="row">
        <div class="owl-services owl-carousel owl-theme">
            <?php while ($row = mysqli_fetch_assoc($related_products))  : ?>

                <div class="service-widget">

                    <div class="post-media wow fadeIn">
                        <a href="showProduct.php?id=<?= $row['id'] ?>"
                           class="hoverbutton global-radius"><i
                                    class="flaticon-unlink"></i></a>
                        <img src="<?= $row['image'] ?>" alt="" style="height:300px; width:300px">
                    </div>
                    <div class="service-dit">
                        <h3 style="color: black"><?= $row['description'] ?></h3>
                        <h4>Price: <?= $row['price'] ?><h4>
                    </div>

                </div>
            <?php endwhile; ?>
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