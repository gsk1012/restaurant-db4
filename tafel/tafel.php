<?php
include_once '../db.php';

class Tafel {
    private $dbh;

    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }
    public function insertTafel($tafelnummer) {
        return $this->dbh->execute("INSERT INTO tafel (tafelnummer)
        VALUES (?)", [$tafelnummer]);
    }

    public function getAlleTafels() {
        $stmt = $this->dbh->execute("SELECT * FROM tafel");
        $tafels = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $tafels;
    }
}


?>