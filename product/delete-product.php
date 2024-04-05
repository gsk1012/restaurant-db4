<?php
include_once 'product.php';
$product = new Product($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    try {
        $product_id = $_GET['id'];
        $product->deleteProduct($product_id);
        header("Location: insert-product.php");
        exit;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>