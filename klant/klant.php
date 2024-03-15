<?php
include_once '../db.php';

class Klant {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertKlant($naam, $password, $email) {
        return $this->dbh->execute("INSERT INTO klant (naam, password, email)
        VALUES (?,?,?)", [$naam, $password, $email]);
    }

    public function getAlleKlanten() {
        $stmt = $this->dbh->execute("SELECT * FROM klant");
        $klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $klanten;
    }

    public function deleteKlant($klant_id) {
        return $this->dbh->execute("DELETE FROM klant WHERE klant_id = ?", [$klant_id]);
    }
}


?>