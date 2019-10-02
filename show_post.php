<?php include "menu.php"; ?>

Post data on seuraava:
<br>
<?php
print_r($_POST);
?>
<br>
Pelkän datan esitys:
<br>
<?php
echo 'Uusi ruokakunta on '.$_POST['ruokakunta']
 ?>


<br>
<?php include "footer.php"; ?>
