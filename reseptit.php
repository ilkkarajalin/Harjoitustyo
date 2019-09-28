<?php include "menu.php"; ?>

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
  </div_3part>
  <div_3part>
      <br><br><br>
        <input type="submit" name="lisaa_ruoka-aine" value="<< Lisää">
        <br><br><br>
        <input type="submit" name="poista_ruoka-aine" value="Poista >>">

    </div_3part>
  <div_3part>
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
