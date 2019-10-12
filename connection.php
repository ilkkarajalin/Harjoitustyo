<?php
try
{
  $dsn = "mysql:host=localhost;dbname=reseptori";
  $db = new PDO ($dsn, "phpUser", "phpPass");
  //print ("Connected\n");
}
  catch (PDOException $e)
{
    print ("Cannot connect to server\n");
    print ("Error code: " . $e->getCode() . "\n");
    print ("Error message: " . $e->getMessage() . "\n");
}
?>
