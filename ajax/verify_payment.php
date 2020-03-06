<?php

if(strtolower($_SERVER['REQUEST_METHOD']) != 'get' || !is_numeric($_GET['orderId']) || !isset($_GET['payment_reference'])) {
    http_response_code(400);
    return;
}
require '../connection.php';
require '../vendor/autoload.php';
use Yabacon\Paystack;

if(!isset($_SESSION['user'])) {
    http_response_code(401);
    return;
}

$orderId = (int) $_GET['orderId'];
$payment_reference = $_GET['payment_reference'];

// initiate the Library's Paystack Object
$paystack = new Paystack(PAYSTACK_KEY_TEST_SK);
try
{
    // verify using the library
    $tranx = $paystack->transaction->verify([
        'reference'=>$payment_reference, // unique to transactions
    ]);
} catch(\Yabacon\Paystack\Exception\ApiException $e){
    http_response_code(400);
    die($e->getMessage());
}

if ('success' === $tranx->data->status) {
    $sql = "UPDATE orders SET payment_refno='$payment_reference',status='Payment Complete' WHERE orders.id=$orderId";
    mysqli_query($conn,$sql);
}
http_response_code(200);