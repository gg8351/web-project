<?php
class PrivateEvent {
    private Database $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    
}

?>