<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekening</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        .rekening-container {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .rekening-title {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .rekening-item {
            margin-bottom: 10px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Rekening Overzicht</h1>
        <div class="rekening-container">
            <?php
            // Include the database configuration file
            include_once '../db.php';
            include_once 'rekening.php';

            // Create a new Rekening instance
            $rekening = new Rekening($myDb);

            // Check if a table ID is passed via GET
            if(isset($_GET['tafel_id'])) {
                $tafel_id = $_GET['tafel_id'];

                // Generate the bill for the specified table
                $rekening_html = $rekening->generateRekening($tafel_id);

                // Display the generated bill
                echo $rekening_html;
            } else {
                // Display an error message if no table ID is provided
                echo "<p class='text-danger'>Geen tafel-ID opgegeven.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
