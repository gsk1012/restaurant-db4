<?php
include_once 'tafel.php';
include_once '../navbar/navbar.php';
$tafel = new Tafel($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $tafel->insertTafel($_POST['tafelnummer']);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$tafels = $tafel->getAlleTafels();
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
<body><br>
    <h1>Tafel Overzicht</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Tafel ID</th>
                <th scope="col">Tafelnummer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tafels as $tafel) : ?>
                <tr>
                    <td><?php echo $tafel['tafel_id']; ?></td>
                    <td><?php echo $tafel['tafelnummer']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br><br>
    <h1 style="text-align: center;">Tafel toevoegen</h1>
    <form action="" method="post">
        <label for="tafelnummer" style="font-size: 25px;">Tafelnummer</label><br>
        <input class="form-control" type="number" name="tafelnummer"><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form><br>
    <div id="success-message" style="display: none; text-align: center;">
        <h1 style="color: green;">Tafel succesvol toegevoegd!</h1>
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
