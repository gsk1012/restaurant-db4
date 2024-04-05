<?php
include_once 'reservering.php';
include_once '../navbar/navbar.php';

$tafels = $myDb->execute("SELECT * FROM tafel")->fetchAll();
$klanten = $myDb->execute("SELECT * FROM klant")->fetchAll();

$reservering = new Reservering($myDb);

$reservering_id = $_GET['id'];
$huidige_reservering = $reservering->getReserveringById($reservering_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $reservering->editReservering($reservering_id, $_POST['datum'], $_POST['tijd'], $_POST['aantal_personen'], $_POST['klant'], $_POST['tafel']);
        header('Location: insert-reservering.php');
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservering bewerken</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        form {
            width: 50%;
            margin: auto;
        }
        .btn {
            width: 100px;
        }
        form .form-control   {
            border: 1px solid gray;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Reservering bewerken</h1>
    <form action="" method="post">
        <label for="klant" style="font-size: 25px;">Klant</label>
        <select class="form-control" name="klant">
            <option value="">Uw naam</option>
            <?php foreach ($klanten as $klant) : ?>
                <option value="<?php echo $klant['klant_id']; ?>" <?php echo ($klant['klant_id'] == $huidige_reservering['klant_id']) ? 'selected' : ''; ?>><?php echo $klant['naam']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="datum" style="font-size: 25px;">Datum</label><br>
        <input class="form-control" type="date" name="datum" min="<?php echo date('Y-m-d'); ?>" value="<?php echo isset($huidige_reservering['datum']) ? $huidige_reservering['datum'] : ''; ?>"><br>
        <label for="tijd" style="font-size: 25px;">Tijd</label>
        <input class="form-control" type="time" name="tijd" value="<?php echo isset($huidige_reservering['tijd']) ? $huidige_reservering['tijd'] : ''; ?>"><br>
        <label for="aantal_personen" style="font-size: 25px;">Aantal personen</label>
        <input class="form-control" type="number" name="aantal_personen" value="<?php echo isset($huidige_reservering['aantal_personen']) ? $huidige_reservering['aantal_personen'] : ''; ?>"><br>
        <label for="tafel" style="font-size: 25px;">Tafel</label>
        <select class="form-control" name="tafel">
            <option value="">Kies een tafelnummer</option>
            <?php foreach ($tafels as $tafel) : ?>
                <option value="<?php echo $tafel['tafel_id']; ?>" <?php echo ($huidige_reservering['tafel_id'] == $tafel['tafel_id']) ? 'selected' : ''; ?>><?php echo $tafel['tafelnummer']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Bewerken">
    </form>
</body>
</html>

