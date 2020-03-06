<?php

if(strtolower($_SERVER['REQUEST_METHOD']) != 'get' || !is_numeric($_GET['orderId'])) {
    http_response_code(400);
    return;
}
require '../connection.php';

if(!isset($_SESSION['user'])) {
    http_response_code(401);
    return;
}
header("Content-Type: application/json");

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
    return;
}
$order = mysqli_fetch_assoc($result);
echo json_encode($order);
