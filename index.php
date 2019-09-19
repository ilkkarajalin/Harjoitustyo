<?php include "menu.php"; ?>
    <form class="" action="show_post.php" method="post">
      <input type="text" name="ruokakunta" values="" placeholder="Rajaa ruokakuntia tai nimeä uusi" size=30>
      <input type="submit" name="lisaa_ruokakunta" value="Lisää uusi">

    <br>
    Ruokakunnat:<br>
    <select class="" name="ruokakunnat" size="20">
      <option value="ruokakunnat0">Mainiot</option>
      <option value="ruokakunnat1">Juoniot</option>
      <option value="ruokakunnat2">Meikäläiset</option>
      <option value="ruokakunnat3">Virtaset</option>
      <option value="ruokakunnat4">Korhoset</option>
    </select>

    <br>
    Ruokakunnan jäsenet:<br>
    <select class="" name="jasenet" size="20">
      <option value="r0jasen0">Mainiot</option>
      <option value="r0jasen1">Juoniot</option>
      <option value="r0jasen2">Meikäläiset</option>
    </select>
    <br>
    <input type="text" name="nimi_uusi_jasen" value="" placeholder="Uuden jäsenen nimi">
    <br>
    <input type="submit" name="lisaa_jasen" value="<- Lisää jäsen">
    <br>
    <br>
    <br>
    <input type="submit" name="lisaa_jasen" value="Poista jäsen ->">

</form>

  </body>
</html>
