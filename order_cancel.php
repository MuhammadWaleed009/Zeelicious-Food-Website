<?php

if(strtolower($_SERVER['REQUEST_METHOD']) != 'get' || !is_numeric($_GET['orderId'])) {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}
require 'connection.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    return;
}
$id = $_SESSION['user']['id'];
$orderId = mysqli_real_escape_string($conn,(int) $_GET['orderId']);
$sql = "SELECT * FROM orders WHERE user_id=$id AND id=$orderId";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result)) {
    $sql = "INSERT IGNORE INTO _cart SELECT null,$id,IFNULL(product_id,mealplans_id),IF(ISNULL(product_id),'mealplans','products'),IFNULL(product_qty,mealplan_qty) FROM order_details WHERE order_id=$orderId AND EXISTS (SELECT 1 FROM orders WHERE id=$orderId AND user_id=$id)";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM orders WHERE user_id=$id AND id=$orderId";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM order_details WHERE order_id=$orderId";
    mysqli_query($conn, $sql);
    header("Location: cart.php");
    return;
} else {
    http_response_code(404);
    include 'template/error_404.php';
    return;
}