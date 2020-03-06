<?php
require 'connection.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
$id = $_SESSION['user']['id'];


$products_sql = "select _cart.id id,product_id,service,image,description title,price,quantity from _cart inner join products on `_cart`.product_id=products.id and `_cart`.service='products' and `_cart`.user_id=$id";
$mealplan_sql = "select _cart.id id,product_id,service,image,category title,price,quantity from _cart inner join mealplans on `_cart`.product_id=mealplans.id and `_cart`.service='mealplans' and `_cart`.user_id=$id";
$sql = "$products_sql UNION $mealplan_sql";
$result = mysqli_query($conn, $sql);

if (isset($_GET['action']) && $_GET['action'] == "remove" && is_numeric($_GET['id'])) {
    $sql = "DELETE FROM `_cart` WHERE id=" . $_GET['id'];
    mysqli_query($conn, $sql);
    header("Location: cart.php");
    return;
}

if(strtolower($_SERVER['REQUEST_METHOD']) == 'post' && isset($_POST['cart-update'])) {
    while($row = mysqli_fetch_assoc($result)) {
        $key = '_item-'.$row['id'];
        if(array_key_exists($key,$_POST) && is_numeric($_POST[$key]) && $_POST[$key] > 0) {
            $qty = $_POST[$key];
            $sql = "UPDATE _cart SET quantity=$qty WHERE id=".$row['id'];
            mysqli_query($conn,$sql);
        }
    }
    header("Location: cart.php");
    return;
}
$total = 0;
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
<div class="container mb-4">
    <div class="row">
        <?php if (mysqli_num_rows($result)) { ?>
            <form method="post">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover zee-tbl">
                            <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col" style="color:black">Product</th>
                                <th scope="col" style="color:black" class="text-center">Price</th>
                                <th scope="col" style="color:black" class="text-center">Quantity</th>
                                <th scope="col" style="color:black" class="text-center">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?= $row['image'] ?>" width="48" height="48"/>
                                    </td>
                                    <td style="color:black;vertical-align: middle">
                                        <?= $row['title'] ?>
                                    </td>
                                    <td style="color:black;vertical-align: middle" class="text-center">
                                        ₦ <?= $row['price'] ?></td>
                                    <td style="width:100px;vertical-align: middle">
                                        <input class="form-control" name="_item-<?= $row['id'] ?>" type="number" min="1"
                                               value="<?= $row['quantity'] ?>"
                                               style="width:100%;color:black"/>
                                    </td>
                                    <td style="color:black;vertical-align: middle" class="text-center">
                                        ₦ <?= $row['quantity'] * $row['price'] ?></td>
                                    <td style="color:black;vertical-align: middle" class="text-center">
                                        <a href="cart.php?action=remove&id=<?= $row["id"] ?>"
                                           class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php $total=$total+($row['quantity'] * $row['price']); } ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6" class="" style="vertical-align: middle">
                                    <!--                                    <input class="form-control " style="display: inline-block; width: 150px"-->
                                    <!--                                           type="number"-->
                                    <!--                                           placeholder="Coupon code">-->
                                    <!--                                    <button class="btn zee-btn" style="padding:6px 12px;margin: 2px">Apply Coupon <i-->
                                    <!--                                                class="fa fa-angle-right"></i></button>-->
                                    <button class="btn zee-btn" type="submit" name="cart-update"
                                            style="float:right;padding:6px 12px;margin: 2px">
                                        Update cart <i class="fa fa-angle-right"></i>
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-offset-6">
                    <div class="cart_total">
                        <h2>Cart totals</h2>
                        <table class="table table-bordered zee-tbl" style="font-size: 14pt">
                            <thead>
                            <tr>
                                <th>Subtotal</th>
                                <th> ₦ <?= number_format($total) ?></th>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th> ₦ <?= number_format($total) ?></th>
                            </tr>
                            </thead>
                        </table>
                        <a href="checkout.php" class="btn zee-btn" style="float: right">
                            Proceed to checkout <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php } else {
            echo '<h1 style="text-align: center">Cart is Empty.<br><a href="services.php">Continue Shopping</a></h1>';
        } ?>
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