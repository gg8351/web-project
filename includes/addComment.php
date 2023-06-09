<?php
session_start();

require_once('../classes/Response.php');
require_once('../classes/PrsEventManager.php');

if(isset($_SESSION['uid'], $_POST['prid'], $_POST['content'])) {
    $uid = $_SESSION['uid'];
    $prid = $_POST['prid'];
    $content = $_POST['content'];
    $now = date('Y-m-d H:i:s');
    $resp = new Response();
    if(strlen($content) < 2) {
        $resp->add("Коментарът е прекалено къс.");
    }

    if($resp->successful()) {
        $pemgr->addComment($uid, $prid, $content, $now);
    }

    echo $resp->json();
}
?>