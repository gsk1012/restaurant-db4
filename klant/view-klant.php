<?php
include_once 'klant.php';
$klant = new Klant($myDb);
$klanten = $klant->getAlleKlanten();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
    <title>Document</title>
    <style>
        form {
            width: 50%;
        }

        .btn {
            width: 100px;
        }

        form .form-control   {
            border: 1px solid gray;
        }

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
<h1>Klanten Overzicht</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Klant ID</th>
                <th scope="col">Naam</th>
                <th scope="col">Email</th>
                <th scope="col">Actie</th>
                <th scope="col">Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($klanten as $klant) : ?>
                <tr>
                    <td><?php echo $klant['klant_id']; ?></td>
                    <td><?php echo $klant['naam']; ?></td>
                    <td><?php echo $klant['email']; ?></td>
                    <td>
                        <a href="edit-klant.php?id=<?php echo $klant['klant_id']; ?>" class="btn btn-warning">Bewerken</a>
                    </td>
                    <td>
                        <a href="delete-klant.php?id=<?php echo $klant['klant_id']; ?>" class="btn btn-danger"
                        onclick="return confirm('Weet je zeker dat je deze klant wilt verwijderen?')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>