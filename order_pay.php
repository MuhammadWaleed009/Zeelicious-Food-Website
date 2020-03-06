<?php
if(strtolower($_SERVER['REQUEST_METHOD']) != 'get' || !is_numeric($_GET['orderId'])) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
require 'connection.php';
if(!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
$orderId = mysqli_real_escape_string($conn,(int) $_GET['orderId']);
$userId = $_SESSION['user']['id'];

$sql = "SELECT o.id,o.date,sum(price*qty) total_price
        FROM orders o INNER JOIN
            (SELECT order_id, product_ID id, price, order_details.product_QUANTITY qty
                FROM order_details
                    INNER JOIN products ON `order_details`.product_ID = products.id 
            UNION 
            
            SELECT order_id, mealplans_ID id, price, order_details.mealplan_QUANTITY qty
                FROM order_details
                    INNER JOIN mealplans ON `order_details`.mealplans_ID = mealplans.id) p ON p.order_id = o.id
        WHERE
            o.id = $orderId AND o.user_id = $userId AND status='Pending Payment'
        group by o.id";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) != 1) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
$order = mysqli_fetch_assoc($result);



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

<div class="section wb" style="padding: 60px 0px">
    <div class="container">
        <h1 style="font-size: x-large">Pay for Order</h1>
        <form id="paymentForm">
            <script src="https://js.paystack.co/v1/inline.js"></script>
            <input type="hidden" id="email" name="email" value="<?= $_SESSION["user"]["email"] ?>">
            <input type="hidden" id="orderid" name="orderid" value="<?= $orderId ?>">
            <input type="hidden" id="amount" name="amount" value="<?= $order["total_price"] ?>">
            <input type="hidden" id="first-name" name="amount" value="<?= $_SESSION["user"]["name"] ?>">
            <input type="hidden" id="last-name" name="amount" value="">
            <div class="row">
                <div class="col-md-12">
                    <div class="well">

                        <div class="row" style="font-family: monospace;color: #555">
                            <div class="col-md-3">
                                <span>ORDER NUMBER:</span><br>
                                <span><b><?= $order['id'] ?></b></span>
                            </div>
                            <div class="col-md-3" style="border-left: 1px dashed #aaa">
                                <span>Date:</span><br>
                                <span><b><?= (new DateTime($order['date']))->format('M  d, Y') ?></b></span>
                            </div>
                            <div class="col-md-3" style="border-left: 1px dashed #aaa">
                                <span>Total:</span><br>
                                <span><b>₦ <?= number_format($order['total_price']) ?></b></span>
                            </div>
                            <div class="col-md-3" style="border-left: 1px dashed #aaa">
                                <span>Payment Method:</span><br>
                                <span><b>Debit/Credit Cards</b></span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <button type="submit" name="submit" id="submit" class="btn zee-btn" style="float:right;">
                Pay Now <i class="fa fa-angle-right"></i>
            </button>
            <a href="order_cancel.php?orderId=<?= $orderId ?>" class="btn zee-btn zee-btn-left" style="float:left;">
                <i class="fa fa-angle-left"></i> Cancel Order &amp; Restore Cart
            </a>
        </form>
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
<script>
    var paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payNow, false);
    function payNow(e) {
        e.preventDefault();
        $("body").append('<div id="overlay" style="background-color:#ddd;opacity: 0.4;position:absolute;top:0;left:0;height:100%;width:100%;z-index:999"></div>');
        $.ajax({
            url: "<?= base_url("ajax/get_order_info.php?orderId=$orderId") ?>",
            success: function(data) {
                document.getElementById("amount").value = data.total_price;
                payWithPaystack();
            },
            error: function() {
                alert("Payment Failed. Try again.");
            },
            complete: function() {
                $("#overlay").remove();
            }
        })
        return;
    }
    function payWithPaystack() {
        var handler = PaystackPop.setup({
            key: '<?= PAYSTACK_KEY_TEST_PK ?>', // Replace with your public key
            email: document.getElementById("email").value,
            amount: document.getElementById("amount").value,
            firstname: document.getElementById("first-name").value,
            lastname: document.getElementById("first-name").value,

            ref:<?= $orderId ?>,
            onClose: function () {

            },
            callback: function (response) {
                console.log(response);
                if(response.status == "success") {
                    $.ajax({
                        url: "<?= base_url("ajax/verify_payment.php?orderId=$orderId&payment_reference=") ?>" + response.reference,
                        success: function() {
                            window.location.replace("<?= base_url("order_details.php?oid=$orderId") ?>");
                        },
                        error: function() {
                            alert("Payment Failed. Try again.");
                        }
                    })
                } else {
                    alert("Payment Failed. Try again.");
                }
            }
        });

        handler.openIframe();
    }
</script>

</body>
</html>