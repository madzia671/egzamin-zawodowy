<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
</head>
<body>
    
<h2>Logowanie</h2>
    <form method="post">
        login <input type="text" name="login"> <br>
        haslo <input type="password" name="haslo"> <br>
        <input type="submit" value="zaloguj">
    </form>

    <?php
session_start();

$login = $_POST["login"];
$haslo = $_POST["haslo"];
$haslo = sha1($haslo);



$polacz = mysqli_connect("localhost","root","","czat_gr1");

$spr = " SELECT `login` FROM `uzytkownicy` WHERE `login` = '$login' AND `haslo` = '$haslo' ";

$result = mysqli_query($polacz, $spr);

$row = mysqli_fetch_array($result);


if(isset($row['login'])){

    


    $_SESSION["login"] = $row['login'];
    header("location:wiadomosci.php");
    exit();
}else{
    echo("Niepoprawny login lub haslo");
}



mysqli_close($polacz);


?>

</body>
</html>