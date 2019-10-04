<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php

$query_str = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet';
$rajaa_ruoka_aine = false;
print_r($_POST);
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
if(isset($_POST['$rajaa_ruoka_aine']))
{
$query_str = 'SELECT ruoka_aine_id,ruoka_aine'
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
    <input type="submit" name="lisaa_ruoka-aine" value="Lisää uusi">
  <br>

  <select class="non_scroll" name="ruoka-aineet" size="20" width="50">



  <?php

  $kysely=$db->query($query_str);

  foreach ($kysely as $row)
  {
    echo '<option value="'.$row['ruoka_aine_id'].'">'.$row['ruoka_aine'].'</option>';
  }
  ?>

  </select>
  <br>
  <br>
  <input type="submit" name="muokkaa_ruoka-aine" value="Muokkaa">
</form>
</div_3part>
<div_3part>
  <br>
  Ruoka-aineen Hankintayksikkö
  <select name="hankinta_yks" onchange="">
    <option value="">ltr</option>
    <option value="">kg</option>
    <option value="">dl</option>
    <option value="">pss</option>
    <option value="">pkt</option>
  </select>
  <br>
  Ruoka-aineen käyttöyksikkö
  <select name="kaytto_yks" onchange="">
    <option value="">ltr</option>
    <option value="">kg</option>
    <option value="">dl</option>
    <option value="">pss</option>
    <option value="">pkt</option>
  </select>
  <br>
  Painomuunnos käyttö/hankinta
  <input type="number" name="muunnos" step="0.1" value=1.0 style="width: 3em">
  <br>
  <br>
  Ruoka-aineen ravintosisältö / 100 g
  <br>
  Hiilihydraatit
  <input type="number" name="muunnos" step="0.1" value=1.0 style="width: 3em">
   / 100 g
   <br>
   Proteiinit
   <input type="number" name="muunnos" step="0.1" value=1.0 style="width: 3em">
    / 100 g
    <br>
    Rasvat
    <input type="number" name="muunnos" step="0.1" value=1.0 style="width: 3em">
     / 100 g
     <br>
     <br>
     <input type="submit" name="paivita_aine" value="Päivitä ruoka-aine">
     <br>
     <br>
     <input type="submit" name="poista_aine" value="Poista ruoka-aine">
</div_3part>
</section_3part>

<?php include "footer.php"; ?>
