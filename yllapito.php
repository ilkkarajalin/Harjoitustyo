<?php include "menu.php"; ?>
<br>
<section_3part>
  <div_3part>
Energiasisällöt
<br>
Hiilihydraatit
<input type="number" name="hiilihydraatit" value=17 style="width: 3em">
kJ/g
<br>
<br>
Proteiinit
<input type="number" name="proteiinit" value=17 style="width: 3em">
kJ/g
<br>
<br>
Rasvat
<input type="number" name="rasvat" value=38 style="width: 3em">
kJ/g
<br>
</div_3part>
</section_3part>

<br>

<section_3part>
  <div_3part>
    Yksiköt
    <br>
    <select class="non_scroll" name="yksikot" size="20" width="50">
      <option value="">ltr</option>
      <option value="">kg</option>
      <option value="">dl</option>
      <option value="">pss</option>
      <option value="">pkt</option>
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

<?php include "footer.php"; ?>
