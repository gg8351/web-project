<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/PrsEventManager.php');
if(isset($_POST['name'], $_POST['date'], $_POST['deadline'], $_POST['recName'], $_POST['recEmail'], $_POST['iban'], $_POST['desc'])) {
    $resp = new Response();
    if(!isset($_SESSION['uid'])) {
        $resp->add("Вие не сте влязли в системата.");
        echo $resp->json();
        die();
    }
    $name = $_POST['name'];
    $date = $_POST['date'];
    $deadline = $_POST['deadline'];
    $recName = $_POST['recName'];
    $recEmail = $_POST['recEmail'];
    $iban = $_POST['iban'];
    $desc = $_POST['desc'];
    $creator = $_SESSION['uid'];

    if(strlen($name) < 3) {
        $resp->add("Заглавието трябва да е поне 3 символа");
    }
    if(!$pemgr->validDate($date)) {
        $resp->add("Датата на събитието не е валидна");
    } else if(!$pemgr->afterToday($date)) {
        $resp->add("Събитието трябва да е с бъдеща дата.");
    }
    if(!$pemgr->validDate($deadline)) {
        $resp->add("Крайната дата не е валидна.");
    } else if(!$pemgr->validDeadline($date, $deadline)) {
        $resp->add("Крайната дата е след датата на събитието!");
    }
    if ($resp->successful()) {
        $pemgr->addEvent($name, $creator, $date, $deadline, $recName, $recEmail, $iban, $desc);
    }
    echo $resp->json();
}