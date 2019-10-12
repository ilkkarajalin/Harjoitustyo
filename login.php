<?php
include "connection.php";

if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$salasana=$_POST['salasana'];
$kayttaja=$_POST['kayttaja'];

if(isset($_POST['kirjaudu']))
{

  $stmt=$db->prepare("SELECT salasana FROM kayttajat WHERE kayttaja=:username");
  $stmt->bindParam(':username',$kayttaja);
  $stmt->execute();

  $oikea_salasana = $stmt->fetch(PDO::FETCH_COLUMN);

  if(password_verify($salasana,$oikea_salasana))
  {
    $_SESSION['logged_in']=true;
    $_SESSION['username']=$kayttaja;

    $stmt=$db->prepare("SELECT kayttaja_id FROM kayttajat WHERE kayttaja=:username");
    $stmt->bindParam(':username',$kayttaja);
    $stmt->execute();
    $kayttaja_id = $stmt->fetch(PDO::FETCH_COLUMN);

    $_SESSION['user_id']=$kayttaja_id;
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
  }
  else
  {
      if(isset($_POST['salasana']) AND isset($_POST['kayttaja']))
      {
        if ($_POST['salasana'] != '' AND $_POST['kayttaja'] != '')
        {

        $stmt=$db->prepare("SELECT COUNT(kayttaja_id) FROM kayttajat WHERE kayttaja=:username");
        $stmt->bindParam(':username',$kayttaja);
        $stmt->execute();
        $kysely = $stmt->fetch(PDO::FETCH_COLUMN);

        if($kysely == 0)
        {
          $koodattu_salasana = password_hash($_POST['salasana'],PASSWORD_DEFAULT);
          $stmt=$db->prepare("INSERT INTO kayttajat VALUES(NULL,:username,:password)");
          $stmt->bindParam(':username',$kayttaja);
          $stmt->bindParam(':password',$koodattu_salasana);
          $stmt->execute();

          $_SESSION['logged_in']=true;
          $_SESSION['username']=$kayttaja;

          $stmt=$db->prepare("SELECT kayttaja_id FROM kayttajat WHERE kayttaja=:username");
          $stmt->bindParam(':username',$kayttaja);
          $stmt->execute();
          $kysely = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($kysely as $row)
          {
            $kayttaja_id = $row['kayttaja_id'];
          }

          //echo 'Kayttaja_id='.$kayttaja_id;

          $_SESSION['user_id']=$kayttaja_id;
          $_SESSION['ruoka_aine_valittu']=false;
          include "menu.php";
          echo '<section_3part><div_3part>';
          echo '<p>Olet kirjautunut Reseptoriin käyttäjänä '.$kayttaja.'</p>';
        }
        else
        {
          include "menu.php";
          echo '<section_3part><div_3part>';
          echo 'Käyttäjätunnus on jo käytössä. Anna uusi käyttäjätunnus';
          echo '<br><br>';
          echo '<a href="index.php">Kirjaudu uudelleen</a>';
        }
        }
        else
        {
          include "menu.php";
          echo '<section_3part><div_3part>';
          echo 'Käyttäjätunnus ja salasana tulee antaa uuden käyttäjän luonnissa';
          echo '<br><br>';
          echo '<a href="index.php">Kirjaudu uudelleen</a>';
        }
      }
      else
      {
        include "menu.php";
        echo '<section_3part><div_3part>';
        echo 'Käyttäjätunnus ja salasana tulee antaa uuden käyttäjän luonnissa';
        echo '<br><br>';
        echo '<a href="index.php">Kirjaudu uudelleen</a>';
      }


  }
   ?>
</div_3part>
</section_3part>

<?php include "footer.php"; ?>
