<?php include "menu.php"; ?>
<br>
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
<form action"">
  <input type="submit" name="vko_alas" value="<<">
  Vko 39
  <input type="submit" name="vko_ylos" value=">>">
  <br>
  dd.mm.yyyy - dd.mm.yyy
</from>
<br>
<br>

<table id="ruokakalenteri">
  <tr>
    <th></th>
    <th>Ma</th>
    <th>Ti</th>
    <th>Ke</th>
    <th>To</th>
    <th>Pe</th>
    <th>La</th>
    <th>Su</th>
  </tr>
  <tr>
    <th>Aamiainen</th>
  </tr>
  <tr>
    <th>Lounas</th>
    <td>
      Lasagne <form><input type="submit" name="kalenteri_id0" value="(x)"></form>
      <br>
      Pizza <input type="submit" name="kalenteri_id1" value="(x)"></form>
    </td>
  </tr>
  <tr>
    <th>Päivällinen</th>

    <?php
    for ($x = 0; $x < 7;$x++)
    {
      echo "<td><form><input type=\"submit\" name=\"lisaa_resepti\" value=\"Lisää resepti\"></form></td>";
    }
    ?>

  </tr>
  <tr>
    <th>Iltapala</th>
  </tr>
  <tr>
    <th>Välipalat</th>
  </tr>
</table>
