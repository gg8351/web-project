<?php
require_once('Database.php');
class PublicEventManager {
    private Database $db;
    public function __construct($db)
    {
       $this->db = $db;
    }

    public function addEvent($title, $creatorId, $date, $hour, $place, $desc, $link)
    {
        $sql = "INSERT INTO public_event(title, creatorId, date, hour, place, description, extLink) VALUES
        (?, ?, ?, ?, ?, ?, ?);";
        $this->db->query($sql, ["$title", "$creatorId", "$date", "$hour", "$place", "$desc", "$link"]);
    }

    public function getAllEvents() {
        $sql = "SELECT * FROM public_event ORDER BY date DESC";
        return $this->db->queryResult($sql, array());
    }
    
    function getEvent($puid) {
        $sql = "SELECT * FROM public_event WHERE puid = ?";
        return $this->db->queryResult($sql, ["$puid"]);
    }

    public function getAllComments($puid) {
        $sql = "SELECT * FROM pu_comment WHERE puid = ?";
        return $this->db->queryResult($sql, ["$puid"]);
    }

    public function addComment($uid, $puid, $content, $now) {
        $sql = "INSERT INTO pu_comment(commenter, puid, commentDate, content) VALUES (?, ?, ?, ?)";
        return $this->db->query($sql, ["$uid", "$puid", "$now", "$content"]);
    }
}

$pumgr = new PublicEventManager($database);

?>