<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wynajmujemy samochody</title>

    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header class= "baner"> 
    <h1>"Wynajem Samochodów"</h1>
</header>

<section class="srodek">
<section class="panel-lewy">
    <h2>DZIŚ POLECAMY TOYOTE ROCZNIK 2014</h2>

    <?php
    $con = mysqli_connect("localhost","root","","wynajem");
    $zapyt1 ="SELECT `id` , `model` , `kolor` from `samochody`where `marka` = 'Toyota' AND `rocznik` = '2014';;";
    $result = mysqli_query($con, $zapyt1);
    $wyswietl = mysqli_fetch_array($result);
    echo("$wyswietl[id] Toyota $wyswietl[model] Kolor: $wyswietl[kolor]");
    mysqli_close($con);
    ?>


    <h2>WSZYSTKIE DOSTEPNE SAMOCHODY</h2>

    <?php
    $con = mysqli_connect("localhost","root","","wynajem");
    $zapyt2 ="SELECT `id` , `marka` , `model` , `rocznik` FROM `samochody`;";
    $result = mysqli_query($con, $zapyt2);
    $wyswietl = mysqli_fetch_array($result);
    echo("$wyswietl[id] $wyswietl[marka] $wyswietl[model] $wyswietl[rocznik]");

    while($wyswietl = mysqli_fetch_array($result)){
        echo("<p> $wyswietl[id] $wyswietl[marka] $wyswietl[model] $wyswietl[rocznik] </p> ");
        }

    
    mysqli_close($con);
    ?>

</section>

<section class="panel-środkowy">
    <h2>ZAMÓWIONE AUTA Z NUMERAMI KLIENTÓW</h2>

    <?php
    $con = mysqli_connect("localhost","root","","wynajem");
    $zapyt3 ="SELECT `samochody`.`id` , `model` , `telefon` from `samochody` INNER JOIN `zamowienia` on `samochody`.`id` = `zamowienia`.`Samochody_id`;";
    $result = mysqli_query($con, $zapyt3);
    $wyswietl = mysqli_fetch_array($result);
    echo("$wyswietl[id] $wyswietl[model] $wyswietl[telefon]");

    while($wyswietl = mysqli_fetch_array($result)){
        echo("<p> $wyswietl[id] $wyswietl[model] $wyswietl[telefon] </p> ");
        }

    mysqli_close($con);
    ?>


    
</section>

<section class="panel-prawy">
    <h2>NASZA OFERTA</h2>
    <ul>
        <li>Fiat</li>
        <li>Toyota</li>
        <li>Opel</li>
        <li>Mercedes</li>
    </ul>

    <a>tutaj pobierzesz naszą</a><a href="komis.sql" class="baza"> bazę danych </a>

    <p>autor strony: Magda Kaczorowska</p>
</section>

</section>

    
</body>
</html>