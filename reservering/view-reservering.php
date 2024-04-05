<?php
include_once 'reservering.php';
$resevering = new Reservering($myDb);
$reserveringen = $resevering->getAlleReserveringen();
$klanten = $myDb->execute("SELECT * FROM klant")->fetchAll();
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
    <h1>Reserveringen Overzicht</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Reservering ID</th>
                <th scope="col">Klant naam</th>
                <th scope="col">Tafelnummer</th>
                <th scope="col">Datum</th>
                <th scope="col">Tijd</th>
                <th scope="col">Aantal personen</th>
                <th scope="col">Actie</th>
                <th scope="col">Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reserveringen as $reservering) : ?>
                <tr>
                    <td><?php echo $reservering['reservering_id']; ?></td>
                    <td><?php
                        $klantId = $reservering['klant_id'];
                        $klantName = "";
                        foreach ($klanten as $klant) {
                            if ($klant['klant_id'] == $klantId) {
                                $klantName = $klant['naam'];
                                break;
                            }
                        }
                        echo $klantName;
                    ?></td>
                    <td><?php echo $reservering['tafel_id']; ?></td>
                    <td><?php echo $reservering['datum']; ?></td>
                    <td><?php echo $reservering['tijd']; ?></td>
                    <td><?php echo $reservering['aantal_personen']; ?></td>
                    <td>
                        <a href="edit-reservering.php?id=<?php echo $reservering['reservering_id']; ?>" class="btn btn-warning">Bewerken</a>
                    </td>
                    <td>
                        <a href="delete-reservering.php?id=<?php echo $reservering['reservering_id']; ?>" class="btn btn-danger"
                        onclick="return confirm('Weet je zeker dat je deze reservering wilt verwijderen? Alle bestellingen voor deze reservering worden ook verwijderd')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>