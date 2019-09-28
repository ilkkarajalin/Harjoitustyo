<?php include "menu.php"; ?>
<br>
Päivämäärä
<br>
<input type="date" value="<?php echo date('Y-m-d'); ?>" />
<br>
<section_3part>
<div_3part>

    <input type="text" name="ruoka-aineet" values="" placeholder="Rajaa ruoka-aineita..." size=15>

    <br>
  Ruoka-aineet:<br>
<select class="non_scroll" name="ruoka-aine" size="20" width="50">
  <option value="ruoka-aine0">Maito</option>
  <option value="ruoka-aine1">Kaurahiutaleet</option>
  <option value="ruoka-aine2">Marjat</option>
  <option value="ruoka-aine3">Vehnäjauho</option>
  <option value="ruoka-aine4">Kananmuna</option>
</select>

</div_3part>

<div_3part>
  <br><br>
  Hankintayksikkö pkt
  <br><br>
  Määrä
  <input type="number" name="ostettu_maara" value="1" size="1">
  <br><br>
  Hinta yhteensä
  <input type="number" name="hinta_yht" value="3.59" size="2">
  €
  <br><br>
  <input type="submit" name="Lisaa_ostos" value="Lisää">
</div_3part>

</section_3part>

<?php include "footer.php"?>
