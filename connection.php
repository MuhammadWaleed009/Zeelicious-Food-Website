<?php

error_reporting(E_ALL);
ini_set("display_errors",0);
ini_set("log_errors",1);

$conn = new mysqli('sql107.epizy.com', 'epiz_24264184', 'rhyMlaztckrYiN', 'epiz_24264184_zeeliciousfood');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

define("PAYSTACK_KEY_TEST_SK","sk_test_6f5d2d4e61571e649713d89cffd83a5b98739ab0");
define("PAYSTACK_KEY_TEST_PK","pk_test_677281443990e4cf2a30b5952bfafecd93b24bee");

define("PAYSTACK_KEY_LIVE_SK","sk_live_d15361ff2ad912f8dc1e9dd643fee9e5430be6dc");
define("PAYSTACK_KEY_LIVE_PK","pk_live_7514624f721c2681b893f14c767cc91d776099bd");

session_start();

$cart_count = 0;

if(isset($_SESSION['user'])) {

    $sql="select sum(quantity) s from `_cart` where user_id=" . $_SESSION['user']['id'];
    $result=mysqli_query($conn,$sql);
    $cart_count = mysqli_fetch_assoc($result)['s'];

}

function base_url($path){
    return sprintf(
        "%s://%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'] . "/" . $path
    );
}

