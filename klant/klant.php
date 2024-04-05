<?php
include_once '../db.php';

class Klant {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertKlant($naam, $email) {
        return $this->dbh->execute("INSERT INTO klant (naam, email)
        VALUES (?,?)", [$naam, $email]);
    }

    public function getAlleKlanten() {
        $stmt = $this->dbh->execute("SELECT * FROM klant");
        $klanten = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $klanten;
    }

    public function getKlantById($klant_id) {
        $stmt = $this->dbh->execute("SELECT * FROM klant WHERE klant_id = ?", [$klant_id]);
        $klant = $stmt->fetch(PDO::FETCH_ASSOC);
        return $klant;
    }

    public function editKlant($klant_id, $naam, $email) {
        return $this->dbh->execute("UPDATE klant SET naam = ?, email = ? WHERE klant_id = ?", [$naam, $email, $klant_id]);
    }

    public function deleteKlant($klant_id) {
        return $this->dbh->execute("DELETE FROM klant WHERE klant_id = ?", [$klant_id]);
    }
}


?>