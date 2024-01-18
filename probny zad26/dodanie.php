<?php
$karetka = $_POST['karetka'];
$pierwszy = $_POST['jeden'];
$drugi = $_POST['dwa'];
$trzeci = $_POST['trzy'];


$con = mysqli_connect("localhost","root","","zad26");

$query = "INSERT INTO `ratownicy` VALUES ('', '$karetka', '$pierwszy', '$drugi', '$trzeci')";

$result = mysqli_query($con, $query);

echo("Do bazy zostało wysłane zapytanie: $query");

mysqli_close($con);

?>