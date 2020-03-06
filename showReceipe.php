<?php
require_once 'connection.php';


if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
$recipe_id = $_GET['id'];

$sql = "SELECT * FROM receipe WHERE id=$recipe_id";
$result = mysqli_query($conn, $sql);

if (!mysqli_num_rows($result)) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
$recipe = mysqli_fetch_assoc($result);

$sql = "SELECT distinct i.ing_description FROM receipe r, ingredients i , procedures p 
            WHERE r.id=p.receipe_id AND r.id=i.receipe_id AND r.id=$recipe_id";
$ingredients = mysqli_query($conn, $sql);

$sql = "SELECT distinct p.pro_description FROM receipe r, ingredients i , procedures p 
            WHERE r.id=p.receipe_id AND r.id=i.receipe_id AND r.id=$recipe_id";
$procedures = mysqli_query($conn, $sql);

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

<?php include 'template/header.php'; ?>
<hr>
<div class="container">
    <h1><?= $recipe['title'] ?></h1>
    <div><span>by admin | <?= $recipe['_date'] ?> | <?= $recipe['category'] ?></span></div>
    <div>
        <img class="img-thumbnail" src="images/Receipe/<?= $recipe['image'] ?>" style="width: 700px">
    </div>
    <p style="text-align: justify;color: #0b0b0b;width: 700px;"><?= $recipe['intro'] ?></p>
    <h2 style="color:red; font:italic;font-weight: bold">Ingredients</h2>
    <ul style="color: #0b0b0b;width: 700px;">
        <?php while ($row = mysqli_fetch_assoc($ingredients)) : ?>
            <li style="list-style: disc"><?= $row['ing_description'] ?></li>
        <?php endwhile; ?>
    </ul>
    <h2 style="color:red; font:italic;font-weight: bold">Procedure</h2>
    <ul style="color: #0b0b0b;width: 700px;">
        <?php while ($row = mysqli_fetch_assoc($procedures)) : ?>
            <li style="list-style: disc"><?= $row['pro_description'] ?></li>
        <?php endwhile; ?>
    </ul>
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