<?php
include_once('includes/header.php');
?>
<?php
   if(!isset($_SESSION['uid'])) {
   header("location: noaccess.php");
   die();
   }
?>
<h1>Добавяне на събитие</h1>
<section>
   <select id="userChoice">
      <option value="none">Избери вид събитие...</option>
      <option value="personal">Събитие за един човек</option>
      <option value="public">Обществено събитие</option>
   </select>
</section>
<section id="privateEvent">
   <h4>Събитие за организиране на подарък за един човек</h4>
   <div class="dform">
      <div class="dinput">
         <label for="prsName">Име на събитието</label>
         <input id="prsName" />
      </div>
      <div class="dinput">
         <label for="prsDate">Дата на събитието</label>
         <input id="prsDate" type="date" />
      </div>
      <div class="dinput">
         <label for="prsDeadline">Крайна дата за организирането</label>
         <input id="prsDeadline" type="date" />
      </div>
      <div class="dinput">
         <label for="prsRecName">Име на получателя</label>
         <input id="prsRecName" />
      </div>
      <div class="dinput">
         <label for="prsRecEmail">Електронна поща на получателя</label>
         <input id="prsRecEmail"/>
      </div>
      <div class="dinput">
         <label for="prsIban">IBAN за събиране на средства</label>
         <input id="prsIban"/>
      </div>
      <div class="dinput">
         <label for="prsDesc">Описание</label>
         <textarea id="prsDesc"></textarea>
      </div>
      <button id="prsSubmit" class="submit button">Добави</button>
      <div id="prsErrorsDiv" class="derrors"></div>
   </div>
   </div>
</section>
<section id="publicEvent">
   <h4>Обществено събитие</h4>
   <div class="dform">
      <div class="dinput">
         <label for="pubName">Име на събитието</label>
         <input id="pubName" />
      </div>
      <div class="dinput">
         <label for="pubDate">Дата</label>
         <input id="pubDate" type="date" />
      </div>
      <div class="dinput">
         <label for="pubHour">Час</label>
         <input id="pubHour" placeholder="XX:XX" />
      </div>
      <div class="dinput">
         <label for="pubPlace">Място</label>
         <input id="pubPlace" />
      </div>
      <div class="dinput">
         <label for="pubDesc">Описание</label>
         <textarea id="pubDesc"></textarea>
      </div>
      <div class="dinput">
         <label for="pubExternal">Връзка към външен източник, за повече информация</label>
         <input id="pubExternal" placeholder="https://..." />
      </div>
      <button id="pubSubmit" class="submit button">Добави</button>
      <div id="pubErrorsDiv" class="derrors"></div>
   </div>
   </div>
</section>
<script type="text/javascript" src="js/functions.js"></script>
<script type="text/javascript" src="js/chooseEventType.js"></script>
<script type="text/javascript" src="js/addEvent.js"></script>
<?php
include_once('includes/footer.php');
?>