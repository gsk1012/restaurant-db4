<?php
include_once 'bestelling.php';
include_once '../navbar/navbar.php';
include_once '../bestelling/view-bestelling.php';
$bestelling = new Bestelling($myDb);

$tafels = $myDb->execute("SELECT * FROM tafel")->fetchAll();
$producten = $myDb->execute("SELECT * FROM product")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        if (empty($_POST['tafel']) || empty($_POST['product']) || empty($_POST['aantal'])) {
            throw new Exception('Alle velden zijn vereist');
        }

        $tafel_id = $_POST['tafel'];
        $tafelCheck = $myDb->execute("SELECT tafel_id FROM tafel WHERE tafel_id = ?", [$tafel_id])->fetch();
        if (!$tafelCheck) {
            throw new Exception('Ongeldige tafel_id');
        }

        if (!$bestelling->controleerReservering($tafel_id)) {
            throw new Exception('<h1 style= "color:red; text-align:center">Er is geen reservering gevonden voor geselecteerde tafel</h1>');
        }

        $product_id = $_POST['product'];
        $productCheck = $myDb->execute("SELECT product_id FROM product WHERE product_id = ?", [$product_id])->fetch();
        if (!$productCheck) {
            throw new Exception('Ongeldig product_id');
        }

        $opmerking = isset($_POST['opmerking']) ? $_POST['opmerking'] : null;
        $bestelling->insertBestelling(null, $tafel_id, $product_id, $_POST['aantal'], $opmerking);

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
    <h1 style="text-align: center;">Plaats een bestelling</h1>

    <form action="" method="post" onsubmit="return validateForm()">

        <label for="tafel" style="font-size: 25px;">Tafel</label>
        <select class="form-control" name="tafel" id="tafel">
            <option value="">Kies een tafelnummer</option>
            <?php foreach ($tafels as $tafel) : ?>
                <option value="<?php echo $tafel['tafel_id']; ?>"><?php echo $tafel['tafelnummer']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="product" style="font-size: 25px;">Product</label>
        <select class="form-control" name="product" id="product">
            <option value="">Kies een product</option>
            <?php foreach ($producten as $product) : ?>
                <option value="<?php echo $product['product_id']; ?>"><?php echo $product['naam']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="aantal" style="font-size: 25px;">Aantal</label>
        <input class="form-control" type="number" name="aantal" id="aantal" min="1"><br>

        <label for="opmerking" style="font-size: 25px;">Opmerking</label>
        <textarea class="form-control" name="opmerking" id="opmerking"></textarea><br>

        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form>

    <div id="success-message" style="display: none; text-align: center;">
        <h1 style="color: green;">Bestelling succesvol geplaatst</h1>
    </div>
    <script>
        function validateForm() {
            var selectedTafel = document.getElementById('tafel').value;
            var errorMessage = document.getElementById('error-message');

            if (selectedTafel === "") {
                alert("Selecteer alstublieft een tafel.");
                return false;
            }

            // if (errorMessage.style.display === 'block') {
            //     alert("Er is geen reservering gevonden voor deze tafel. Selecteer een andere tafel of maak een reservering.");
            //     return false;
            // }

            // return true;
        }

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
