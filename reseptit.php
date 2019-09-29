<?php include "menu.php"; ?>
<section_3part>
  <div_3part>
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
</div_3part>
</section_3part>
<br>

<section_3part>
  <div_3part>
    <input type="text" name="resepti_haku" values="" placeholder="Rajaa reseptejä tai lisää uusi" size="25">
    <input type="submit" name="lisaa_resepti" value="Lisää uusi">
    <br><br>
    Reseptit
    <select class="non_scroll" name="reseptit" size="20" width="50">
      <option value="">Marjapuuro</option>
      <option value="">Lasagne</option>
      <option value="">Pizza</option>
      <option value="">Hedelmäsmoothie</option>
      <option value="">Munakas</option>
    </select>
  </div_3part>
  <div_3part>
      <br><br><br>
        <input type="submit" name="tarkastele_resepti" value="Tarkastele">
        <br><br><br>
        <input type="submit" name="poista_resepti" value="Poista">

    </div_3part>
  <div_3part>
    <br><br>
    Reseptin ruoka-aineet
    <select class="non_scroll" name="resptin_aineet" size="20" width="50">
      <option value="">Lasagnelevyt 1 pkt 1.59 €</option>
      <option value="">Tomaattimurska 1 prk 0.98 €</option>
      <option value="">Juustoraaste Emmental 1 pss 1.59 €</option>
      <option value="">Maito 1 ltr 0.68 €</option>
      <option value="">Vehnäjauho 1 dl 0.05 €</option>
    </select>
    <br>
    Reseptin paino 1530 g
    <br>
    450 kJ / 100 g
    <br>
    Annoskoko 250 g
    <br>
    1100 kJ / 250 g
    <br>
    Reseptin hinta 10.76 €
    <br>
    <table id="ruokakalenteri">
      <th></th>
      <th>/ 100 g</th>
      <th>/ annos</th>
      <th>kJ %</th>
      <tr>
        <th>Hiilihydraatit</th>
        <td>22 g</td>
        <td>51 g</td>
        <td>30 %</td>
        <tr>
          <th>Proteiinit</th>
          <td>12.8 g</td>
          <td>30.4 g</td>
          <td>22 %</td>
          <tr>
            <th>Rasvat</th>
            <td>9.4 g</td>
            <td>23.8 g</td>
            <td>48 %</td>

    </table>
  </div_3part>
  <div_3part>
      <br><br><br>
        <input type="submit" name="lisaa_ruoka-aine" value="<< Lisää">
        <br><br><br>
        Muokkaa:
        <br>
        <input type="number" name="ruoka-aine_maara" value=1 style="width: 3em">
        <br>
        <input type="submit" name="muuta_maara" value="Muokkaa">
        <br><br><br>
        <input type="submit" name="poista_ruoka-aine" value="Poista >>">

    </div_3part>
  <div_3part>
    <input type="text" name="ruoka-aine_haku" values="" placeholder="Rajaa ruoka-aineita" size="25">
    <input type="submit" name="rajaa_ruoka-aine" value="Rajaa">
    <br><br>
    Ruoka-aineet
    <select class="non_scroll" name="resptin_aineet" size="20" width="50">
      <option value="">Lasagnelevyt</option>
      <option value="">Tomaattimurska</option>
      <option value="">Juustoraaste Emmental</option>
      <option value="">Maito</option>
      <option value="">Vehnäjauho</option>
    </select>
  </div_3part>
</section_3part>

<?php include "footer.php"; ?>
