<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* label {width: 50px;padding-right: 20px;} */
        
    </style>
</head>
<body>
    <h2>Rejestracja</h2>

    <form method="post" ENCTYPE="multipart/form-data">
        imie <input type="text" name="imie"> <br>
        nazwisko <input type="text" name="nazwisko"> <br>
        email <input type="text" name="email"> <br>
        login <input type="text" name="login"> <br>
        haslo <input type="password" name="haslo"> <br>
        <input type="file" name="plik"/><br/>
        <input type="submit" value="zarejestruj">
        <input type="reset" value="czysc">
    </form>


<?php

$imie=$_POST["imie"];
$nazwisko=$_POST["nazwisko"];
$email=$_POST["email"];
$login=$_POST["login"];
$haslo=$_POST["haslo"];
$zdjecie = $_FILES['plik']['name'];



function mb_ucfirst($s) {
    return mb_strtoupper(mb_substr($s,0,1)).mb_substr($s,1);
} 

if($imie != '' && $nazwisko != '' && $email != '' && $login != '' && $haslo != '' && sizeof($_POST) > 0){
    if(preg_match("^[A-ZĄĆĘŁŃÓŚŹŻ]*[a-ząćęłńóśźż]*$^",$imie)&&preg_match("^[A-ZĄĆĘŁŃÓŚŹŻ]*[a-ząćęłńóśźż]*$^",$nazwisko)&&preg_match("^[\w\.\-\+]+@[a-zA-Z\d\.-]+\.[a-zA-Z]{2,}$^",$email))
    {
        $imie = mb_strtolower($imie);
        $nazwisko = mb_strtolower($nazwisko);
        $imie = mb_ucfirst($imie);
        $nazwisko = mb_ucfirst($nazwisko);
        $haslo=sha1($haslo);
    }}

    // polaczyc sie z serwerem mysqli_connect
    // serwer, uzytkownik, haslo, baza
    // $polacz to identyfikator polaczenia
    $polacz = mysqli_connect("localhost","root","","czat_gr1");

    // tworzymy zapytanie zeby informacje wpisane na str zostaly zapisane w tabeli w bazie
    //$zapytanie = "INSERT INTO `uzytkownicy` VALUES ('','$imie', '$nazwisko', '$email', '$login','$haslo')";

    $log = "SELECT `login`  FROM `uzytkownicy`";

    $spr = mysqli_query($polacz, $log);
    $logow = mysqli_fetch_array($spr);


   

    $logowanie = "SELECT `login`  FROM `uzytkownicy` WHERE `login` = '$login' ";

    $spr = mysqli_query($polacz, $logowanie);
    $logow = mysqli_fetch_array($spr);
    
//zdj
pathinfo(strtolower($_FILES['plik']['name']), PATHINFO_EXTENSION);

$sciezka= $_SERVER['DOCUMENT_ROOT'].'/madzia/zdjecia/'.$_FILES['plik']['name'];

echo $sciezka;

move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/madzia/zdjecia/'.$zdjecie);


        $nazwa = $_FILES['plik']['name'];


    if(!empty($logow['login'])){
        echo("<p><u>uzytkownik o takim loginie już istneije!</u></p>");
    }
    else {
        $dodaj = "INSERT INTO `uzytkownicy` VALUES ('','$imie', '$nazwisko', '$email', '$login','$haslo','$zdjecie')";
        mysqli_query($polacz, $dodaj);
    }

    //wyslanie zapytania na serwer
    //mysqli_query($polacz, $zapytanie);

    // zamykanie polaczenia z mysql



    //$dozwolone_rozszerzenia = array("jpeg","jpg","tiff","tif","png", "gif");
    //$plik_rozszerzenie = pathinfo(strtolower($_FILES['plik']['name']), PATHINFO_EXTENSION);


 //if (!in_array($plik_rozszerzenie, $dozwolone_rozszerzenia, true)) {
        //echo("Niedozwolone rozszerzenie pliku.");}

//else {
//pathinfo(strtolower($_FILES['plik']['name']), PATHINFO_EXTENSION);

//$sciezka= $_SERVER['DOCUMENT_ROOT'].'/madzia/zdjecia/'.$_FILES['plik']['name'];

//echo $sciezka;

//move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/madzia/zdjecia/'.$zdjecie);


        $nazwa = $_FILES['plik']['name'];
        //$polacz = mysqli_connect("localhost","root","","czat_gr1");  
        //$query = "SELECT * FROM `uzytkownicy` where `login` = '$_POST[login]' && `haslo` = '$_POST[haslo]' ";
        //$query = "INSERT INTO `uzytkownicy` VALUES ('' , '' , '', '', '','', '$zdjecie')";


        
        
        //mysqli_query($polacz,$query);
 //}

    mysqli_close($polacz);



?>
    
</body>
</html>