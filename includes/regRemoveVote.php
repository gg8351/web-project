<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/GiftManager.php');

if(isset($_SESSION['uid'], $_POST['prid'], $_POST['giftId'])) {
    $uid = $_SESSION['uid'];
    $prid = $_POST['prid'];
    $giftId = $_POST['giftId'];
    $resp = new Response();
    $giftmgr->removeVote($uid, $prid, $giftId);
    echo $resp->json();
}