<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php

$nayta_syotto = false;

print_r($_POST);

$query_str = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet';

if(isset($_POST['rajaa_ruoka_aine']))
{
  $div2 = false;
  echo '<br>Rajattu haku<br>';
  $query_str = "SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE ruoka_aine LIKE '%".$_POST['ruoka_aine']."%'";
}

if(isset($_POST['valitse']))
{
  $_SESSION['ostos_id'] = $_POST['ruoka-aine'];

  $query_str = "SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE ruoka_aine_id=".$_POST['ruoka-aine'];
  $nayta_syotto = true;
}

if(isset($_POST['Lisaa_ostos']))
{
  //$query_str = "INSERT INTO ruoka_aineet VALUES(NULL,".$_SESSION['user_id'].",'".$_POST['ruoka_aine']."',1,1000,1,1000,0,0,0)";
  $ruokakunta_id = $_POST['ruokakunta'];
  $pvm = $_POST['pvm'];
  $ruoka_aine_id = $_SESSION['ostos_id'];
  $hinta = $_POST['hinta_yht'] / $_POST['ostettu_maara'];
  $maara = $_POST['ostettu_maara'];

  $query_str = "INSERT INTO ostokset VALUES(NULL,".$ruokakunta_id.",'".$pvm."',".$ruoka_aine_id.",".$hinta.",".$maara.")";

    echo '<br>uusi ostos:<br>'.$query_str.'<br>';
    $kysely=$db->query($query_str);
    $query_str = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet';
}

 ?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<section_3part>
  <div_3part>
    Valitse ruokakunta
    <br>
    <select name="ruokakunta">
      <?php
        $query_str2 = "SELECT * FROM ruokakunnat WHERE kayttaja_id=".$_SESSION['user_id']." ORDER BY ruokakunta";
        $kysely=$db->query($query_str2);

        foreach ($kysely as $row)
        {
          echo '<option value='.$row['ruokakunta_id'].'>'.$row['ruokakunta'].'</option>';
        }

      ?>
      <!option value="ruokakunnat0">Mainiot</option>
    </select>
  </div_3part>
</section_3part>

<section_3part>
  <div_3part>
Päivämäärä
<br>
<input type="date" name="pvm" value="<?php echo date('Y-m-d'); ?>"/>
<br>
</div_3part>
</section_3part>
<section_3part>
<div_3part>

    <input type="text" name="ruoka_aine" values="" placeholder="Rajaa ruoka-aineita..." size=15>
    <input type="submit" name="rajaa_ruoka_aine" value="Rajaa">
    <br>
    <input type="submit" name="valitse" value="Valitse">

    <br>
  Ruoka-aineet:<br>
<select class="non_scroll" name="ruoka-aine" size="20" width="50">

  <?php

  $query_str = $query_str." ORDER BY ruoka_aine";

  $kysely=$db->query($query_str);

  foreach ($kysely as $row)
  {
    echo '<option value='.$row['ruoka_aine_id'].'>'.$row['ruoka_aine'].'</option>';
  }
  ?>

</select>

</div_3part>

<?php

if($nayta_syotto)
{




echo '<div_3part><br><br>Hankintayksikkö';

$query_str = "SELECT yksikko FROM yksikot JOIN ruoka_aineet ON ruoka_aineet.hankinta_yks_id=yksikot.yksikko_id WHERE ruoka_aineet.ruoka_aine_id=".$_SESSION['ostos_id'];

  //$query_str = "SELECT yksikko FROM yksikot where yksikko_id=".$_SESSION['ostos_id'];
//  echo '<br>Hankintaykiskkö id<br>'.$query_str;
  $kysely=$db->query($query_str);
  $hankinta_yks_id = "";

  foreach ($kysely as $row)
  {
    $hankinta_yks_id = $row['yksikko'];
  }

  echo ' <b>'.$hankinta_yks_id.'</b>';

  echo '<br><br>Määrä<input type="number" name="ostettu_maara" value="1" step="0.01" style="width: 3em"><br><br>';
  echo 'Hinta yhteensä<input type="number" name="hinta_yht" value="1.00" step="0.01" style="width: 5em">€<br><br>';
  echo '<input type="submit" name="Lisaa_ostos" value="Lisää"></div_3part>';

  }

  ?>

</section_3part>
</form>

<?php include "footer.php"?>
