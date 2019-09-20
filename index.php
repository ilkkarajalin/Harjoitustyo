<?php include "menu.php"; ?>

    <section_3part>
    <div_3part>

      <form class="" action="show_post.php" method="post">
        <input type="text" name="ruokakunta" values="" placeholder="Rajaa tai nimeä uusi" size=15>
        <input type="submit" name="lisaa_ruokakunta" value="Lisää uusi">
        </form>
        <br>
      Ruokakunnat:<br>
    <select class="non_scroll" name="ruokakunnat" size="20" width="50">
      <option value="ruokakunnat0">Mainiot</option>
      <option value="ruokakunnat1">Juoniot</option>
      <option value="ruokakunnat2">Meikäläiset</option>
      <option value="ruokakunnat3">Virtaset</option>
      <option value="ruokakunnat4">Korhoset</option>
    </select>

  </div_3part>
    <br>
  <div_3part>
    <br>
    <br>
    Ruokakunnan jäsenet:
    <br>
    <select class="non_scroll" name="jasenet" size="20">
      <option value="r0jasen0">Mainiot</option>
      <option value="r0jasen1">Juoniot</option>
      <option value="r0jasen2">Meikäläiset</option>
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
    <input type="submit" name="lisaa_jasen" value="Poista jäsen ->">
</div_3part>


</section_3part>
  </body>
</html>
