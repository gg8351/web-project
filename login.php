<?php
include_once('includes/header.php');
?>
<h1>Вход</h1>
<div class="dform">
    <div class="dinput">
        <label>Електронна поща: <span class="mandatory">*</span></label>
        <input id="email" />
    </div>
    <div class="dinput">
        <label>Парола: <span class="mandatory">*</span></label>
        <input id="pwd" type="password"/>
        <p class="italic">* - задължително поле</p>
    </div>
    <button id="btnLogin" class="submit button">Влез</button>
    <div id="loginErrors" class="derrors"></div>
</div>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<?php
include_once('includes/footer.php');
?>