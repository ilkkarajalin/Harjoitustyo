<?php include "menu.php"; ?>
<br>
<section_3part>
  <div_3part>
    <input type="text" name="ruoka_aine" values="" placeholder="Lisää uusi ruoka-aine" size=15>
    <input type="submit" name="lisaa_ruoka-aine" value="Lisää uusi">
  <br>
  <select class="non_scroll" name="ruoka-aineet" size="20" width="50">
    <option value="">Lasagnelevyt</option>
    <option value="">Tomaattimurska</option>
    <option value="">Juustoraaste Emmental</option>
    <option value="">Maito</option>
    <option value="">Vehnäjauho</option>
  </select>
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
  <input type="number" name="muunnos" value=1.0 style="width: 3em">
  <br>
  <br>
  Ruoka-aineen ravintosisältö / 100 g
  <br>
  Hiilihydraatit
  <input type="number" name="muunnos" value=1.0 style="width: 3em">
   / 100 g
   <br>
   Proteiinit
   <input type="number" name="muunnos" value=1.0 style="width: 3em">
    / 100 g
    <br>
    Rasvat
    <input type="number" name="muunnos" value=1.0 style="width: 3em">
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
