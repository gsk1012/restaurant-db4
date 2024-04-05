
<?php
include_once 'bestelling.php';
include_once '../navbar/navbar.php';

$tafels = $myDb->execute("SELECT * FROM tafel")->fetchAll();
$producten = $myDb->execute("SELECT * FROM product")->fetchAll();

$bestelling = new Bestelling($myDb);

$bestelling_id = $_GET['id'];
$huidige_bestelling = $bestelling->getBestellingById($bestelling_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $bestelling->editBestelling($bestelling_id, $_POST['tafel'], $_POST['product'], $_POST['aantal'], $_POST['opmerking']);
        header('Location: insert-bestelling.php');
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// tafel edit werkt niet
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling Bewerken</title>
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
    <h1 style="text-align: center;">Bewerk bestelling</h1>

    <form action="" method="post" onsubmit="return validateForm()">

        <label for="tafel" style="font-size: 25px;">Tafel</label>
        <select class="form-control" name="tafel" id="tafel">
            <option value="">Kies een tafelnummer</option>
            <?php foreach ($tafels as $tafel) : ?>
                <option value="<?php echo $tafel['tafel_id']; ?>" <?php echo ($tafel['tafel_id'] == $huidige_bestelling['tafel_id']) ? 'selected' : ''; ?>><?php echo $tafel['tafelnummer']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="product" style="font-size: 25px;">Product</label>
        <select class="form-control" name="product" id="product">
            <option value="">Kies een product</option>
            <?php foreach ($producten as $product) : ?>
                <option value="<?php echo $product['product_id']; ?>" <?php echo ($product['product_id'] == $huidige_bestelling['product_id']) ? 'selected' : ''; ?>><?php echo $product['naam']; ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="aantal" style="font-size: 25px;">Aantal</label>
        <input class="form-control" type="number" name="aantal" id="aantal" min="1" value="<?php echo $huidige_bestelling['aantal']; ?>"><br>

        <label for="opmerking" style="font-size: 25px;">Opmerking</label>
        <textarea class="form-control" name="opmerking" id="opmerking"><?php echo $huidige_bestelling['opmerking']; ?></textarea><br>

        <input class="btn btn-primary" name="submit" type="submit" value="Bewerken">
    </form>
</body>
</html>
