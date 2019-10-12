<?php include "menu.php"; ?>
<?php include "connection.php"; ?>
<?php

$query_str_aine = 'SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE kayttaja_id='.$_SESSION['user_id'].' ORDER BY ruoka_aine';


if(isset($_POST['ruokakunta']))
{
  $_SESSION['resepti_ruokakunta_id'] = $_POST['ruokakunta'];
  $query_str_resepti = "SELECT * FROM reseptit WHERE ruokakunta_id=".$_SESSION['resepti_ruokakunta_id'];
}

if(isset($_POST['rajaa_resepti']))
{
    $query_str_resepti = "SELECT * FROM reseptit WHERE resepti LIKE '%".$_POST['resepti_haku']."%' AND ruokakunta_id=".$_SESSION['resepti_ruokakunta_id'];
}

if(isset($_POST['rajaa_ruoka-aine']))
{
  $query_str_aine = "SELECT ruoka_aine_id,ruoka_aine FROM ruoka_aineet WHERE ruoka_aine LIKE '%".$_POST['ruoka-aine_haku']."%' AND kayttaja_id=".$_SESSION['user_id']." ORDER BY ruoka_aine";
  echo '<br>';
  echo $query_str_aine;
}

if(isset($_POST['tarkastele_resepti']))
{
  $valittu_resepti_id = $_POST['reseptit'];
  $_SESSION['resepti_id'] = $valittu_resepti_id;
  $query_str_resepti = "SELECT * FROM reseptit WHERE resepti_id=".$valittu_resepti_id;
}

if(isset($_POST['muokkaa']))
{
  $input = $_POST['muokkaa'];
  $inputs = explode(".",$input);
  // resepti taulun rivinumero
  // esitetyn taulun rivinumero
  $resepti_id = $inputs[0];
  $taulun_id = $inputs[1];
  $taulun_arvo = $_POST[$taulun_id];

  //echo '<br>Muokattava resepti_id='.$resepti_id.' ja uusi arvo='.$taulun_arvo.'<br>';

  $query_str = "UPDATE reseptin_aineet SET kaytto_maara=".$taulun_arvo." WHERE id=".$resepti_id;
  //echo '<br>'.$query_str.'<br>';

  $kysely=$db->query($query_str);

  //echo '<br>';

}

if(isset($_POST['lisaa_ruoka-aine']))
{
  $ruoka_aine_id = $_POST['reseptin_aineet'];
  $query_str = "INSERT INTO reseptin_aineet VALUES(NULL,".$_SESSION['resepti_id'].",".$ruoka_aine_id.",1)";
  //echo '<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);
}

if(isset($_POST['poista']))
{
  $query_str = "DELETE FROM reseptin_aineet WHERE id=".$_POST['poista'];
  //echo '<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);
}

if(isset($_POST['lisaa_resepti']))
{
  $query_str = "INSERT INTO reseptit VALUES(NULL,".$_SESSION['resepti_ruokakunta_id'].",'".$_POST['resepti_haku']."',100)";
  //echo '<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);
}

if(isset($_POST['poista_resepti']))
{
  $resepti_id = $_POST['reseptit'];
  $query_str = "DELETE FROM reseptit WHERE resepti_id=".$resepti_id;
  //echo '<br>'.$query_str.'<br>';
  $kysely=$db->query($query_str);
}

//print_r($_POST);

$nayta_lomake = false;

if(isset($_SESSION['resepti_ruokakunta_id']))
{
  $nayta_lomake = true;
}

if(isset($_POST['annos_koko']) && $_POST['annos_koko'] != '')
{
  $stmt=$db->prepare("UPDATE reseptit SET annoskoko=:annos WHERE resepti_id=".$_SESSION['resepti_id']);
  $stmt->bindParam(':annos',$_POST['annos_koko']);
  $stmt->execute();
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

<?php

if(isset($_SESSION['resepti_ruokakunta_id']))
{
  include "reseptit_resepti.php";
}
?>

</section_3part>
</form>

<?php include "footer.php"; ?>
