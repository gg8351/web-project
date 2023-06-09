<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/GiftManager.php');

if(isset($_SESSION['uid'], $_POST['prid'], $_POST['giftId'])) {
    $uid = $_SESSION['uid'];
    $prid = $_POST['prid'];
    $giftId = $_POST['giftId'];

    $resp = new Response();
    if($giftmgr->hasVoted($uid, $giftId)) {
        $resp->add("Вече сте гласували за този подарък.");
    }
    if($resp->successful()) {
        $giftmgr->addVote($uid, $prid, $giftId);
    }
    echo $resp->json();
}