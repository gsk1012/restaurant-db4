<?php
include_once 'bestelling.php';
$bestelling = new Bestelling($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    try {
        $bestelling_id = $_GET['id'];
        $bestelling->deleteBestelling($bestelling_id);
        header("Location: insert-bestelling.php");
        exit;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>