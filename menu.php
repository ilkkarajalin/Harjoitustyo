<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ruokakalenteri</title>
    <link rel="stylesheet" href="css/mystyle.css">
  </head>
  <body>
    <nav>
      <ul>
        <?php
        if(session_status() !== PHP_SESSION_ACTIVE) session_start();

        if(isset($_SESSION['logged_in']))
        {
          echo '<li><a href="ruokakunta.php">Ruokakunta</a></li>';
          echo '<li><a href="ruokakalenteri.php">Ruokakalenteri</a></li>';
          echo '<li><a href="ostoslista.php">Ostoslista</a></li>';
          echo '<li><a href="ostokset.php">Ostokset</a></li>';
          echo '<li><a href="reseptit.php">Reseptit</a></li>';
          echo '<li><a href="ruoka-aineet.php">Ruoka-aineet</a></li>';
          echo '<li><a href="yllapito.php">Ylläpito</a></li>';
        }
        else
        {
          echo '<li><a href="">Ruokakunta</a></li>';
          echo '<li><a href="">Ruokakalenteri</a></li>';
          echo '<li><a href="">Ostoslista</a></li>';
          echo '<li><a href="">Ostokset</a></li>';
          echo '<li><a href="">Reseptit</a></li>';
          echo '<li><a href="">Ruoka-aineet</a></li>';
          echo '<li><a href="">Ylläpito</a></li>';
        }



    ?>
      </ul>
  </nav>
  <br>
  <br>
