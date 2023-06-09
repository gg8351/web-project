<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/UserManager.php';
?>
<!DOCTYPE html>
<html>

<head>
   <meta name="viewport" content="width=device-width">
   <meta charset="utf-8" />
   <title>Подарък за всеки</title>
   <link rel="stylesheet" href="css/reset.css" />
   <link rel="stylesheet" href="css/style.css" />
   <link rel="stylesheet" href="css/content.css" />
   <link rel="stylesheet" href="css/event.css" />
   <link rel="stylesheet" href="css/profile.css" />
</head>

<body>
   <nav>
      <a href="index.php">Начало</a>
      <?php
      if (isset($_SESSION['uid'])) {
         $name = $umgr->getField($_SESSION['uid'], "email");
         echo " | <a href='users.php'>Потребители</a> | <a href='events.php'>Събития</a> | <a href='addEvent.php'>Добави събитие</a> | <a href='profile.php'>Профил</a> ($name) | 
            <a href='logout.php'>Изход</a>";
      } else {
         echo ' | <a href="register.php">Регистрация</a> | 
            <a href="login.php">Вход</a>';
      }
      ?>
   </nav>
   <main>