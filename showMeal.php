<?php
require_once 'connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}

$mealplan_id = $_GET['id'];


if(strtolower($_SERVER['REQUEST_METHOD']) == 'post') {
    $id = $_SESSION['user']['id'];
    $count = mysqli_real_escape_string($conn,$_POST['count']);
    $weeks = mysqli_real_escape_string($conn,$_POST['weeks']);
    $sql = "insert ignore into `_cart` values(null,$id,$mealplan_id,\"mealplans\",$weeks)";
    mysqli_query($conn, $sql);
    header("Location: showMeal.php?id=$mealplan_id");

}


$sql = "SELECT * FROM mealplans WHERE id=$mealplan_id";
$result = mysqli_query($conn, $sql);

if (!mysqli_num_rows($result)) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}

$mealplan = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM mealplans WHERE id NOT LIKE($mealplan_id) LIMIT 3";
$related_mealplans = mysqli_query($conn, $sql);


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

<?php include 'template/header.php'; ?>
<hr>
<div class="container">
    <div class="row">
        <p>Home / Healthy Meal Plan/ <?= $mealplan['category'] ?><p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="pricingTable">
                <div class="pricingTable-header">
                    <h3 class="title"><?= $mealplan['category'] ?></h3>
                </div>
                <div class="price-value">
                    <div class="value">
                        <span></span>
                        <span class="amount">Buy</span>
                        <span class="month"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h1><?= $mealplan['category'] ?></h1>
            <form class="form-horizontal" method="post">
                <p>Buy this Plan to access it.</p>
                <div class="form-group">
                    <label class="control-label col-md-2">Weeks:</label>
                    <div class="col-md-6">
                        <select class="form-control" name="weeks" id="weeks" required>
                            <option value="">Select Week</option>
                            <?php for($i=1;$i<=$mealplan['weeks'];$i++) {?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div id="calculated-price" style="display:none;color:#e00707;font-size: 14pt"></div>
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="hidden" class="form-control input-lg" name="count" id="count" value="1" min="1" max="100">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" name="submit" id="submit" class="btn zee-btn" style=""> Add to Cart <i class="fa fa-angle-right"></i> </button>
                    </div>
                </div>
            </form>
            <h4>Category</h4>
            <p><?= $mealplan['category'] ?></p>
            <h3>Description</h3>
            <p><?= $mealplan['category'] ?></p>
        </div>
    </div>

    <h1 style="margin: 20px 0px">Related Products</h1>
    <div class="row">
        <?php while ($row = mysqli_fetch_assoc($related_mealplans)): ?>
            <div class="col-md-4">
                <div class="pricingTable">
                    <div class="pricingTable-header">
                        <h3 class="title"><?= $row['category'] ?></h3>
                    </div>
                    <div class="price-value">
                        <div class="value">
                            <span></span>
                            <span class="amount">Buy</span>
                            <span class="month"></span>
                            
                        </div>
                    </div>
                    <br>
                            <ul class="pricing-content">
                            <li></li>
                            </ul>
                            
                    
                           <?php echo '<form method="post" action="showMeal.php?id="'.$row['id'].'">
                            <a type="submit" href="showMeal.php?id='.$row['id'].'" class="pricingTable-signup">Subscribe to this plan</a>
                            </form>';
                            ?>

                </div>
            </div>
        <?php endwhile; ?>
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
<script>
    $(function(){
        $('#count').attr('disabled',true);
        $('#submit').attr('disabled',true);
        $('#weeks').change(function() {
            if(this.value) {
                $('#count').attr('disabled',false);
                $('#submit').attr('disabled',false);
                $('#calculated-price').slideDown();
                $('#calculated-price').text('₦' + (<?= $mealplan['price'] ?>*parseInt(this.value)));
            } else {
                $('#count').attr('disabled',true);
                $('#submit').attr('disabled',true);
                $('#calculated-price').slideUp();
            }
        })
    })
</script>
</body>
</html>