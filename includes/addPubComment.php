<?php
session_start();

require_once('../classes/Response.php');
require_once('../classes/PubEventManager.php');

if(isset($_SESSION['uid'], $_POST['puid'], $_POST['content'])) {
    $uid = $_SESSION['uid'];
    $puid = $_POST['puid'];
    $content = $_POST['content'];
    $now = date('Y-m-d H:i:s');
    $resp = new Response();
    if(strlen($content) < 2) {
        $resp->add("Коментарът е прекалено къс.");
    }

    if($resp->successful()) {
        $pumgr->addComment($uid, $puid, $content, $now);
    }

    echo $resp->json();
}
?>