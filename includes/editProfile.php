<?php
session_start();
require_once('../classes/Response.php');
require_once('../classes/UserManager.php');

if(isset($_SESSION['uid'])) {
    $uid = $_SESSION['uid'];
    if(isset($_POST['email'], $_POST['pwd'])) {
        $resp = new Response();
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $hashedPwd = hash('sha256',  $pwd);
        $savedPwd = $umgr->getField($uid, "pwd");
        if(strcmp($hashedPwd, $savedPwd) !== 0) {
            $resp->add("Паролата не съвпада.");
        }
        if(!$umgr->validEmail($email)) {
            $resp->add("Електронната поще не е валидна.");
        }
        if($resp->successful()) {
            $umgr->updateEmail($uid, $email);
        }
        echo $resp->json();
    }

    if(isset($_POST['pwd'], $_POST['cpwd'], $_POST['oldpwd'])) {
        $resp = new Response();
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        $oldpwd = $_POST['oldpwd'];

        $hashedPwd = hash('sha256',  $oldpwd);
        $savedPwd = $umgr->getField($uid, "pwd");
        if(strcmp($hashedPwd, $savedPwd) !== 0) {
            $resp->add("Текущата паролата не съвпада.");
        }
        if(!$umgr->validPassword($pwd)) {
            $resp->add("Паролата е прекалено къса.");
        }
        if(!$umgr->matchPassword($pwd, $cpwd)) {
            $resp->add("Новата парола не е потвърдена.");
        }

        if($resp->successful()) {
            $hashedNewPwd = hash('sha256', $pwd);
            $umgr->updatePassword($uid, $hashedNewPwd);
        }
        echo $resp->json();
    }

    if(isset($_POST['name'])) {
        $resp = new Response();
        $name = $_POST['name'];

        if(strlen($name) < 2) {
            $resp->add("Името е прекалено късо.");
        }
        
        if($resp->successful()) {
            $umgr->updateName($uid, $name);
        }

        echo $resp->json();
    }


    if(isset($_POST['dob'])) {
        $resp = new Response();
        $dob = $_POST['dob'];

        if(!$umgr->validDob($dob)) {
            $resp->add("Датата не е валидна.");
        }
        if($resp->successful()) {
            $umgr->updateDob($uid, $dob);
        }

        echo $resp->json();
    }
} else {
    header('location: ./index.php');
    die();
}

?>