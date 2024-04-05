<?php
include_once 'tafel.php';
$tafel = new Tafel($myDb);
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
                <th scope="col">Beschikbaarheid</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tafels as $tafel) : ?>
                <tr>
                    <td><?php echo $tafel['tafel_id']; ?></td>
                    <td><?php echo $tafel['tafelnummer']; ?></td>
                    <td><?php echo $tafel['status']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
