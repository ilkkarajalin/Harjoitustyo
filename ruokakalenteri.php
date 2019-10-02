<?php include "menu.php"; ?>

<section_3part>
  <div_3part>
<br>
Valitse ruokakunta:
<br>
<form action="">
  <select name="ruokakunta" onchange="">
    <option value="">Mainiot</option>
    <option value="">Juoniot</option>
    <option value="">Meikäläiset</option>
    <option value="">Virtaset</option>
    <option value="">Korhoset</option>
  </select>
</form>
</div_3part>
</section_3part>
<br>
<section_3part>
  <div_3part>
<form action="">
  <input type="submit" name="vko_alas" value="<<">
  Vko 39
  <input type="submit" name="vko_ylos" value=">>">
  <br>
  dd.mm.yyyy - dd.mm.yyy
</form>
</div_3part>
</section_3part>
<br>
<br>
<?php
$ruokailut = array();
$ruokailu = array("","Aamiainen","Lounas","Päivällinen","Iltapala","Välipalat");
$viikonpaivat = array("","Maanantai","Tiistai","Keskiviikko","Torstai","Perjantai","Lauantai","Sunnuntai");

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

<table id="ruokakalenteri">
  <?php
  for ($x=0;$x<6;$x++)
  {
    echo '<tr>';

    for ($y=0;$y<8;$y++)
    {
      $temp_array = $ruokailut[$x];
      $a = "td";

      if ($x == 0)
      {
        $a = "th";
      }

      if ($y == 0)
      {
        $a = "th";
      }

      $b = "";
      $e = "";

      if ($x > 0)
      {
          if ($y >  0)
          {

            if ($temp_array[$y] != "")
            {
                $d = $x.$y;
                $c = 'poista_'.$d;
                $submit = "submit";
                $lisaa = "lisaa_";
                $teksti = "Lisää valittu resepti";
                $e = '<br><input type='.$submit.' name='.$lisaa.$d.' value="'.$teksti.'">';
                $b = ' <a href='.$c.' title="Poista resepti">(x)</a>';
              }

          }

      }

      $title = 'Tähän paljon asiaa
Ja lisää asiaa
Ja voihan laittaa vielä Lisää
Miksei enemmänkin
Saisiko vielä tasattua vasemmalle?
No saihan sen kun tasaa tässäkin';

      echo '<'.$a.'><b title="'.$title.'">'.$temp_array[$y].'</b>'.$b.$e.'</'.$a.'>';



    }

    echo '</tr>';
  }
  ?>

</table>

<?php include "footer.php"; ?>
