<br>

<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
<section_3part>
  <div_3part>
    <input type="text" name="resepti_haku" values="" placeholder="Rajaa reseptejä tai lisää uusi" size="25">
    <input type="submit" name="rajaa_resepti" value="Rajaa">
    <br>
    <input type="submit" name="lisaa_resepti" value="Lisää uusi">
    <br><br>
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
      <br><br><br>
        <input type="submit" name="tarkastele_resepti" value="Tarkastele">
        <br><br><br>
        <input type="submit" name="poista_resepti" value="Poista">

    </div_3part>

<?php
if(isset($_SESSION['resepti_id']))
{
  include "reseptit_aineet.php";
}

 ?>
