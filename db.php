<?php

class DB {
    private $dbh;
    protected $stmt;

    public function __construct($db, $host = "localhost:3308", $user = "root", $pass = "")
    {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db;", $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die ("Connection error: " . $e->getMessage());
        }
    }
    public function execute($sql, $placeholders = null) {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($placeholders);
        return $stmt;
    }

    public function lastInsertId() {
        return $this->dbh->lastInsertId();
    }
}
$myDb = new DB('pdo_4');
?>
