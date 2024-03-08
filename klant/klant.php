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
}


?>