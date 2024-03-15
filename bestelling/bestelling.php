<?php
include_once '../db.php';

class Bestelling {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertBestelling($bestelling_id, $tafel_id, $product_id, $aantal, $opmerking) {
        return $this->dbh->execute("INSERT INTO bestelling (bestelling_id, tafel_id, product_id, aantal, opmerking)
        VALUES (?,?,?,?, ?)", [$bestelling_id, $tafel_id, $product_id, $aantal, $opmerking ]);
    }

    public function getAlleBestellingen() {
        $stmt = $this->dbh->execute("SELECT * FROM bestelling");
        $bestellingen = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $bestellingen;
    }

    public function controleerReservering($tafel_id) {
        $reservering = $this->dbh->execute("SELECT * FROM reservering WHERE tafel_id = ?", [$tafel_id])->fetch();
        return $reservering ? true : false;
    }
}
?>