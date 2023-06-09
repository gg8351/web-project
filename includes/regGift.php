<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/GiftManager.php');
require_once('../classes/PrsEventManager.php');

if(isset($_POST['prid'], $_POST['name'], $_POST['url'])) {
    $uid = $_SESSION['uid'];
    $prid = $_POST['prid'];
    $name = $_POST['name'];
    $url = $_POST['url'];

    $resp = new Response();
    if(!$pemgr->isHost($uid, $prid)) {
        $resp->add("Само организатора на събитието може да добавя подаръци");
    }
    if(strlen($name) < 3) {
        $resp->add("Името трябва да е по-дълго от 3 символа");
    }

    if($resp->successful()) {
        $giftmgr->addGift($prid, $name, $url);
    }
    echo $resp->json();

}