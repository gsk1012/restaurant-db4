<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserveringssysteem</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    form {
      width: 50%;
    }

    .btn {
      width: 100px;
    }

    form .form-control {
      border: 1px solid gray;
    }

    .nav-item .nav-link {
      font-size: 30px;
      margin: 20px 80px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../klant/insert-klant.php">Klanten</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../product/insert-product.php">Producten</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../bestelling/insert-bestelling.php">Bestellingen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../reservering/insert-reservering.php">Reserveringen</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../tafel/insert-tafel.php">Tafels</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../rekening/rekening-overzicht.php">Rekening</a>
          </li>
      </div>
    </div>
  </nav>
</body>

</html>