<?
require_once("pays.php");
//affichage de la bd de pays
$sql = "SELECT * FROM pays";
$reponsepays = $connection->prepare($sql);
$reponsepays = $connection->query($sql);
$result = $reponsepays->fetchAll(PDO::FETCH_OBJ);
?>