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

    public function getAlleProducten() {
        $stmt = $this->dbh->execute("SELECT * FROM product");
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function getProductById($product_id) {
        $stmt = $this->dbh->execute("SELECT * FROM product WHERE product_id = ?", [$product_id]);
        $product_id = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product_id;
    }

    public function editProduct($product_id, $naam, $prijs, $beschrijving) {
        return $this->dbh->execute("UPDATE product SET naam = ?, prijs = ?, beschrijving = ? WHERE product_id = ?", [$naam, $prijs,$beschrijving, $product_id]);
    }

    public function deleteProduct($product_id) {
        return $this->dbh->execute("DELETE FROM product WHERE product_id = ?", [$product_id]);
    }
}

?>