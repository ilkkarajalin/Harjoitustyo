<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php
$ruokailut = array();
$ruokailu = array("","Aamiainen","Lounas","Päivällinen","Iltapala","Välipalat");

//print_r($_POST);

$weekday = date("w");
//echo '<br>weekday='.$weekday.'<br>';
$mod_today = 0;

if(!isset($_SESSION['mod_week']))
{
    $_SESSION['mod_week'] = 0;
}

if($weekday == 0)
{
  $mod_today = 6;
}
else
{
  $mod_today = $weekday - 1;
}
//echo '<br>mod_today='.$mod_today.'<br>';

if(isset($_POST['vko_alas']))
{
  $_SESSION['mod_week'] = $_SESSION['mod_week'] - 1;
}

if(isset($_POST['vko_ylos']))
{
  $_SESSION['mod_week'] = $_SESSION['mod_week'] + 1;
}

$date_start = date("d.m.Y", strtotime('+'.(($mod_today * -1) + 7 + (($_SESSION['mod_week']-1) * 7)).' days'));
$date_end = date("d.m.Y", strtotime('+'.(($mod_today * -1) + 6 + ($_SESSION['mod_week'] * 7)).' days'));


if(isset($_POST['valitse_ruokakunta']))
{
  $_SESSION['kalenteri_ruokakunta'] = $_POST['ruokakunta'];
}

$query_str_resepti = "";

if(isset($_SESSION['kalenteri_ruokakunta']))
{
$query_str_resepti = "SELECT * FROM reseptit WHERE ruokakunta_id=".$_SESSION['kalenteri_ruokakunta'];
}

if(isset($_POST['rajaa_resepti']))
{
  $rajaa = $_POST['resepti_haku'];
  $query_str_resepti = "SELECT * FROM reseptit WHERE resepti LIKE '%".$rajaa."%' AND ruokakunta_id=".$_SESSION['kalenteri_ruokakunta'];
}
//echo '<br>'.$query_str_resepti.'<br>';

if(isset($_POST['lisaa_resepti']))
{
  $ruok = floor($_POST['lisaa_resepti']/10);
  $paiva = $_POST['lisaa_resepti'] - 10*$ruok;

  if(!isset($_POST['reseptit']))
  {
    echo '<br>Valitse resepti ennen lisäämistä<br>';
  }
  else
  {
    $lisaa_pvm = date("Y-m-d", strtotime('+'.(($mod_today * -1) + 6 + $paiva + (($_SESSION['mod_week']-1) * 7)).' days'));
    $lisaa_ruokailu = $ruokailu[$ruok];
    $lisaa_ruokakunta = $_SESSION['kalenteri_ruokakunta'];
    $lisaa_resepti_id = $_POST['reseptit'];

    //echo '<br>ruok='.$ruok.' paiva='.$paiva.'<br>';
    $query_str = "INSERT INTO ruokakalenteri VALUES(NULL,'".$lisaa_pvm."','".$lisaa_ruokailu."',".$lisaa_ruokakunta.",".$lisaa_resepti_id.")";
    echo '<br>'.$query_str.'<br>';
    $kysely=$db->query($query_str);
  }

}

if(isset($_POST['poista_kalenteri']))
{
  $query_str = "DELETE FROM ruokakalenteri WHERE id=".$_POST['poista_kalenteri'];
  //echo '<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);
}

 ?>

<section_3part>
  <div_3part>
<br>
Valitse ruokakunta:
<br>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
  <select name="ruokakunta" onchange="">
    <?php
      $query_str = "SELECT * FROM ruokakunnat WHERE kayttaja_id=".$_SESSION['user_id']." ORDER BY ruokakunta";
      //echo '<br>'.$query_str.'<br>';
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

<?php

if(isset($_SESSION['kalenteri_ruokakunta']))
{
  include "ruokakalenteri_kalenteri.php";
}

 ?>

<?php include "footer.php"; ?>
