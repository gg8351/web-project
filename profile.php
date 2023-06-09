<?php
include_once('includes/header.php');
require_once("classes/UserManager.php");
$uid = $_SESSION['uid'];
$email = $umgr->getField($uid, "email");
$name = $umgr->getField($uid, "name");
$dob = $umgr->getField($uid, "dob");
$pfp;
if(empty($umgr->getField($uid, "pfp"))) {
   $pfp = "default.png";
} else {
   $pfp = $umgr->getField($uid, "pfp");
}
?>
<h1>Профил</h1>
<section>
   <h4>Текущи данни</h4>
   <table class="udata">
      <tr>
         <td>Email</td>
         <td>
            <?php echo $email ?>
         </td>
      </tr>
      <tr>
         <td>Име и фамилия</td>
         <td><?php if (empty($name))
            echo "Не е зададено";
         else
            echo $name ?></td>
         </tr>
         <tr>
            <td>Рожденна дата</td>
            <td>
            <?php if (empty($dob))
            echo "Не е зададена";
         else
            echo $dob; ?>
         </td>
      </tr>
      <tr>
         <td>Профилна снимка</td>
         <td class="centered"><img width=100px src="public/images/<?= $pfp?>" /></td>
      </tr>
   </table>
</section>
<section>
   <h5>Промяна на E-mail</h5>
   <div class="dform">
      <div class="dinput">
         <label for="cemail_email">Нов E-mail</label>
         <input id="cemail_email" />
         <label for="cemail_pwd">Текуща парола</label>
         <input id="cemail_pwd" type="password" />
      </div>
      <button id="btnEmail" class="submit button">Промяна</button>
      <div id="emailErrors" class="derrors"></div>
   </div>
   <h5>Промяна на парола</h5>
   <div class="dform">
      <div class="dinput">
         <label for="cpwd_pwd">Нова парола</label>
         <input id="cpwd_pwd" type="password" />
         <label for="cpwd_cpwd">Потвърди нова парола</label>
         <input id="cpwd_cpwd" type="password" />
         <label for="cpwd_oldpwd">Текуща парола</label>
         <input id="cpwd_oldpwd" type="password" />
      </div>
      <button id="btnPwd" class="submit button">Промяна</button>
      <div id="pwdErrors" class="derrors"></div>
   </div>
   <h5>Промяна на име и фамилия</h5>
   <div class="dform">
      <div class="dinput">
         <label for="cname_name">Име и фамилия</label>
         <input id="cname_name" />
      </div>
      <button id="btnName" class="submit button">Промяна</button>
      <div id="nameErrors" class="derrors"></div>
   </div>
   <h5>Промяна на дата на раждане</h5>
   <div class="dform">
      <div class="dinput">
         <label for="cdate_dob">Дата на раждане</label>
         <input id="cdate_dob" type="date" />
      </div>
      <button id="btnDob" class="submit button">Промяна</button>
      <div id="dobErrors" class="derrors"></div>
   </div>
   <h5>Промяна на профилна снимка</h5>
   <div class="dform">
      <form action="includes/uploadPfp.php" method=POST enctype=multipart/form-data>
         <input id="cpfp_file" name="pfp" type="file" />
         <input type="submit" value="Качи"/>
      </form>
   </div>
</section>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/editProfile.js"></script>
<?php
include_once('includes/footer.php');
?>