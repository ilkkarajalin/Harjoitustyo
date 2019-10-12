<?php include "menu.php"; ?>
<?php include "connection.php"; ?>

<?php

//print_r($_POST);

if(isset($_POST['ruokakunnat']))
{
  $_SESSION['ruokakunta_ruokakunta_id'] = $_POST['ruokakunnat'];
}

if(isset($_POST['lisaa_jasen']))
{
  $uusi_jasen = $_POST['nimi_uusi_jasen'];

  if($uusi_jasen != "")
  {
    $stmt=$db->prepare("INSERT INTO jasenet VALUES(NULL,".$_SESSION['ruokakunta_ruokakunta_id'].",:jasen)");
    $stmt->bindParam(':jasen',$uusi_jasen);
    $stmt->execute();
  }
}

if(isset($_POST['poista_jasen']) AND isset($_POST['jasenet']))
{
  $query_str = "DELETE FROM jasenet WHERE jasen_id=".$_POST['jasenet'];
  $kysely=$db->query($query_str);
}

if(isset($_POST['lisaa_ruokakunta']))
{
  if($_POST['ruokakunta'] != '')
  {
    $stmt=$db->prepare("INSERT INTO ruokakunnat VALUES(NULL,".$_SESSION['user_id'].",:uusi_nimi)");
    $stmt->bindParam(':uusi_nimi',$_POST['ruokakunta']);
    $stmt->execute();


  }
}

if(isset($_POST['poista_ruokakunta']) && isset($_POST['ruokakunnat']))
{
  $query_str = "DELETE FROM ruokakunnat WHERE ruokakunta_id=".$_POST['ruokakunnat'];
  $kysely=$db->query($query_str);
}

 ?>
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <section_3part>
    <div_3part>


        <input type="text" name="ruokakunta" value="" placeholder="Nimeä uusi" size=15>
        <input type="submit" name="lisaa_ruokakunta" value="Lisää uusi">
        <br>
        <input type="submit" name="valitse_ruokakunta" value="Valitse">
        <input type="submit" name="poista_ruokakunta" value="Poista">
        <br>
      Ruokakunnat:<br>
    <select class="non_scroll" name="ruokakunnat" size="20" width="50">

      <?php

      $query_str_ruokakunta="SELECT ruokakunta_id,ruokakunta FROM ruokakunnat WHERE kayttaja_id=".$_SESSION['user_id'];

      $kysely=$db->query($query_str_ruokakunta);

      foreach ($kysely as $row)
      {
        $valittu = "";

        if($row['ruokakunta_id'] == $_SESSION['ruokakunta_ruokakunta_id'])
        {
          $valittu = " selected";
        }

        echo '<option value="'.$row['ruokakunta_id'].'"'.$valittu.'>'.$row['ruokakunta'].'</option>';
      }

      ?>

    </select>

  </div_3part>
<?php
  if(isset($_SESSION['ruokakunta_ruokakunta_id']))
  {
    include "ruokakunta_form.php";
  }
?>
</section_3part>
</form>

<?php include "footer.php"; ?>
