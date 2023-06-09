<?php
include_once('includes/header.php');
?>
<?php
if (!isset($_GET['puid'])) {
   header('location: ./events.php');
   die();
}
require_once("./classes/PubEventManager.php");
$event = $pumgr->getEvent($_GET['puid'])[0];
if(!isset($event)) {
   header('location: ./events.php');
   die();
}
$puid = $event['puid'];
$title = $event['title'];
$creatorId = $event['creatorId'];
$desc = $event['description'];
$date = $event['date'];
$hour = $event['hour'];
$place = $event['place'];
$ext = $event['extLink'];
?>
<section>
   <h4 class="centered">
      <?= $title ?>
   </h4>
   <p><?= $desc ?></p>
</section>
<section>
   <h4>Относно събитието</h4>
   <p>Дата: <span class="dateHl"><?= $date ?></span></p>
   <p>Час: <?= $hour ?></p>
   <p>Място: <?= $place ?></p>
   <p>Външна препратка: <a href="<?= $ext ?>"><?= $ext ?></a></p>
</section>
<section>
   <h5>Организатор</h5>
   <?php
      $pfp = $umgr->getField($creatorId, "pfp");
      $displayPfp = empty($pfp) ? "default.png" : $pfp;
      $email = $umgr->getField($creatorId, "email");
      echo "<div class='centeredBlock profileTile'>" .
         "<div class='imgwrap'>" .
         "<img src='public/images/$displayPfp' />" .
         "<p>$email</p>" .
         "</div>" .
         "</div>";
      ?>
</section>
<section>
   <h5>Коментари</h5>
   <section class="commentSection">
      <?php
      $comments = $pumgr->getAllComments($puid);
      foreach ($comments as $comment) {
         $sender = $comment['commenter'];
         $hlClass = $sender === $creatorId ? "commentHl" : "";
         $senderName = $umgr->getField($sender, "email");
         $date = $comment['commentDate'];
         $content = $comment['content'];
         echo '<div class="comment">' .
            "<div class='$hlClass commentHead'>" . $senderName . ' написа:<span class="date">' . $date . '</span></div>' .
            '<p class="commentContent">' . $content . '</p>' .
            '</div>';
      }
      ?>
   </section>
   <section>
      <h5>Добави коментар</h5>
      <textarea id="txa_comment" class="txaComment"></textarea>
      <button id="btn_comment" class="button">Коментирай</button>
      <div id="commentErrors" class="derrors"></div>
   </section>
</section>

<div class="dinput novis">
   <input id="puid" value="<?= $puid ?>" />
</div>

<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/addPubComment.js"></script>
<?php
include_once('includes/footer.php');
?>