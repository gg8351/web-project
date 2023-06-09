<?php
session_start();
require_once('../classes/UserManager.php');
if(isset($_SESSION['uid'], $_FILES['pfp'])) {
    $uid = $_SESSION['uid'];
    $file = $_FILES['pfp'];
    $type = mime_content_type($file['tmp_name']);
    $ext;
    if(strcmp($type, "image/png") == 0) {
        $ext = ".png";
    } elseif(strcmp($type, "image/jpeg") == 0) {
        $ext = ".jpeg";
    } else {
        die();
    }
    $umgr->setPfp($uid, sha1_file($file['tmp_name']) . $ext);
    move_uploaded_file(
        $file['tmp_name'],
        $_SERVER['DOCUMENT_ROOT'] . "\\public\\images\\" . sha1_file($file['tmp_name']) . $ext
    );
    header('location: ../profile.php');
} else {
    header('location: ../profile.php');
    die();
}

?>