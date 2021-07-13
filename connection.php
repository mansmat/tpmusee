<?php

try
{
$connection = new PDO('mysql:host=localhost; dbname=musee','root','');
$connection ->SetAttribute(PDO::ERRMODE_EXCEPTION,PDO::ATTR_ERRMODE); 
 
}

catch(PDOException $e)
{
    echo "Connect failed".$e->getMessage();
}


