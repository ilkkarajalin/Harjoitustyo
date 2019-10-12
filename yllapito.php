<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php
//print_r($_POST);

if(isset($_POST['muokkaa_energia']) && $_POST['hiilihydraatit'] != '' && $_POST['proteiinit'] != '' && $_POST['rasvat'] != '')
{
  $_SESSION['e_hiili'] = $_POST['hiilihydraatit'];
  $_SESSION['e_prote'] = $_POST['proteiinit'];
  $_SESSION['e_rasva'] = $_POST['rasvat'];

  $query_str = "UPDATE energia_sisallot SET kj_g=".$_SESSION['e_hiili']." WHERE kayttaja_id=".$_SESSION['user_id']." AND ravintoaine='hiilihydraatit'";
  $kysely=$db->query($query_str);
  $query_str = "UPDATE energia_sisallot SET kj_g=".$_SESSION['e_prote']." WHERE kayttaja_id=".$_SESSION['user_id']." AND ravintoaine='proteiinit'";
  $kysely=$db->query($query_str);
  $query_str = "UPDATE energia_sisallot SET kj_g=".$_SESSION['e_rasva']." WHERE kayttaja_id=".$_SESSION['user_id']." AND ravintoaine='rasvat'";
  $kysely=$db->query($query_str);

}

if(isset($_POST['lisaa_yksikko']) && $_POST['uusi_yksikko'] != '')
{
    $stmt=$db->prepare("INSERT INTO yksikot VALUES(NULL,:uusi,".$_SESSION['user_id'].")");
    $stmt->bindParam(':uusi',$_POST['uusi_yksikko']);
    $stmt->execute();
}

if(isset($_POST['poista_yksikko']) && isset($_POST['yksikot']))
{
  $query_str = "DELETE FROM yksikot WHERE yksikko_id=".$_POST['yksikot'];
  $kysely=$db->query($query_str);
}

 ?>

<br>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<section_3part>
  <div_3part>
Energiasisällöt
<br>
Hiilihydraatit
<?php
echo '<input type="number" name="hiilihydraatit" value='.$_SESSION['e_hiili'].' style="width: 3em"> kJ/g';
?>
<br>
<br>
Proteiinit
<?php
echo '<input type="number" name="proteiinit" value='.$_SESSION['e_prote'].' style="width: 3em"> kJ/g';
?>
<br>
<br>
Rasvat
<?php
echo '<input type="number" name="rasvat" value='.$_SESSION['e_rasva'].' style="width: 3em"> kJ/g';
?>
<br>
<br>
<input type="submit" name="muokkaa_energia" value="Muokkaa">
</div_3part>
</section_3part>

<br>

<section_3part>
  <div_3part>
    Yksiköt
    <br>
    <select class="non_scroll" name="yksikot" size="20" width="50">
<?php
  $query_str = "SELECT * FROM yksikot WHERE kayttaja_id=".$_SESSION['user_id'];
  $kysely=$db->query($query_str);

  foreach($kysely as $row)
  {
      echo '<option value="'.$row['yksikko_id'].'">'.$row['yksikko'].'</option>';
  }
      ?>
    </select>
  </div_3part>
  <div_3part>
    <br>
    <br>
    <input type="submit" name="lisaa_yksikko" value="<< Lisää">
    <br>
    <br>
    <input type="submit" name="poista_yksikko" value="Poista">
  </div_3part>
  <div_3part>
    Uusi Yksikkö
    <br>
    <input type="text" name="uusi_yksikko" value="" placeholder="Uuden yksikön nimi..">
  </div_3part>
</section_3part>
</form>
<?php include "footer.php"; ?>
