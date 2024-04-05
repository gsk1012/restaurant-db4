<?php
include_once 'klant.php';
include_once '../navbar/navbar.php';
$klant = new Klant($myDb);

$klant_id = $_GET['id'];
$huidige_klant = $klant->getKlantById($klant_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $klant->editKlant($klant_id, $_POST['naam'], $_POST['email']);
        header('Location: insert-klant.php');
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
    <h1 style="text-align: center;">Klant bewerken</h1>
    <form action="" method="post">
        <label for="naam" style="font-size: 25px;">Naam</label><br>
        <input class="form-control" type="text" name="naam" value="<?php echo $huidige_klant['naam']; ?>"><br>
        <label for="email" style="font-size: 25px;">Email</label>
        <input class="form-control" type="email" name="email" value="<?php echo $huidige_klant['email']; ?>"><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Bewerken">
    </form>
</body>
</html>