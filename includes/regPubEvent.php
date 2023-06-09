<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/PrsEventManager.php');
require_once('../classes/PubEventManager.php');

if(isset($_POST['name'], $_POST['date'], $_POST['hour'], $_POST['place'], $_POST['desc'], $_POST['external'])) {
    $resp = new Response();
    if(!isset($_SESSION['uid'])) {
        $resp->add("Вие не сте влязли в системата.");
        echo $resp->json();
        die();
    }

    $name = $_POST['name'];
    $date = $_POST['date'];
    $hour = $_POST['hour'];
    $place = $_POST['place'];
    $desc = $_POST['desc'];
    $link = $_POST['external'];

    if(strlen($name) < 3) {
        $resp->add("Заглавието трябва да е поне 3 символа дълго.");
    }
    if(!$pemgr->validDate($date)) {
        $resp->add("Събитието трябва да е с бъдеща дата.");
    }
    if(!$pemgr->validHour($hour)) {
        $resp->add("Часът не е във формат hh:mm.");
    }

    if($resp->successful()) {
        $pumgr->addEvent($name, $_SESSION['uid'], $date, $hour, $place, $desc, $link);
    }
    echo $resp->json();
}

?>