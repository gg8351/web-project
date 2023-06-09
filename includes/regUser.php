<?php
require_once('../classes/Response.php');
require_once('../classes/Database.php');
require_once('../classes/UserManager.php');
require_once('functions.php');


if(isset($_POST['email'], $_POST['name'], $_POST['pwd'], $_POST['cpwd'])) {
    $resp = new Response();

    $email = $_POST['email'];
    $name = $_POST['name'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    if(!$umgr->validEmail($email)) {
        $resp->add("Невалиден e-mail.");
    } else if($umgr->userExists($email)) {
        $resp->add("Вече е регистриран потребител с този e-mail.");
    }
    if(!$umgr->validPassword($pwd)) {
        $resp->add("Паролата трябва да има поне 3 символа.");
    }
    else if(!$umgr->matchPassword($pwd, $cpwd)) {
        $resp->add("Паролите не съвпадат.");
    }
    if(!$umgr->validName($name)) {
        $resp->add("Името е прекалено дълго.");
    }
    if($resp->successful()) {
        if(!$umgr->registerUser($email, $pwd, $name)) {
            $resp->add("Сървърна грешка - неуспешна регистрация.");
        }
    }

    echo $resp->json();
} else {
    header('location: ../register.php');
    die();
}
?>