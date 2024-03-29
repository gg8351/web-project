<?php
include_once('includes/header.php');
?>
<section>
   <h4>Въведение</h4>
   <p>Това е система за създаване на събития. Събитията могат да бъдат за определен човек (таен подарък), за няколко
      човека (в случай на имен ден) или групови събития. За да се регистрирате в системата, натиснете
      <a href="register.php">тук</a>. За вход в системата, натиснете <a href="login.php">тук</a>.
   </p>
</section>
<section>
   <h4>Създаване на събитие</h4>
   <p>След като сте влезнали в системата, отидете на "Събития", а след това натиснете на "Създай събитие".</p>
   <h5>Създаване на събитие за един или няколко души</h5>
   <p>Посочете заглавието на събитието, името на получателя, email на получателя (за да може събитието да бъде скрито
      от него/нея), датата на която ще се състой и до кога трябва да сa събрани пари и купи подарък.</p>
   <h5>Създаване на групово събитие</h5>
   <p>Задайте заглавие на събитието, датата, часът, мястото, кратко описание и външна препратка, където потребителите
      могат да намерят повече информация.</p>
</section>
<?php
include_once('includes/footer.php');
?>