<?php
include_once '../db.php';

class Reservering {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertReservering($datum, $tijd, $aantal_personen, $klant_id, $tafel_id) {
        // Update de status van de tafel naar "gereserveerd"
        $this->dbh->execute("UPDATE tafel SET status = 'gereserveerd' WHERE tafel_id = ?", [$tafel_id]);

        // Voeg de reservering toe
        return $this->dbh->execute("INSERT INTO reservering (datum, tijd, aantal_personen, klant_id, tafel_id)
        VALUES (?,?,?,?,?)", [$datum, $tijd, $aantal_personen, $klant_id, $tafel_id]);
    }

    public function getAlleReserveringen() {
        $stmt = $this->dbh->execute("SELECT * FROM reservering");
        $reseveringen = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reseveringen;
    }



}
?>