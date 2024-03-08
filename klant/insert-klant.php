<?php
include_once 'klant.php';
$klant = new Klant($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $klant->insertKlant($_POST['naam'],password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['email']);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
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
        body {
            padding: 1rem;
        }
        form {
            width: 50%;
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
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table><br><br>
    <h1>Klant toevoegen</h1>
    <form action="" method="post">
        <label for="naam" style="font-size: 25px;">Naam</label><br>
        <input class="form-control" type="text" name="naam"><br>
        <label for="email" style="font-size: 25px;">Email</label>
        <input class="form-control" type="email" name="email"><br>
        <label for="password" style="font-size: 25px;">Wachtwoord</label>
        <input class="form-control" type="password" name="password"><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form><br>
    <div id="success-message" style="display: none; text-align: center;">
        <h1 style="color: green;">Klant succesvol toegevoegd!</h1>
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
