<?php
include_once('includes/header.php');
?>
<?php
    if(!isset($_SESSION['uid'])) {
    header('location: ./index.php');
    die();
    }
?>
<section>
    <h4>Частни събития</h4>
    <?php
    require_once('./classes/UserManager.php');
    require_once('./classes/PrsEventManager.php');
    $uid = $_SESSION['uid'];
    $email = $umgr->getField($uid, "email");
    $events = $pemgr->getAllEvents($email);
    foreach($events as $event) {
        $prid = $event['prid'];
        $title = $event['title'];
        $host = $umgr->getField($event['creatorId'], "name");
        if(empty($host)) {
            $host = $umgr->getField($event['creatorId'], "email");
        }
        $date = $event['date'];
        $desc = $event['description'];
        if(!empty($desc)) {
            $desc = " - " . mb_substr($desc, 0, 20) . "...";
        }
        echo "<div class='event'>" .
        "<p><a href='./event.php?prid=$prid'>$title</a><span class='italic'>$desc</span></p>" .
        "<p>Дата на събитието: $date</p>" .
        "<p>Организатор: $host</p>" .
        "</div>";
    }
    ?>
</section>
<section>
    <h4>Обществени събития</h4>
    <?php
    require_once('./classes/UserManager.php');
    require_once('./classes/PubEventManager.php');
    $uid = $_SESSION['uid'];
    $events = $pumgr->getAllEvents();
    foreach($events as $event) {
        $puid = $event['puid'];
        $title = $event['title'];
        $host = $umgr->getField($event['creatorId'], "name");
        if(empty($host)) {
            $host = $umgr->getField($event['creatorId'], "email");
        }
        $date = $event['date'];
        $hour = $event['hour'];
        $desc = $event['description'];
        if(!empty($desc)) {
            $desc = " - " . mb_substr($desc, 0, 30) . "...";
        }
        echo "<div class='event'>" .
        "<p><a href='./pubEvent.php?puid=$puid'>$title</a><span class='italic'>$desc</span></p>" .
        "<p>Дата: $date</p>".
        "<p>Час: $hour</p>" .
        "<p>Организатор: $host</p>" .
        "</div>";
    }
    ?>
</section>

<?php
include_once('includes/footer.php');
?>
