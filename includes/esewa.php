<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "./dbconfig.php";
extract($_GET);
$total = $_SESSION['total_price'];
$customerid = $_SESSION['user_id'];
$address = $_GET['shipping_address'];
$payment = $_GET['payment_method'];
$sql = "INSERT INTO orders(user_id, status, shipping_address, payment_method, total) VALUES('$customerid', 'pending','$address', '$payment','$total')";
$blah = $connect->query($sql);

$sql2 = "SELECT order_id from orders order by order_id DESC limit 1";
$result = $connect->query($sql2);
$final = $result->fetch_assoc();
$orderid = $final['order_id'];

foreach ($_SESSION['cart'] as $key => $value) {
    $proid = $value['id'];
    $quantity = $value['quantity'];
    $size = $value['size'];
    $price = $value['price'];
    $sql3 = "INSERT INTO order_details(order_id,product_id,quantity, price, size) VALUES('$orderid','$proid','$quantity', '$price', '$size')";
    $connect->query($sql3);
}

if ($blah) {
    unset($_SESSION['total_price']);
    unset($_SESSION['cart']);
    echo "<script>window.location.href='../success.php'</script>";
}