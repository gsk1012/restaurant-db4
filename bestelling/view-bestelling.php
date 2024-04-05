<?php
include_once 'bestelling.php';
$bestelling = new Bestelling($myDb);
$producten = $myDb->execute("SELECT * FROM product")->fetchAll();
$bestellingen = $bestelling->getAlleBestellingen();
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
<h1>Bestellingen Overzicht</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Bestelling ID</th>
                <th scope="col">Tafelnummer</th>
                <th scope="col">Product naam</th>
                <th scope="col">Aantal</th>
                <th scope="col">Opmerking</th>
                <th scope="col">Actie</th>
                <th scope="col">Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bestellingen as $bestelling) : ?>
                <tr>
                    <td><?php echo $bestelling['bestelling_id']; ?></td>
                    <td><?php echo $bestelling['tafel_id']; ?></td>
                    <td><?php
                        $productId = $bestelling['product_id'];
                        $productName = "";
                        foreach ($producten as $product) {
                            if ($product['product_id'] == $productId) {
                                $productName = $product['naam'];
                                break;
                            }
                        }
                        echo $productName;
                    ?></td>
                    <td><?php echo $bestelling['aantal']; ?></td>
                    <td><?php echo $bestelling['opmerking']; ?></td>
                    <td>
                        <a href="edit-bestelling.php?id=<?php echo $bestelling['bestelling_id']; ?>" class="btn btn-warning">Bewerken</a>
                    </td>
                    <td>
                        <a href="delete-bestelling.php?id=<?php echo $bestelling['bestelling_id']; ?>" class="btn btn-danger"
                        onclick="return confirm('Weet je zeker dat je deze bestelling wilt verwijderen?')">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
