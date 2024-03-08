<?php
include_once '../db.php';

class Product {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertProduct($naam, $prijs, $beschrijving) {
        return $this->dbh->execute("INSERT INTO product (naam, prijs, beschrijving)
        VALUES (?,?,?)", [$naam, $prijs, $beschrijving]);
    }
}


?>