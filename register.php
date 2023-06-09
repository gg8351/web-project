<?php
include_once('includes/header.php');
?>
<h1>Регистрация</h1>
<div class="dform">
    <div class="dinput">
        <label>Електронна поща: <span class="mandatory">*</span></label>
        <input id="email" />
    </div>
    <div class="dinput">
        <label>Име и фамилия:</label>
        <input id="name" />
    </div>
    <div class="dinput">
        <label>Парола: <span class="mandatory">*</span></label>
        <input id="pwd" type="password"/>
    </div>
    <div class="dinput">
        <label>Потвърди парола: <span class="mandatory">*</span></label>
        <input id="cpwd" type="password" />
        <p class="italic">* - задължително поле</p>
    </div>
    <button id="btnReg" class="submit button">Регистрирай се</button>
    <div class="derrors" id="regErrors"></div>
</div>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/register.js"></script>
<?php
include_once('includes/footer.php');
?>