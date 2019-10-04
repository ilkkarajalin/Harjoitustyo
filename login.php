<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$salasana=$_POST['salasana'];
$kayttaja=$_POST['kayttaja'];
$oikea_salasana='salasana';

if($salasana==$oikea_salasana)
{
  $_SESSION['logged_in']=true;
  $_SESSION['username']=$kayttaja;
  $_SESSION['user_id']=1;
  $_SESSION['ruoka_aine_valittu']=false;
  include "menu.php";
  echo '<section_3part><div_3part>';
  echo '<p>Olet kirjautunut Reseptoriin käyttäjänä '.$kayttaja.'</p>';
}
  else
  {
    include "menu.php";
    echo '<section_3part><div_3part>';
    echo '<p>Käyttäjätunnus ja salasana eivät täsmää. Kirjaudu uudelleen tai luo uusi käyttäjä</p>';
    echo '<br><br>';
    echo '<a href="index.php">Kirjaudu uudelleen</a>';
  }
 ?>
</div_3part>
</section_3part>

<?php include "footer.php"; ?>
