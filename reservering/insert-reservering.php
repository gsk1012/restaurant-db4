<?php
include_once 'reservering.php';
include_once '../navbar/navbar.php';
include_once '../reservering/view-reservering.php';
$resevering = new Reservering($myDb);

$klanten = $myDb->execute("SELECT * FROM klant")->fetchAll();
$tafels = $myDb->execute("SELECT * FROM tafel")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $klant_id = $_POST['klant'];
        $klantCheck = $myDb->execute("SELECT klant_id FROM klant WHERE klant_id = ?", [$klant_id])->fetch();
        if (!$klantCheck) {
            throw new Exception('Ongeldige klant_id');
        }
        $tafel_id = $_POST['tafel'];
        $tafelCheck = $myDb->execute("SELECT tafel_id FROM tafel WHERE tafel_id = ?", [$tafel_id])->fetch();
        if (!$tafelCheck) {
            throw new Exception('Ongeldige tafel_id');
        }
        $resevering->insertReservering($_POST['datum'], $_POST['tijd'], $_POST['aantal_personen'], $klant_id, $tafel_id);
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
    <title>Bestelling Plaatsen</title>
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
    <h1 style="text-align: center;">Reservering toevoegen</h1>
    <form action="" method="post">
        <label for="klant" style="font-size: 25px;">Klant</label>
        <select class="form-control" name="klant">
            <option value="">Uw naam</option>
            <?php foreach ($klanten as $klant) : ?>
                <option value="<?php echo $klant['klant_id']; ?>"><?php echo $klant['naam']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <label for="datum" style="font-size: 25px;">Datum</label><br>
        <input class="form-control" type="date" name="datum" min="<?php echo date('Y-m-d'); ?>"><br>
        <label for="tijd" style="font-size: 25px;">Tijd</label>
        <input class="form-control" type="time" name="tijd"><br>
        <label for="aantal_personen" style="font-size: 25px;">Aantal personen</label>
        <input class="form-control" type="number" name="aantal_personen"><br>
        <label for="tafel" style="font-size: 25px;">Tafel</label>
        <select class="form-control" name="tafel">
        <option value="">Kies een tafelnummer</option>
            <?php foreach ($tafels as $tafel) : ?>
                <?php if ($tafel['status'] === 'beschikbaar') : ?>
                    <option value="<?php echo $tafel['tafel_id']; ?>"><?php echo $tafel['tafelnummer']; ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form>
    <div id="success-message" style="display: none; text-align: center;">
        <h1 style="color: green;">Reservering succesvol geplaatst</h1>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';

                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') : ?>
                    successMessage.style.display = 'block';

                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 6000);
                <?php endif; ?>
            }
        });
    </script>
</body>
</html>