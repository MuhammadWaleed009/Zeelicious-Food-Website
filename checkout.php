<?php
require 'connection.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
$id = $_SESSION['user']['id'];


$sql  = "SELECT * FROM address WHERE USER_ID=$id AND TYPE='billing'";
$result = mysqli_query($conn,$sql);
$address =  mysqli_fetch_assoc($result);


if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $fname = $_POST['firstname '];
    $lname = $_POST['lastname'];
    $company = $_POST['companyname'];
    $country = $_POST['country'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $info = $_POST['info'];
    $postcode = $_POST['postcode'];
    $total = $_POST['total'];

    mysqli_begin_transaction($conn);
    $sql = "INSERT INTO address VALUES($id,'billing','$fname','$lname','$company','$country','$address1','$address2','$city','$postcode','$phone','$email','$state',null) ON DUPLICATE KEY UPDATE fname = '$fname',lname = '$lname',company ='$company',country = '$country',address1 = '$address1',address2 = '$address2',city = '$city',state = '$state',phone = '$phone',email = '$email',postcode = '$postcode'";
    $result = mysqli_query($conn, $sql);
    if($result) {
        $sql = "INSERT INTO orders VALUES(null,$id,CURRENT_DATE(),$total,'Pending Payment',null);";
        $result = mysqli_query($conn, $sql);
        if($result) {
            $orderId = mysqli_insert_id($conn);
            $sql = "INSERT INTO order_details SELECT null,$orderId,IF(service='products',product_id,null) product_id,IF(service='mealplans',product_id,null) mealplans,IF(service='products',quantity,null) product_qty ,IF(service='mealplans',quantity,null) mealplan_qty FROM _cart WHERE user_id=$id GROUP BY product_id,service";
            $result = mysqli_query($conn, $sql);
            if($result) {
                $sql = "DELETE FROM _cart WHERE user_id=$id";
                $result = mysqli_query($conn, $sql);
                mysqli_commit($conn);
                header("Location: order_pay.php?orderId=$orderId");
                return;
            }
        }
    }
    mysqli_rollback($conn);
    header("Location: checkout.php");
    return;
}

$products_sql = "select _cart.id id,product_id,service,image,description title,price,quantity from _cart inner join products on `_cart`.product_id=products.id and `_cart`.service='products' and `_cart`.user_id=$id";
$mealplan_sql = "select _cart.id id,product_id,service,image,category title,price,quantity from _cart inner join mealplans on `_cart`.product_id=mealplans.id and `_cart`.service='mealplans' and `_cart`.user_id=$id";
$sql = "$products_sql UNION $mealplan_sql";
$result = mysqli_query($conn, $sql);
if( ! mysqli_num_rows($result)) {
    header("Location: cart.php");
    return;
}

function _get($data,$key) {
    return isset($data[$key]) ? $data[$key] : "";
}
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
        <h1 style="font-size: xx-large">Checkout</h1>
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name:</label>
                            <input type="text" class="form-control" value="<?= _get($address,"fname") ?>" id="firstname" name="firstname"
                                   placeholder="First Name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name:</label>
                            <input type="text" class="form-control" id="lastname"value="<?= _get($address,"lname") ?>" name="lastname"
                                   placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="companyname">Company Name:</label>
                        <input type="text" class="form-control" id="companyname" value="<?= _get($address,"company") ?>" name="companyname"
                               placeholder="Company">
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?= _get($address,"country") ?>" placeholder="Country"
                               required>
                    </div>
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" id="address1" value="<?= _get($address,"address1") ?>" name="address1"
                                   placeholder="House Number , Street Name" required>
                        </div>

                        <div class="form-group col-md-12">
                            <input type="text" class="form-control" id="address2" value="<?= _get($address,"address2") ?>" name="address2"
                                   placeholder="unit, suite etc (optional)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" value="<?= _get($address,"city") ?>" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="state" name="state" value="<?= _get($address,"state") ?>" placeholder="State" required>
                    </div>
                    <div class="form-group">
                        <label for="state">State:</label>
                        <input type="text" class="form-control" id="postcode" name="postcode" value="<?= _get($address,"postcode") ?>" placeholder="Post Code" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?= _get($address,"phone") ?>" placeholder="Phone Number"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= _get($address,"email") ?>" placeholder="Email Address"
                               required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="info">Additional Information:</label>
                        <textarea class="form-control" id="info" name="info"
                                  placeholder="Notes about your order.."></textarea>
                    </div>
                </div>
            </div>
            <h1>Your Order</h1>
            <table class="table" style="border: 1px solid #ddd;border-radius: 10px 10px 10px 10px;color:#1f1f1f">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                <?php $total = 0; while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['title'] ?> <b>× <?= $row['quantity'] ?></b></td>
                    <td>₦ <?= $row['quantity'] * $row['price'] ?></td>
                </tr>
                <?php $total= $total+($row['quantity'] * $row['price']); } ?>
                <input type="hidden" name="total" value="<?= $total ?>">
                </tbody>
                <tfoot>
                <tr>
                    <th>Total:</th>
                    <th>₦ <?= $total ?></th>
                </tr>
                </tfoot>
            </table>
            <div class="well well-lg">
                <ul class="wc_payment_methods payment_methods methods">
                    <li class="wc_payment_method payment_method_paystack">
                        <input id="payment_method_paystack" type="radio" class="input-radio" name="payment_method"
                               value="paystack" checked="checked" data-order_button_text="" style="display: none;">

                        <label for="payment_method_paystack">
                            Debit/Credit Cards <img src="images/paystack-wc.png" alt="cards"> </label>
                        <div class="payment_box payment_method_paystack">
                            <p>Make payment using your debit and credit cards</p>
                        </div>
                    </li>
                </ul>
                <hr>
                <div class="form-row place-order">
                    <noscript>
                        Since your browser does not support JavaScript, or it is disabled, please ensure you click the
                        <em>Update Totals</em> button before placing your order. You may be charged more than the amount
                        stated above if you fail to do so. <br/>
                        <button type="submit" class="button alt" name="woocommerce_checkout_update_totals"
                                value="Update totals">Update totals
                        </button>
                    </noscript>

                    <div>
                        <div><p>Your personal data will be used to process your order, support your experience
                                throughout this website, and for other purposes described in our <a
                                        href="#"
                                        target="_blank">privacy policy</a>.</p>
                        </div>
                        <div style="max-height: 200px; overflow: auto;"><p>Please read this Terms and
                                Conditions (“Terms”, “Terms and Conditions”) carefully before using, accessing, or
                                obtaining any items, information, products or services on the
                                htttp://www.zeeliciousfood.com website (the “Service”) operated by my company, Inc.</p>
                            <p>Your access to and use of the Services is conditioned on your acceptance of and
                                compliance with these Terms. These Terms apply to all visitors, users and others who
                                access or use the Service.</p>
                            <p>By accessing or using the Service you agree to be bound by these Terms. If you disagree
                                with any part of the Terms then you may not access the Service.</p>
                            <p>THESE TERMS INCLUDE AN ARBETRATION CLAUSE AND A WAIVER OF YOUR RIGHT TO PARTICIPATE IN A
                                CLASS ACTION OR REPRESENTATIVE LAWSUIT.</p>
                            <p>At any given time and without notice to you we may modify these Terms by posting a new
                                version of the Terms on our website. The changes may not affect rights and obligations
                                which arose prior to the changes. Your continued use of our website following the
                                posting of modified Terms will be subject to the Terms in effect at that time of your
                                use. Please review these Terms periodically for any changes or modifications. If you
                                object to the provisions of these Terms or any subsequent modifications of these Terms
                                or become dissatisfied with our Website in any way, your only recourse is to immediately
                                terminate use of our Website.</p>
                        </div>
                        <p>
                            <label>
                                <input type="checkbox" name="terms" id="terms" required>
                                <span>I have read and agree to the website <a href="#" target="_blank">terms and conditions</a></span>&nbsp;<span
                                        class="required">*</span>
                            </label>
                            <input type="hidden" name="terms-field" value="1">
                        </p>
                    </div>


                    <button type="submit"name="submit" id="submit" class="btn zee-btn"
                            style="float:right;">
                        Place Order <i class="fa fa-angle-right"></i></button>
                    <div style="clear: both"></div>
                </div>
            </div>
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

</body>
</html>