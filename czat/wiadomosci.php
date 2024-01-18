<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
if(isset($_SESSION['login']))
{
?>
<h2>Wiadomosci</h2>

<form method="post" >
        login <input type="text" name="log"> <br>
        wiadomosc <textarea name="wiad"></textarea><br>
        <input type="submit" value="wyslij">
        <input type="reset" value="czysc">
</form>


<!-- <form method="POST" ENCTYPE="multipart/form-data"> -->
   <!-- <input type="file" name="plik"/><br/> -->
 <!-- </form> -->


<form method="POST">
<!-- action="logowanie.php" -->
<input type="submit" value="wyloguj" name="wyloguj">
</form>


    <?php
    

if(isset($_POST["wyloguj"])){
    //session_destroy();
   // $_SESSION = array();
    unset($_SESSION['login']);
    header('location: logowanie.php');
}


$log=$_POST["log"];
$wiad=$_POST["wiad"];
$data=date("Y-m-d");




    $polacz = mysqli_connect("localhost","root","","czat_gr1");    
   

    $logowanie = "SELECT `id`  FROM `uzytkownicy`WHERE `login` = '$log'";

    $spr = mysqli_query($polacz, $logowanie);
    $id = mysqli_fetch_array($spr);


    if(!empty($id['id'])){
        $dodaj = "INSERT INTO `wiadomosci` VALUES ('', '$id[id]', '$wiad' , '$data') ";
        mysqli_query($polacz, $dodaj);

    }
    else {
        echo("<p><u>uzytkownik o takim loginie nie istneije!</u></p>");
    }

   
    $zapytanie = "SELECT `login`, `wiadomosc`, `data`, `zdjecie` FROM `uzytkownicy` INNER JOIN `wiadomosci` ON `uzytkownicy`.`id`=`wiadomosci`.`id` ";

    $wynik = mysqli_query($polacz, $zapytanie);

    //zwraca odp z serwera pod jakąś zmienna , ta zmienna staje się tablicą jednowymiarową, fetch_array pozwala na wyswietlenie z tablicy nei po nr a nazwach kolumn w bazie
    $row = mysqli_fetch_array($wynik);

    
    while($wyswietl = mysqli_fetch_array($wynik)){
        echo("<img src='$row[zdjecie]'>");
        echo("<p> $wyswietl[login] $wyswietl[data] </p>
        <p> $wyswietl[wiadomosc] </p>");
    }

    mysqli_close($polacz);



 //zdj

 //$zdjecie = $_FILES['plik']['name'];

    //$dozwolone_rozszerzenia = array("jpeg","jpg","tiff","tif","png", "gif");
    //$plik_rozszerzenie = pathinfo(strtolower($_FILES['plik']['name']), PATHINFO_EXTENSION);


 //if (!in_array($plik_rozszerzenie, $dozwolone_rozszerzenia, true)) {
        //echo("Niedozwolone rozszerzenie pliku.");}

//else {
//pathinfo(strtolower($_FILES['plik']['name']), PATHINFO_EXTENSION);

//$sciezka= $_SERVER['DOCUMENT_ROOT'].'/madzia/zdjecia/'.$_FILES['plik']['name'];

//echo $sciezka;

//move_uploaded_file($_FILES['plik']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/madzia/zdjecia/'.$zdjecie);


        //$nazwa = $_FILES['plik']['name'];
        //$connect = mysqli_connect("localhost","root","","czat_gr1");  
        //$query = "SELECT * FROM `uzytkownicy` where `login` = '$_POST[login]' && `haslo` = '$_POST[haslo]' "; nie
        //$query = "INSERT INTO `uzytkownicy` VALUES ('' , '' , '', '', '','', '$zdjecie')";


        
        
        //mysqli_query($connect,$query);
       // mysqli_close($connect);
 //}




}

else
{
    header("location:logowanie.php");
}


    

    ?>
</body>
</html>