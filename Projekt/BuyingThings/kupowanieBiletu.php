<?php

    session_start();

    require_once("../Classes/Checking.php");
    Checking::canBeHere('isLog', "index.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon"  href="../Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/stylelogin.css">
    <link rel="stylesheet" href="../CSS/styleBuy.css">
    <title>Basen miejski w Niepiekle</title>
</head>
<body>
    <header class="blur">
        <h2>Tu możesz kupić bilety.</h2>
    </header>

    <nav>
        <button id="menu"><i class="fa-solid fa-bars fa-stack-2x"></i></button>
        <div id="navigation">
            <div>
                <button id="exit"><i class="fa-solid fa-xmark fa-stack-2x"></i></button>
                <ul>
                    <li><a href="../index.php">Strona główna</a></li>
                    <li><a href="../aktualizacje.php">Aktualności</a></li>
                    <li><a href="../cennik.php">Cennik</a></li>
                    <li><a href="../info.html">Kontakt i informacje</a></li>
                    <li><a href="../konto.php">Twoje konto</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="../JS/menuanimation.js"></script>

    <main class="mainThanks blur" id="thanksMessageCut">
        <div class="thanksMessage">
            <p>Najpierw wybierasz ile biletów chcesz kupić (Do maksymalnie pięciu).</p>
            <p>A potem ich datę przyjścia i wyczekuj tego dnia!</p>
            <p>I nie zapomnij okazać paragonu/dowodu kupna przy wejściu na basen!</p>
            <form action="kupionyBilet.php" method="post">
                <label for="numOfTickets">Ilość biletów do kupienia:</label>
                <input type="number" name="numOfTickets" class="inputStyle" min="1" max="5" value="1" id="numOfTickets">

                <input type="submit" class="submitButtons" value="Przejdź dalej">
            </form>
        </div>

        <div class="goBack">
            <a href="../konto.php">Wróć do konta</a>
        </div>
    </main>

    <footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>