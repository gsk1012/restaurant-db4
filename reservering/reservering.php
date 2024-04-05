<?php
include_once '../db.php';

class Reservering {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }

    public function insertReservering($datum, $tijd, $aantal_personen, $klant_id, $tafel_id) {
        $this->dbh->execute("UPDATE tafel SET status = 'gereserveerd' WHERE tafel_id = ?", [$tafel_id]);

        $this->dbh->execute("INSERT INTO reservering (datum, tijd, aantal_personen, klant_id, tafel_id)
        VALUES (?,?,?,?,?)", [$datum, $tijd, $aantal_personen, $klant_id, $tafel_id]);

        $reservering_id = $this->dbh->lastInsertId();

        $this->dbh->execute("UPDATE tafel SET reservering_id = ? WHERE tafel_id = ?", [$reservering_id, $tafel_id]);

        return $reservering_id;
    }

    public function editReservering($reservering_id, $datum, $tijd, $aantal_personen, $klant_id, $tafel_id) {
         return $this->dbh->execute("UPDATE reservering SET datum = ?, tijd = ?, aantal_personen = ?, klant_id = ?, tafel_id = ? WHERE reservering_id = ?",
                                                                                 [$datum, $tijd, $aantal_personen, $klant_id, $tafel_id, $reservering_id]);
    }

    public function getAlleReserveringen() {
        $stmt = $this->dbh->execute("SELECT * FROM reservering");
        $reserveringen = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $reserveringen;
    }

    public function getReserveringById($reservering_id) {
        $stmt = $this->dbh->execute("SELECT * FROM reservering WHERE reservering_id = ?", [$reservering_id]);
        $reservering = $stmt->fetch(PDO::FETCH_ASSOC);
        return $reservering;
    }

    public function deleteReservering($reservering_id) {
        try {
            $tafel_id = $this->dbh->execute("SELECT tafel_id FROM reservering WHERE reservering_id = ?", [$reservering_id])->fetchColumn();

            $this->dbh->execute("DELETE FROM bestelling WHERE tafel_id IN (SELECT tafel_id FROM reservering WHERE reservering_id = ?)", [$reservering_id]);

            $this->dbh->execute("UPDATE tafel SET status = 'beschikbaar', reservering_id = NULL WHERE tafel_id = ?", [$tafel_id]);

            $this->dbh->execute("DELETE FROM reservering WHERE reservering_id = ?", [$reservering_id]);

            return true;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
}
?>
