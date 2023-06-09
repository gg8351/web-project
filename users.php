<?php
include_once('includes/header.php');
?>
<?php
if (!isset($_SESSION['uid'])) {
   header('location: ./index.php');
   die();
}
?>
<section>
   <h4>Потребители</h4>
   <div class="flex-container">
   <?php
   $users = $umgr->getUsers();
   foreach ($users as $user) {
      $email = $user['email'];
      $name = $user['name'];
      $pfp = $user['pfp'];
      $dob = $user['dob'];
      $displayName = "";
      $displayDob = "";
      $displayPfp = "default.png";
      if(!empty($name)) {
         $displayName = "Име: " . $name;
      }
      if(!empty($pfp)) {
         $displayPfp = $pfp;
      }
      if(!empty($dob)) {
         $displayDob = "Рожден ден: ".$dob;
      }
      echo "<div class='profileTile'>" .
         "<div class='imgwrap'>".
         "<img src='public/images/$displayPfp' />" .
         "<p>$email</p>".
         "<p>$displayName</p>".
         "<p>$displayDob</p>".
         "</div>".
         "</div>";
   }
   ?>
   </div>
</section>
<?php
include_once('includes/footer.php');
?>