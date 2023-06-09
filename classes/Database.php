<?php
class Database {
    private $dbhost = "localhost";
    private $dbName = "bbb";
    private $dbUsername = "admin";
    private $dbPassword = "UzIF98xBl8ZMRwW4";

    private $conn;

    public function __construct() {
        $this->conn = new PDO("mysql:host=$this->dbhost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
    }

    public function queryHas($sql, $param) {
        $stmt = $this->conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if($stmt->execute($param)) {
            $result = $stmt->fetchAll();
            return !empty($result);
        } else {
            return false;
        }
    }

    public function query($sql, $param) {
        $stmt = $this->conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if($stmt->execute($param)) {
            return true;
        } else {
            return false;
        }
    }

    public function queryResult($sql, $param) {
        $stmt = $this->conn->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if($stmt->execute($param)) {
            $result = $stmt->fetchAll();
            return $result;
        } else {
            return false;
        }
    }
}

$database = new Database();
?>