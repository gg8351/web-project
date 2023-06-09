<?php
include_once('includes/header.php');
?>
<?php
if (!isset($_GET['prid'], $_SESSION['uid'])) {
   header('location: ./events.php');
   die();
}
require_once("./classes/PrsEventManager.php");
require_once("./classes/GiftManager.php");
$uid = $_SESSION['uid'];
$event = $pemgr->getEvent($_GET['prid'])[0];
if(!isset($event)) {
   header('location: ./events.php');
   die();
}
$receiverEmail = $event['receiverEmail'];
if(strcmp($receiverEmail, $umgr->getField($uid, "email") ) === 0) {
   header('location: ./events.php');
   die();
}
$prid = $event['prid'];
$title = $event['title'];
$creatorId = $event['creatorId'];
$desc = $event['description'];
$date = $event['date'];
$dl = $event['deadline'];
$iban = $event['iban'];
$targetMoney = $event['targetMoney'];
$currentBalance = $event['currentBalance'];
if($creatorId !== $uid) {
   $orgVisibility = "novis";
}
?>
<section>
   <h4 class="centered">
      <?= $title ?>
   </h4>
   <p><?= $desc ?></p>
</section>
<section>
   <h5>Срок за събиране на подаръци</h5>
   <p>Събитието ще се състой на: <span class="dateHl">
         <?= $date ?>
      </span></p>
   <p>Събирането на пари ще продължи до: <span class="dateHl"><?= $dl ?></span></p>
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
   <h5>Избор на подарък</h5>
   <?php
   $gifts = $giftmgr->getAll($prid);
   foreach ($gifts as $gift) {
      $name = $gift['name'];
      $url = $gift['url'];
      $giftId = $gift['giftId'];
      $voters = $giftmgr->getVoters($prid, $giftId);
      echo
         "<section class='giftType'>
            <div class='giftDescription'>
               <div class='giftName'>$name - <a
                     href='https://$url'
                     target='new'>Снимка</a></div>
               <div class='italic giftVoters'>Гласували: $voters</div>
            </div>
            <div class='giftVote'>
               <button onclick='voteForGift($prid, $giftId)' class='button giftBtn'>Гласувай</button>
               <button onclick='removeVoteForGift($prid, $giftId)' class='button giftBtn'>Премахни глас</button>
            </div>
         </section>";
   }
   ?>
   <div class="<?= $orgVisibility?> dform">
      <h5>Добави идея за подарък</h5>
      <div class="dinput">
         <label for="giftName">Подарък</label>
         <input id="giftName" />
      </div>
      <div class="dinput">
         <label for="giftUrl">Линк към картинка/онлайн магазин</label>
         <input id="giftUrl" />
      </div>
      <div class="dinput novis">
         <input id="giftPrid" value="<?= $prid ?>" />
      </div>
      <button id="addGift" class="submit button">Добави</button>
      <div id="giftErrors" class="derrors"></div>
   </div>
</section>
<section>
   <h5>Събиране на пари</h5>
   <div>Парите ще се събират на следния IBAN:</div>
   <div class="iban">
      <?= $iban ?>
   </div>
   <div>Цена на подаръка: <span class="price"><?= $targetMoney ?> лв.</span></div>
   <div>Събрани: <span class="price">
         <?= $currentBalance ?> лв.
      </span></div>
   <div class="<?= $orgVisibility?> dform">
      <div class="dinput">
         <label for="if_iban">Нов IBAN</label>
         <input id="if_iban" />
      </div>
      <button id="btn_iban" class="submit button">Смени IBAN</button>
      <div class="dinput">
         <label for="if_newprice">Задай цена на подаръка</label>
         <input id="if_newprice" />
      </div>
      <button id="btn_newprice" class="submit button">Задай цена</button>
      <div class="dinput">
         <label for="if_addfunds">Добави сума към събрани средства</label>
         <input id="if_addfunds" />
      </div>
      <button id="btn_addfunds" class="submit button">Добави</button>
      <div id="fundErrors" class="derrors"></div>
   </div>
</section>
<section>
   <h5>Коментари</h5>
   <section class="commentSection">
      <?php
      $comments = $pemgr->getAllComments($prid);
      foreach ($comments as $comment) {
         $sender = $comment['commenter'];
         $hlClass = $sender === $creatorId ? "commentHl" : "";
         $email = $umgr->getField($sender, "email");
         $name = $umgr->getField($sender, "name");
         $senderName = empty($name) ? $email : $name;
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

<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/addGift.js"></script>
<script type="text/javascript" src="js/editMoney.js"></script>
<script type="text/javascript" src="js/addComment.js"></script>
<?php
include_once('includes/footer.php');
?>