<?php include "menu.php"; ?>

    <section_3part>
    <div_3part>

      <form class="" action="show_post.php" method="post">
        <input type="text" name="ruokakunta" value="" placeholder="Rajaa tai nimeä uusi" size=15>
        <input type="submit" name="lisaa_ruokakunta" value="Lisää uusi">
        </form>
        <br>
      Ruokakunnat:<br>
      <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
        <select name="ruokakunta" onchange="">
          <?php
            $query_str = "SELECT * FROM ruokakunnat WHERE kayttaja_id=".$_SESSION['user_id']." ORDER BY ruokakunta";
            $kysely=$db->query($query_str);

            foreach ($kysely as $row)
            {
              echo '<option value='.$row['ruokakunta_id'].$valittu.'>'.$row['ruokakunta'].'</option>';
            }

          ?>
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
      <form class="" action="show_get.php" method="get">
    <input type="text" name="nimi_uusi_jasen" value="" placeholder="Uuden jäsenen nimi">
    <br>
    <input type="submit" name="lisaa_jasen" value="<- Lisää jäsen">
    <br>
    <br>
    <br>
    <input type="submit" name="lisaa_jasen" value="Poista jäsen ->">
  </form>
</div_3part>


</section_3part>

<?php include "footer.php"; ?>
