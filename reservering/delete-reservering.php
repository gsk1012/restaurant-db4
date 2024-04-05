<?php
include_once 'reservering.php';
$resevering = new Reservering($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    try {
        $reservering_id = $_GET['id'];

        $resevering->deleteReservering($reservering_id);
        header("Location: insert-reservering.php");
        exit();
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>
