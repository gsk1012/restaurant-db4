<?php
include_once '../db.php';
include_once '../navbar/navbar.php';
include_once 'rekening.php';

$rekening = new Rekening($myDb);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekening Overzicht</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
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
<h1>Rekening Overzicht</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Rekening ID</th>
                <th scope="col">Tafelnummer</th>
                <th scope="col">Bekijk rekening</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</body>
</html>
