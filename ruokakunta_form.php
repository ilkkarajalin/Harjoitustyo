<br>

<div_3part>

<br>
<br>
    Ruokakunnan jäsenet:
<br>
<select class="non_scroll" name="jasenet" size="20">
  <?php

  $query_str="SELECT jasen_id,jasen FROM jasenet WHERE ruokakunta_id=".$_SESSION['ruokakunta_ruokakunta_id'];

  $kysely=$db->query($query_str);

  foreach ($kysely as $row)
  {
    echo '<option value="'.$row['jasen_id'].'">'.$row['jasen'].'</option>';
  }

  ?>
</select>
</div_3part>
<br>
<div_3part>
  <br>
  <br>
  <br>
<input type="text" name="nimi_uusi_jasen" value="" placeholder="Uuden jäsenen nimi">
<br>
<input type="submit" name="lisaa_jasen" value="<- Lisää jäsen">
<br>
<br>
<br>
<input type="submit" name="poista_jasen" value="Poista jäsen ->">

</div_3part>
