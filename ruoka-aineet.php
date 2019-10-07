<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php

$query_str = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet';
$rajaa_ruoka_aine = false;
print_r($_POST);

$div2 = false;

if (count($_POST) > 0)
{
  $div2 = true;
}

echo '<br>';
 ?>

<?php
if(isset($_POST['muokkaa_ruoka-aine']))
{
  $ruoka_aine = $_POST['ruoka_aine'];
  //$ruoka_aine_id = $_POST['ruoka_aine_id'];
  $_SESSION['ruoka_aine_valittu'] = true;
  print_r($_POST);

}
?>

<?php

if(isset($_POST['rajaa_ruoka-aine']))
{
  $div2 = false;
  echo '<br>Rajattu haku<br>';
  $query_str = "SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE ruoka_aine LIKE '%".$_POST['ruoka_aine']."%'";
}
 ?>

 <?php

if(isset($_POST['muokkaa_ruoka-aine']))
{
  echo '<br>Valittu ruoka-aine<br>';
  $_SESSION['ruoka-aine_id'] = $_POST['ruoka-aineet'];
  $query_str = "SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE ruoka_aine_id=".$_POST['ruoka-aineet'];
  echo '<br>'.$query_str.'<br>';
}

 ?>

 <?php

if(isset($_POST['lisaa_ruoka-aine']))
{
  $div2 = false;
  $query_str = "INSERT INTO ruoka_aineet VALUES(NULL,".$_SESSION['user_id'].",'".$_POST['ruoka_aine']."',1,1000,1,1000,0,0,0)";
    echo '<br>uusi ruoka-aine:<br>'.$query_str.'<br>';
    $kysely=$db->query($query_str);
    $query_str = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet';
}

  ?>

<?php
if(isset($_POST['poista_aine']))
{

  $query_str = "DELETE FROM ruoka_aineet WHERE ruoka_aine_id=".$_POST['ruoka_aine_id'];
  echo '<br>poista ruoka-aine:<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);
  $query_str = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet';
}
?>

<?php
if(isset($_POST['paivita_aine']))
{
  echo '<br>';
  print_r($_POST);
  echo '<br>';
  $ruoka_aine_id = $_POST['ruoka_aine_id'];
  $hankinta_yks_id = $_POST['hankinta_yks'];
  $hankinta_paino = $_POST['hankinta_paino'];
  $kaytto_yks_id = $_POST['kaytto_yks'];
  $kaytto_paino = $_POST['kaytto_paino'];
  $hiilih = $_POST['hiilihydraatit'];
  $proteiinit = $_POST['proteiinit'];
  $rasvat = $_POST['rasvat'];
$query_str = "UPDATE ruoka_aineet SET kaytto_yks_id=".$kaytto_yks_id.", paino_kaytto_yks=".$kaytto_paino.", hankinta_yks_id=".$hankinta_yks_id.", paino_hankinta_yks=".$hankinta_paino.", sisalto_hiilih=".$hiilih.", sisalto_protei=".$proteiinit.", sisalto_rasva=".$rasvat." WHERE ruoka_aine_id=".$ruoka_aine_id;
echo '<br>'.$query_str.'<br';
$kysely=$db->query($query_str);
$query_str = "";

}

 ?>

<?php
if($_SESSION['ruoka_aine_valittu'])
{
  $rajaa_ruoka_aine = true;
}

?>

<br>
<section_3part>
  <div_3part>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <input type="text" name="ruoka_aine" values="" placeholder="Lisää uusi ruoka-aine" size=15>
    <input type="submit" name="rajaa_ruoka-aine" value="Rajaa">
    <br>
    <input type="submit" name="muokkaa_ruoka-aine" value="Muokkaa">
    <input type="submit" name="lisaa_ruoka-aine" value="Lisää uusi">
  <br>

  <select class="non_scroll" name="ruoka-aineet" size="20" width="50">



  <?php

  $query_str = $query_str." ORDER BY ruoka_aine";

  $kysely=$db->query($query_str);

  foreach ($kysely as $row)
  {
    echo '<option value='.$row['ruoka_aine_id'].'>'.$row['ruoka_aine'].'</option>';
  }
  ?>

  </select>
  <br>
  <br>
  </form>
</div_3part>
<div_3part>
  <br>

  <?php

    if ($div2)
    {
    $query_str = "SELECT hankinta_yks_id FROM ruoka_aineet where ruoka_aine_id=".$_SESSION['ruoka-aine_id'];
  //  echo '<br>Hankintaykiskkö id<br>'.$query_str;
    $kysely=$db->query($query_str);
    $hankinta_yks_id = 1;

    foreach ($kysely as $row)
    {
      $hankinta_yks_id = $row['hankinta_yks_id'];
    }

  //  echo '<br>Hankintayksikkö='.$hankinta_yks_id.'<br>';

    $query_str = "SELECT yksikko_id,yksikko FROM yksikot WHERE kayttaja_id=".$_SESSION['user_id'];
  //  echo '<br>Yksiköt haettu<br>'.$query_str.'<br>';


    }
   ?>
   <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

     <?php
        if ($div2)
        {
        echo '<input type="hidden" name="ruoka_aine_id" value="'.$_SESSION['ruoka-aine_id'].'">';
        echo 'Ruoka-aineen Hankintayksikkö<select name="hankinta_yks" onchange="">';
        }
        ?>




    <?php

    if ($div2)
    {

    $kysely=$db->query($query_str);

    foreach ($kysely as $row)
    {
      $valittu = "";

      if ($hankinta_yks_id == $row['yksikko_id'])
      {
        $valittu = " selected";
      }

      echo '<option value='.$row['yksikko_id'].$valittu.'>'.$row['yksikko'].'</option>';
    }

    }
    ?>

  </select>
  <br>

<?php

if ($div2)
{

$query_str = "SELECT kaytto_yks_id FROM ruoka_aineet where ruoka_aine_id=".$_SESSION['ruoka-aine_id'];
//echo '<br>Käyttöyksikkö id<br>'.$query_str;
$kysely=$db->query($query_str);
$kaytto_yks_id=1;

foreach ($kysely as $row)
{
  $kaytto_yks_id = $row['kaytto_yks_id'];
}

//echo '<br>Käyttöyksikkö='.$kaytto_yks_id.'<br>';

  $query_str = "SELECT paino_hankinta_yks FROM ruoka_aineet WHERE ruoka_aine_id=".$_SESSION['ruoka-aine_id'];
  $kysely=$db->query($query_str);
  $paino_hankinta=1000;

  foreach ($kysely as $row)
  {
    $paino_hankinta = $row['paino_hankinta_yks'];
  }

echo 'Hankintayksikön paino';

echo '<input type="number" name="hankinta_paino" step="1" value="'.$paino_hankinta.'" style="width: 5em">';

echo 'grammaa<br><br>Ruoka-aineen käyttöyksikkö<select name="kaytto_yks" onchange="">';

}
?>





    <?php

    if ($div2)
    {

    $query_str = "SELECT yksikko_id,yksikko FROM yksikot WHERE kayttaja_id=".$_SESSION['user_id'];

    $kysely=$db->query($query_str);

    foreach ($kysely as $row)
    {
      $valittu = "";

      if ($kaytto_yks_id == $row['yksikko_id'])
      {
        $valittu = " selected";
      }

      echo '<option value='.$row['yksikko_id'].$valittu.'>'.$row['yksikko'].'</option>';
    }

  }
    ?>
   <br>
  </select>
  <br>

  <?php
    if ($div2)
    {

    $query_str = "SELECT paino_kaytto_yks FROM ruoka_aineet WHERE ruoka_aine_id=".$_SESSION['ruoka-aine_id'];
    $kysely=$db->query($query_str);
    $paino_kaytto=1000;

    foreach ($kysely as $row)
    {
      $paino_kaytto = $row['paino_kaytto_yks'];
    }

    echo 'Käyttöyksikön paino';

  echo '<input type="number" name="kaytto_paino" step="1" value="'.$paino_kaytto.'" style="width: 5em">';

  echo 'grammaa';


    $query_str = "SELECT sisalto_hiilih,sisalto_protei,sisalto_rasva FROM ruoka_aineet WHERE ruoka_aine_id=".$_SESSION['ruoka-aine_id'];
    $kysely=$db->query($query_str);
    $hiilih = 0;
    $proteiini = 0;
    $rasva = 0;

    foreach ($kysely as $row)
    {
      $hiilih = $row['sisalto_hiilih'];
      $proteiini = $row['sisalto_protei'];
      $rasva = $row['sisalto_rasva'];
    }

    echo '<br><br>Ruoka-aineen ravintosisältö / 100 g<br>Hiilihydraatit';

  echo '<input type="number" name="hiilihydraatit" step="0.1" value="'.$hiilih.'" style="width: 3em">';

  echo '/ 100 g<br>Proteiinit';

   echo '<input type="number" name="proteiinit" step="0.1" value="'.$proteiini.'" style="width: 3em">';

   echo '/ 100 g<br>Rasvat';

    echo '<input type="number" name="rasvat" step="0.1" value="'.$rasva.'" style="width: 3em">';

    echo '/ 100 g<br><br><input type="submit" name="paivita_aine" value="Päivitä ruoka-aine"><br><br>';
    echo '<input type="submit" name="poista_aine" value="Poista ruoka-aine">';
  }
    ?>

</form>
</div_3part>
</section_3part>









<?php include "footer.php"; ?>
