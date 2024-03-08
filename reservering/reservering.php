<?php
include_once '../db.php';

class Reservering {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertReservering($datum, $tijd, $aantal_personen, $klant_id, $tafel_id) {
        return $this->dbh->execute("INSERT INTO reservering (datum, tijd, aantal_personen, klant_id, tafel_id)
        VALUES (?,?,?,?,?)", [$datum, $tijd, $aantal_personen, $klant_id, $tafel_id]);
    }

}
?>