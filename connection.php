<?php
//Käyttäjätunnus:	t8rail00
//Salasana:	qkJXjLkpBwampeAt
//Tietokannan nimi:	opisk_t8rail00
//Tietokantapalvelimen osoite:	mysli.oamk.fi
try
{
  $dsn = "mysql:host=mysli.oamk.fi;dbname=opisk_t8rail00";
  $db = new PDO ($dsn, "t8rail00", "qkJXjLkpBwampeAt");
  //print ("Connected\n");
}
  catch (PDOException $e)
{
    print ("Cannot connect to server\n");
    print ("Error code: " . $e->getCode() . "\n");
    print ("Error message: " . $e->getMessage() . "\n");
}
?>
