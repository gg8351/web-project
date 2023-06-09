<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/PrsEventManager.php');

if (isset($_SESSION['uid'], $_POST['prid'])) {
    $uid = $_SESSION['uid'];
    $prid = $_POST['prid'];
    if (isset($_POST['iban'])) {
        $resp = new Response();
        $iban = $_POST['iban'];

        if (!$pemgr->isHost($uid, $prid)) {
            $resp->add("Само организатора може да променя тези полета!");
        }

        if (strlen($iban) >= 30) {
            $resp->add("IBAN-ът е прекалено дълъг.");
        }
        if (strlen($iban) < 2) {
            $resp->add("IBAN-ът е прекалено къс.");
        }

        if ($resp->successful()) {
            $pemgr->updateIban($prid, $iban);
        }

        echo $resp->json();
    }

    if(isset($_POST['price'])) {
        $resp = new Response();
        $price = $_POST['price'];

        if(strlen($price) > 11) {
            $resp->add("Цената е прекалено дълга.");
        }
        if(!is_numeric($price)) {
            $resp->add("Не сте въвели число.");
        } else if($price < 0) {
            $resp->add("Цената трябва да е положително число.");
        }

        if($resp->successful()) {
            $trunc_price = round($price, 2);
            $pemgr->updatePrice($prid, $trunc_price);
        }

        echo $resp->json();
    }

    if(isset($_POST['funds'])) {
        $resp = new Response();
        $funds = $_POST['funds'];

        if(strlen($funds) > 11) {
            $resp->add("Сумата е прекалено голяма.");
        }
        if(!is_numeric($funds)) {
            $resp->add("Не сте въвели число.");
        }
        else if($funds < 0 ) {
            $resp->add("Сумата трябва да е положително число.");
        }

        if($resp->successful()) {
            $trunc_funds = round($funds, 2);
            $pemgr->updateFunds($prid, $trunc_funds);
        }

        echo $resp->json();
    }

} else {
    header('location: ./events.php');
    die();
}

?>