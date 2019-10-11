<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php
$mod_today = 0;

if(!isset($_SESSION['mod_week_ostos']))
{
    $_SESSION['mod_week_ostos'] = 0;
}

$weekday = date("w");
echo '<br>weekday='.$weekday.'<br>';
$mod_today = 0;

if($weekday == 0)
{
  $mod_today = 6;
}
else
{
  $mod_today = $weekday - 1;
}


if(isset($_POST['vko_alas']))
{
  $_SESSION['mod_week_ostos'] = $_SESSION['mod_week_ostos'] - 1;
}

if(isset($_POST['vko_ylos']))
{
  $_SESSION['mod_week_ostos'] = $_SESSION['mod_week_ostos'] + 1;
}

$date_start = date("d.m.Y", strtotime('+'.(($mod_today * -1) + 7 + (($_SESSION['mod_week_ostos']-1) * 7)).' days'));
$date_end = date("d.m.Y", strtotime('+'.(($mod_today * -1) + 6 + ($_SESSION['mod_week_ostos'] * 7)).' days'));

$query_start = date("Y-m-d", strtotime('+'.(($mod_today * -1) + 7 + (($_SESSION['mod_week_ostos']-1) * 7)).' days'));
$query_end = date("Y-m-d", strtotime('+'.(($mod_today * -1) + 6 + ($_SESSION['mod_week_ostos'] * 7)).' days'));

 ?>



<br>
Valitse ruokakunta:
<br>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <select name="ruokakunta" onchange="">
    <?php
      $query_str = "SELECT * FROM ruokakunnat WHERE kayttaja_id=".$_SESSION['user_id']." ORDER BY ruokakunta";
      echo '<br>'.$query_str.'<br>';
      $kysely=$db->query($query_str);

      foreach ($kysely as $row)
      {
        echo '<option value='.$row['ruokakunta_id'].$valittu.'>'.$row['ruokakunta'].'</option>';
      }

    ?>
    <input type="submit" name="valitse_ruokakunta" value="Valitse">
  </select>
  </form>
</div_3part>
</section_3part>
<br>
<section_3part>
  <div_3part>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <input type="submit" name="vko_alas" value="<<">
  <?php echo 'Vko '.date("W", strtotime('+'.(($mod_today * -1) + 7 + (($_SESSION['mod_week_ostos']-1) * 7)).' days')); ?>
  <input type="submit" name="vko_ylos" value=">>">
  <br>
  <?php
  echo $date_start.'-'.$date_end;
  ?>
</form>
</div_3part>
</section_3part>

<?php
$resepti_nimi = array("Marjapuuro","Paahtoleipä","Lohikeitto","Munakas","Karjalanpaisti","Lasagne","Jugurttimurot","Pannukakku","Hedelmäsmoothie","Banaani");
$resepti_id = array(0,1,2,3,4,5,6,7,8,9);

$aamupalat = array(0,1);
$lounaat = array(2,3);
$paivalliset = array(4,5);
$iltapalat = array(6,7);
$valipalat = array(8,9);

$viikon_ruokailut = array($aamupalat,$lounaat,$paivalliset,$iltapalat,$valipalat);
$ruokailut_nimi = array("Aamupalat","Lounaat","Päivälliset","Iltapalat","Välipalat");

$ruokailut = array("Aamiainen","Lounas","Paivallinen","Iltapala","Valipalat");
$n_ruokailut = array (0,0,0,0,0);

for($q=0;$q<5;$q++)
{
  $query_str = "SELECT count(id) FROM ruokakalenteri WHERE ruokailu='".$ruokailut[$q]."' AND pvm>='".$query_start."' AND pvm <='".$query_end."'";
  echo '<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);

  foreach ($kysely as $row)
  {
    $n_ruokailut[$q] = $row['count(id)'];
  }
}

?>


<section_3part>
  <div_3part>
    Viikon suunnitellut ruokailut
    <br>
    <div class="pseudo_select">
    <?php

    for ($x=0;$x<5;$x++)
    {
        if ($n_ruokailut[$x] > 0)
        {
          echo '<b>'.$ruokailut_nimi[$x].' '.$n_ruokailut[$x].' kpl</b><br>';

          $query_str = "SELECT count(id) FROM ruokakalenteri WHERE ruokailu='".$ruokailut[$q]."' AND pvm>='".$query_start."' AND pvm <='".$query_end."'";
          echo '<br>'.$query_str.'<br>';

        }

    }
    ?>
  </div>
  </div_3part>
  <div_3part>
    <div class="pseudo_select">
    Ostoslista
    <br>
    <?php
    $ainekset = array();


    ?>


    <table id="ostoslista">
      <th>Ruoka-aine</th>
      <th>Määrä</th>
      <th>Yksikkö</th>
      <th>Hinta á</th>
      <th>Yhteensä</th>
      <tr>
        <td>Kaurahiutaleet</td>
        <td>1</td>
        <td>Pkt</td>
        <td>2.59 €</td>
        <td>2.59 €</td>
      <tr>
        <td>Kaurahiutaleet</td>
        <td>1</td>
        <td>Pkt</td>
        <td>2.59 €</td>
        <td>2.59 €</td>


    </table>
  </div>
  </div_3part>
</section_3part>

<?php include "footer.php"; ?>
