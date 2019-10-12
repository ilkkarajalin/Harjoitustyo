<div_3part>
  <br><br>
  Reseptin ruoka-aineet
  <br>
  <div class="pseudo_select">
  <table id="ruokakalenteri">
    <th></th>
    <th>Määrä</th>
    <th>Yksikkö</th>
    <th>Hinta yht</th>
    <th></th>
    <th></th>
<?php
  $query_str = "SELECT ruoka_aineet.ruoka_aine_id,ruoka_aine,reseptin_aineet.kaytto_maara,yksikot.yksikko,reseptin_aineet.id FROM ruoka_aineet JOIN reseptin_aineet ON ruoka_aineet.ruoka_aine_id = reseptin_aineet.ruoka_aine_id JOIN yksikot ON ruoka_aineet.kaytto_yks_id=yksikot.yksikko_id WHERE reseptin_aineet.resepti_id=".$_SESSION['resepti_id']." ORDER BY ruoka_aineet.ruoka_aine";
    $ruoka_aineet=$db->query($query_str);
    $reseptin_hinta = 0;
    $reseptin_paino = 0;
    $riveja = 0;

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

        $muokkaa = $row['id'].'.'.$row['ruoka_aine_id'];

        // resepti taulun rivinumero
        // esitetyn taulun rivinumero

      echo '<tr><th>'.$row['ruoka_aine'].'</th><td><input type="number" step="0.01" name="'.$row['ruoka_aine_id'].'" align="center" value="'.$row['kaytto_maara'].'" style="text-align:center; width: 5em"></td><td>'.$row['yksikko'].'</td><td>'.$hinta.' €</td><td><button type="submit" name="muokkaa" value='.$muokkaa.'>Muokkaa</button></td><td><button type="submit" name="poista" value='.$row['id'].'>Poista</button>';
      //echo '<input type="hidden" name="rivi'.$riveja.'" value="'.$row['id'].'">';

      $riveja = $riveja + 1;
    }

    echo '<input type="hidden" name="rivien_maara" value='.$riveja.'>';
    ?>

  </table>
    </div>
    <br>
    <div class="pseudo_select">
      <table id="ruokakalenteri">
  <?php echo '<th>Reseptin paino</th><td>'.$reseptin_paino.' g</td>'; ?>
  <tr>

    <?php

    $query_str = "SELECT ruoka_aineet.ruoka_aine,reseptin_aineet.kaytto_maara*ruoka_aineet.paino_kaytto_yks AS paino, sisalto_hiilih,sisalto_protei,sisalto_rasva FROM ruoka_aineet JOIN reseptin_aineet ON reseptin_aineet.ruoka_aine_id=ruoka_aineet.ruoka_aine_id WHERE reseptin_aineet.resepti_id=".$_SESSION['resepti_id'];
    //echo '<br>'.$query_str.'<br>';
    $kysely=$db->query($query_str);

    $hiilihydraatti = 17;
    $proteiini = 17;
    $rasva = 38;

    $sis_h = 0;
    $sis_p = 0;
    $sis_r = 0;

    foreach ($kysely as $row)
    {
      $paino = $row['paino'];
      $sis_h = $sis_h + $paino * $row['sisalto_hiilih'];
      $sis_p = $sis_p + $paino * $row['sisalto_protei'];
      $sis_r = $sis_r + $paino * $row['sisalto_rasva'];

    }

    $energia = $sis_h * $hiilihydraatti + $sis_p * $proteiini + $sis_r * $rasva;
    $energia = round($energia / $reseptin_paino,0);

     ?>

  <th>Energiasisältö</th><td>
  <?php
  echo $energia.' kJ / 100 g';
  ?>
</td>
  <tr>
  <th>Annoskoko</th><td>

<?php
$query_str = "SELECT annoskoko FROM reseptit WHERE resepti_id=".$_SESSION['resepti_id'];
//echo '<br>'.$query_str.'<br>';
$kysely=$db->query($query_str);

foreach ($kysely as $row)
{
  $annoskoko = $row['annoskoko'];
}

echo '<input type="number" step="1" name="annos_koko" value='.$annoskoko.' style="width: 5em"> g';

 ?>
  </td>
  <td>
    <input type="submit" name="muokka_annos" value="Muokkaa">
  </td>
  <tr>
  <?php echo '<th>Energiasisältö / annos</th><td>'.round($energia*$annoskoko/100,0).' kJ / '.$annoskoko.' g</td>'; ?>
  <tr>
  <?php echo '<th>Reseptin hinta</th><td>'.$reseptin_hinta.' €</td>'; ?>
</table>
</div>
<br>
  <div class="pseudo_select">
  <table id="ruokakalenteri">
    <th></th>
    <th>/ 100 g</th>
    <th>/ annos</th>
    <th>kJ %</th>
    <tr>
      <th>Hiilihydraatit</th>
      <td>
      <?php
      echo round(($sis_h / $reseptin_paino),1).' g';
      ?>
      </td>
      <td>
      <?php
      echo round(($sis_h / $reseptin_paino * $annoskoko / 100),1).' g';
      ?>
      </td>
      <td>
      <?php
      echo round(($sis_h * 100 / $reseptin_paino) * $hiilihydraatti / $energia,1).' %';
      ?>
      </td>
      <tr>
        <th>Proteiinit</th>
        <td>
        <?php
        echo round(($sis_p / $reseptin_paino),1).' g';
        ?>
        </td>
        <td>
          <?php
        echo round(($sis_p / $reseptin_paino * $annoskoko / 100),1).' g';
        ?>
      </td>
        <td>
        <?php
        echo round(($sis_p * 100 / $reseptin_paino) * $proteiini / $energia,1).' %';
        ?>
        </td>
        <tr>
          <th>Rasvat</th>
          <td>
          <?php
          echo round(($sis_r / $reseptin_paino),1).' g';
          ?>
          </td>
          <td>
            <?php
          echo round(($sis_r / $reseptin_paino * $annoskoko / 100),1).' g';
          ?>
        </td>
          <td>
          <?php
          echo round(($sis_r * 100 / $reseptin_paino) * $rasva / $energia,1).' %';
          ?>
          </td>

  </table>
</div>
</div_3part>
<div_3part>
    <br><br><br>
      <input type="submit" name="lisaa_ruoka-aine" value="<< Lisää">

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
