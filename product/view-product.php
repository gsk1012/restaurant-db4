<?php
include_once 'product.php';
$product = new Product($myDb);
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
                        <a href="edit-product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-warning">Bewerken</a>
                    </td>
                    <td>
                        <a href="delete-product.php?id=<?php echo $product['product_id']; ?>" class="btn btn-danger"
                        onclick="return confirm('Weet je zeker dat je deze product wilt verwijderen?')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>