<?php
include_once 'product.php';
include_once '../navbar/navbar.php';
$product = new Product($myDb);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $product->insertProduct($_POST['naam'], $_POST['prijs'], $_POST['beschrijving']);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

    try {
        $product_id = $_POST['delete_product_id'];
        $product->deleteProduct($product_id);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

$products = $product->getAlleProducten();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous" defer></script>
    <title>Producten</title>
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
<h1>Producten Overzicht</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Naam</th>
                <th scope="col">Prijs</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['product_id']; ?></td>
                    <td><?php echo $product['naam']; ?></td>
                    <td><?php echo $product['prijs']; ?></td>
                    <td><?php echo $product['beschrijving']; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="delete_product_id" value="<?php echo $product['product_id']; ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit product wilt verwijderen?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table><br><br>
    <h1 style="text-align: center;">Product toevoegen</h1>
    <form action="" method="post">
        <label for="naam" style="font-size: 25px;">Naam</label><br>
        <input class="form-control" type="text" name="naam"><br>
        <label for="prijs" style="font-size: 25px;">Prijs</label>
        <input class="form-control" type="number" name="prijs"><br>
        <div class="form-floating">
            <textarea name="beschrijving" class="form-control" placeholder="" id="floatingTextarea"></textarea>
            <label for="floatingTextarea">Beschrijving</label>
        </div><br>
        <input class="btn btn-primary" name="submit" type="submit" value="Toevoegen">
    </form><br>
    <div id="success-message" style="display: none; text-align: center;">
        <h1 style="color: green;">Product succesvol toegevoegd!</h1>
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