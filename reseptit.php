<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php

$query_str_aine = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE kayttaja_id='.$_SESSION['user_id'].' ORDER BY ruoka_aine';
$query_str_resepti = "SELECT * FROM reseptit WHERE ruokakunta_id=".$_SESSION['resepti_ruokakunta_id'];

if(isset($_POST['rajaa_ruoka-aine']))
{
  $query_str_aine = "SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE ruoka_aine LIKE '%".$_POST['ruoka-aine_haku']."%' AND kayttaja_id=".$_SESSION['user_id']." ORDER BY ruoka_aine";
  echo '<br>';
  echo $query_str_aine;
}

if(isset($_POST['tarkastele_resepti']))
{
  $valittu_resepti_id = $_POST['reseptit'];
  $query_str_resepti = "SELECT * FROM reseptit WHERE resepti_id=".$valittu_resepti_id;
}

print_r($_POST);

$nayta_lomake = false;

if(isset($_POST['ruokakunta']))
{
  $_SESSION['resepti_ruokakunta_id'] = $_POST['ruokakunta'];
}

if(isset($_SESSION['resepti_ruokakunta_id']))
{
  $nayta_lomake = true;
}

?>

<section_3part>
  <div_3part>
Valitse ruokakunta:
<br>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <select name="ruokakunta" onchange="">
    <?php
      $query_str = "SELECT * FROM ruokakunnat WHERE kayttaja_id=".$_SESSION['user_id']." ORDER BY ruokakunta";
      $kysely=$db->query($query_str);

      foreach ($kysely as $row)
      {
        $valittu = "";

        if($row['ruokakunta_id'] == $_SESSION['resepti_ruokakunta_id'])
        {
          $valittu = " selected";
        }

        echo '<option value='.$row['ruokakunta_id'].$valittu.'>'.$row['ruokakunta'].'</option>';
      }

    ?>
  </select>
  <input type="submit" name="ruokakunta_valinta" value="Valitse">
</form>
</div_3part>
</section_3part>
<br>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<section_3part>
  <div_3part>
    <input type="text" name="resepti_haku" values="" placeholder="Rajaa reseptejä tai lisää uusi" size="25">
    <input type="submit" name="lisaa_resepti" value="Lisää uusi">
    <br><br>
    Reseptit
    <select class="non_scroll" name="reseptit" size="20" width="50">

      <?php
      $kysely=$db->query($query_str_resepti);

      foreach ($kysely as $row)
      {

        echo '<option value='.$row['resepti_id'].'>'.$row['resepti'].'</option>';
      }

      ?>
    </select>
  </div_3part>
  <div_3part>
      <br><br><br>
        <input type="submit" name="tarkastele_resepti" value="Tarkastele">
        <br><br><br>
        <input type="submit" name="poista_resepti" value="Poista">

    </div_3part>
  <div_3part>
    <br><br>
    Reseptin ruoka-aineet

    <select class="non_scroll" name="resptin_aineet" size="20" width="50">

      <?php
      $ruoka_aineet=$db->query('SELECT ruoka_aineet.ruoka_aine_id,ruoka_aine,reseptin_aineet.kaytto_maara,yksikot.yksikko FROM ruoka_aineet JOIN reseptin_aineet ON ruoka_aineet.ruoka_aine_id = reseptin_aineet.ruoka_aine_id JOIN yksikot ON ruoka_aineet.kaytto_yks_id=yksikot.yksikko_id WHERE reseptin_aineet.resepti_id=1');
      $reseptin_hinta = 0;
      $reseptin_paino = 0;


      foreach ($ruoka_aineet as $row)
      {
          $query_str_hinta = "SELECT AVG(hinta_hankinta_yks),ruoka_aineet.paino_kaytto_yks,ruoka_aineet.paino_hankinta_yks FROM ostokset JOIN ruoka_aineet ON ruoka_aineet.ruoka_aine_id=ostokset.ruoka_aine_id WHERE ostokset.ruoka_aine_id=".$row['ruoka_aine_id'];
          $kysely=$db->query($query_str_hinta);

          foreach ($kysely as $row2)
          {
            $hinta = round($row2['AVG(hinta_hankinta_yks)'] * $row2['paino_kaytto_yks'] / $row2['paino_hankinta_yks'] * $row['kaytto_maara'],2);
            $paino = $row2['paino_kaytto_yks'] * $row['kaytto_maara'];
          }

          $reseptin_hinta = $reseptin_hinta + $hinta;
          $reseptin_paino = $reseptin_paino + $paino;

        echo '<option value="">'.$row['ruoka_aine'].' '.$row['kaytto_maara'].' '.$row['yksikko'].' '.$hinta.' €</option>';
      }

       ?>

    </select>
    <br>
    <?php echo 'Reseptin paino '.$reseptin_paino.' g'; ?>
    <br>
    450 kJ / 100 g
    <br>
    Annoskoko 250 g
    <br>
    1100 kJ / 250 g
    <br>
    <?php echo 'Reseptin hinta '.$reseptin_hinta.' €'; ?>
    <br>
    <table id="ruokakalenteri">
      <th></th>
      <th>/ 100 g</th>
      <th>/ annos</th>
      <th>kJ %</th>
      <tr>
        <th>Hiilihydraatit</th>
        <td>22 g</td>
        <td>51 g</td>
        <td>30 %</td>
        <tr>
          <th>Proteiinit</th>
          <td>12.8 g</td>
          <td>30.4 g</td>
          <td>22 %</td>
          <tr>
            <th>Rasvat</th>
            <td>9.4 g</td>
            <td>23.8 g</td>
            <td>48 %</td>

    </table>
  </div_3part>
  <div_3part>
      <br><br><br>
        <input type="submit" name="lisaa_ruoka-aine" value="<< Lisää">
        <br><br><br>
        Muokkaa määrää:
        <br>
        <input type="number" name="ruoka-aine_maara" value=1 style="width: 3em">
        <br>
        <input type="submit" name="muuta_maara" value="Muokkaa">
        <br><br><br>
        <input type="submit" name="poista_ruoka-aine" value="Poista >>">

    </div_3part>
  <div_3part>
    <input type="text" name="ruoka-aine_haku" values="" placeholder="Rajaa ruoka-aineita" size="25">
    <input type="submit" name="rajaa_ruoka-aine" value="Rajaa">
    <br><br>
    Ruoka-aineet
    <select class="non_scroll" name="reseptin_aineet" size="20" width="50">

<?php

$kysely=$db->query($query_str_aine);

foreach ($kysely as $row)
{
  echo '<option value='.$row['ruoka_aine_id'].'>'.$row['ruoka_aine'].'</option>';
  }


?>

    </select>
  </div_3part>
</section_3part>
</form>


<?php include "footer.php"; ?>
