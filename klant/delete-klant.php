<?php
include_once 'klant.php';
$klant = new Klant($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    try {
        $klant_id = $_GET['id'];
        $klant->deleteKlant($klant_id);
        header("Location: insert-klant.php");
        exit;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>