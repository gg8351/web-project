<?php

require_once('Database.php');
class PersonalEventManager {
    private Database $db;
    public function __construct($db)
    {
       $this->db = $db;
    }

    public function addEvent($title, $creatorId, $date, $deadline, $recName, $recEmail, $iban, $desc)
    {
        $sql = "INSERT INTO private_event(title, creatorId, date, deadline, receiverName, receiverEmail, iban, description) VALUES
        (?, ?, ?, ?, ?, ?, ?, ?);";
        $this->db->query($sql, ["$title", "$creatorId", "$date", "$deadline", "$recName", "$recEmail", "$iban", "$desc"]);
    }

    public function validDate($date)
    {
        $regex = "/[0-9]{4}-((0[0-9])|(1[1-2]))-(([0-2][0-9])|(3[0-1]))/";
        if (preg_match($regex, $date) === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function afterToday($date) {
        $today = date("YYYY-MM-DD");
        return strcmp($today, $date) > 0;
    }

    public function validDeadline($date, $deadline) {
        return strcmp($date, $deadline) > 0;
    }

    public function validHour($hour) {
        $regex = "/[0-2][0-9]\:[0-5][0-9]/";
        if(preg_match($regex, $hour) === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllEvents($email) {
        $sql = "SELECT * FROM private_event WHERE receiverEmail != ?";
        return $this->db->queryResult($sql, ["$email"]);
    }

    public function getEvent($prid) {
        $sql = "SELECT * FROM private_event WHERE prid = ?";
        return $this->db->queryResult($sql, ["$prid"]);
    }

    public function isHost($uid, $prid) {
        $sql = "SELECT * FROM private_event WHERE prid = ? AND creatorId = ?";
        return $this->db->queryHas($sql, ["$prid", "$uid"]);
    }

    public function updateIban($prid, $iban) {
        $sql = "UPDATE private_event SET iban = ? WHERE prid = ?";
        return $this->db->query($sql, ["$iban", "$prid"]);
    }
    public function updatePrice($prid, $price) {
        $sql = "UPDATE private_event SET targetMoney = ? WHERE prid = ?";
        return $this->db->query($sql, [$price, $prid]);
    }
    public function updateFunds($prid, $funds) {
        $sql = "UPDATE private_event SET currentBalance = currentBalance + ? WHERE prid = ?";
        return $this->db->query($sql, [$funds, $prid]);
    }

    public function addComment($uid, $prid, $content, $now) {
        $sql = "INSERT INTO pr_comment(commenter, prid, commentDate, content) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, ["$uid", "$prid", "$now", "$content"]);
    }

    public function getAllComments($prid) {
        $sql = "SELECT * FROM pr_comment WHERE prid = ?";
        return $this->db->queryResult($sql, ["$prid"]);
    }
}

$pemgr = new PersonalEventManager($database);