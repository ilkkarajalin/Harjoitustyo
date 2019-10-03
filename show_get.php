<?php include "menu.php"; ?>

Get data on seuraava:
<br>
<?php
print_r($_GET);
?>
<br>
Pelkän datan esitys:
<br>
<?php
echo 'Uusi jäsen on '.$_GET['nimi_uusi_jasen']
 ?>


<br>
<?php include "footer.php"; ?>
