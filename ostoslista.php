<?php include "menu.php"; ?>
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
<br>
<form action"">
  <input type="submit" name="vko_alas" value="<<">
  Vko 39
  <input type="submit" name="vko_ylos" value=">>">
  <br>
  dd.mm.yyyy - dd.mm.yyy
</from>
<br>
<br>

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

?>

<section_3part>
  <div_3part>
    Viikon suunnitellut ruokailut
    <br>
    <?php

    for ($x=0;$x<5;$x++)
    {
      if (count($viikon_ruokailut[$x]) > 0)
      {
          echo '<b>'.$ruokailut_nimi[$x].' '.count($viikon_ruokailut[$x]).' kpl</b><br>';

          for ($y=0;$y<count($viikon_ruokailut[$x]);$y++)
          {
            $reseptien_idt = $viikon_ruokailut[$x];
            $reseptin_id = $reseptien_idt[$y];

            echo '<tab4>'.$resepti_nimi[$reseptin_id].'</tab4><br>';
          }

      }
    }
    ?>
  </div_3part>
  <div_3part>

  </div_3part>
  <div_3part>
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
  </div_3part>
</section_3part>

<?php include "footer.php"; ?>
