<?php
require_once('../classes/Response.php');
require_once('../classes/Database.php');
require_once('../classes/UserManager.php');
require_once('functions.php');


if(isset($_POST['email'], $_POST['pwd'])) {
    $resp = new Response();

    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    if(!$umgr->validEmail($email)) {
        $resp->add("Невалиден e-mail.");
    } else if(!$umgr->userExists($email)) {
        $resp->add("Няма потребител с такъв e-mail или парола.");
    }
    else if(!$umgr->verify($email, $pwd)) {
        $resp->add("Няма потребител с такъв e-mail или парола.");
    }

    if($resp->successful()) {
        session_start();
        $_SESSION['uid'] = $umgr->getUid($email);
    }

    echo $resp->json();
} else {
    header('location: ../register.php');
    die();
}
?>