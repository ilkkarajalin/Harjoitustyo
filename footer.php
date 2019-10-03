
<br>
<br>


<?php

if(isset($_SESSION['logged_in']))
{
  echo 'Kirjauduttu käyttäjänä '.$_SESSION['username'].'.<a href="logout.php">Kirjaudu ulos</a>';
}
else
{
  echo 'Et ole kirjautunut sisään. Ole hyvä ja kirjaudu. <a href="index.php">Kirjaudu</a>';
}
echo '<br>';
echo date("d.m.Y");
?>





  </body>
</html>
