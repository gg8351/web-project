<?php

require_once('Database.php');
class GiftManager {
    private Database $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function addGift($prid, $name, $url) {
        $sql = "INSERT INTO gift(forEvent, name, url) VALUES
        (?, ?, ?)";
        $this->db->query($sql, ["$prid", "$name", "$url"]);
    }

    public function getAll($prid) {
        $sql = "SELECT * FROM gift WHERE forEvent = ?";
        return $this->db->queryResult($sql, ["$prid"]);
    }

    public function getVoters($prid, $giftId) {
        $emailsql = "SELECT email FROM votedforgift JOIN users on users.uid = votedforgift.uid
        WHERE prid = ? AND giftID = ?";
        $emails = $this->db->queryResult($emailsql, ["$prid", $giftId]);

        $countsql = "SELECT COUNT(*) AS cnt FROM votedforgift JOIN users on users.uid = votedforgift.uid
        WHERE prid = ? AND giftID = ?";
        $counts = $this->db->queryResult($countsql, ["$prid", $giftId]);
        $count = $counts[0]['cnt'];

        if($count == 0) {
            return "0 човека";
        }

        $result = "";
        $i = 0;
        foreach($emails as $email) {
            $result .= $email['email'] . " ";
            if($i>=5) {
                $count = $count-5;
                $result .= "и $count други.";
                break;
            }
            ++$i;
        }
        return $result;
    }

    public function hasVoted($uid, $giftId) {
        $sql = "SELECT * FROM votedforgift WHERE uid = ? AND giftId = ?";
        return $this->db->queryHas($sql, ["$uid", "$giftId"]);
    }

    public function addVote($uid, $prid, $giftId) {
        $sql = "INSERT INTO votedforgift(uid, prid, giftId) VALUES (?, ?, ?);";
        return $this->db->query($sql, ["$uid", "$prid", "$giftId"]);
    }

    public function removeVote($uid, $prid, $giftId) {
        $sql = "DELETE FROM votedforgift WHERE uid = ? AND prid = ? AND giftID = ?;";
        return $this->db->query($sql, ["$uid", "$prid", "$giftId"]);
    }
}

$giftmgr = new GiftManager($database);