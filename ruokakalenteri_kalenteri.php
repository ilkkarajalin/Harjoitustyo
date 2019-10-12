<section_3part>
  <div_3part>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <input type="submit" name="vko_alas" value="<<">
  <?php echo 'Vko '.date("W", strtotime('+'.(($mod_today * -1) + 7 + (($_SESSION['mod_week']-1) * 7)).' days')); ?>
  <input type="submit" name="vko_ylos" value=">>">
  <br>
  <?php
  echo $date_start.'-'.$date_end;
  ?>
</form>
</div_3part>
</section_3part>
<br>
<br>
<?php

$kalenteri = array();

for($k=0;$k<8;$k++)
{
  $kalenteri[] = array("","","","","","","","");
}

for($k=0;$k<6;$k++)
{
  $kalenteri[$k][0] = '<th>'.$ruokailu[$k].'</th>';
}

$viikonpaivat = array("","Maanantai","Tiistai","Keskiviikko","Torstai","Perjantai","Lauantai","Sunnuntai");

for($k=0;$k<8;$k++)
{
  $kalenteri[0][$k] = '<th>'.$viikonpaivat[$k].'</th>';
}

for($x=0;$x<6;$x++)
{
  $paivat = array($ruokailu[$x]);

  for($y=1;$y<8;$y++)
  {
    if ($x == 0)
    {
      $paivat[] = $viikonpaivat[$y];
    }
    else
    {
      $paivat[] = "Pizza";
    }

  }

  $ruokailut[] = $paivat;

}

?>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<section_3part>
  <div_3part>
    <input type="text" name="resepti_haku" values="" placeholder="Rajaa reseptejä" size="25">
    <input type="submit" name="rajaa_resepti" value="Rajaa">
    <br>
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
<div class="pseudo_select">

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">

<table id="ruokakalenteri">
  <?php
  for ($x=1;$x<6;$x++)
  {
    //echo '<tr>';

    for ($y=1;$y<8;$y++)
    {
      $f = $x*10+$y;
      $temp_array = $ruokailut[$x];
      $a = "td";
      $b = "";
      $e = "";
      $query_date = "";
      $paivan_reseptit = "";

      $query_date = date("Y-m-d", strtotime('+'.(($mod_today * -1) + 7 + (($_SESSION['mod_week']-1) * 7) + ($y - 1)).' days'));

      $query_str = "SELECT ruokakalenteri.id, ruokakalenteri.resepti_id,reseptit.resepti FROM ruokakalenteri JOIN reseptit ON reseptit.resepti_id=ruokakalenteri.resepti_id WHERE ruokakalenteri.ruokakunta_id=1 AND ruokakalenteri.pvm='".$query_date."' AND ruokakalenteri.ruokailu='".$ruokailu[$x]."'";
                //echo '<br>'.$query_str.'<br>';

      $kysely=$db->query($query_str);

      $paivan_reseptit = '<'.$a.'>';

      foreach ($kysely as $row)
      {
          $id = $row['id'];
          $resepti_nimi = $row['resepti'];

          if(isset($resepti_nimi))
          {
                    $title = 'Tähän paljon asiaa
              Ja lisää asiaa
              Ja voihan laittaa vielä Lisää
              Miksei enemmänkin
              Saisiko vielä tasattua vasemmalle?
              No saihan sen kun tasaa tässäkin';

                  $paivan_reseptit = $paivan_reseptit.'<b title="'.$title.'">';
                  $paivan_reseptit = $paivan_reseptit.$resepti_nimi.'</b>';
                  $paivan_reseptit = $paivan_reseptit.'<button type="submit" name="poista_kalenteri" value="'.$row['id'].'">X</button><br>';
                                    //.$temp_array[$y].'</b>'.$b.$e.$query_date.'</'.$a.'>';

          }

      }

      $paivan_reseptit = $paivan_reseptit.'<button type="submit" name="lisaa_resepti" value="'.$f.'">Lisää valittu resepti</button><br>';
      $paivan_reseptit = $paivan_reseptit.'</'.$a.'>';

      $kalenteri[$x][$y] = $paivan_reseptit;

    }





          //echo $paivan_reseptit;

    }

    //echo '</tr>';




  for($rivi=0;$rivi<6;$rivi++)
  {
    echo '<tr>';

    for($sarake=0;$sarake<8;$sarake++)
    {
        if($kalenteri[$rivi][$sarake] == "")
        {
          echo '<td></td>';
        }
        else
        {
          echo $kalenteri[$rivi][$sarake];
        }
    }

    echo '</tr>';

  }

  ?>

</table>
</form>
</div>
</div_3part>
</section_3part>
