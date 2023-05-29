<?php

    session_start();

    require_once("../Classes/BuyingTickets.php");
    require_once("../Classes/Checking.php");

    if (isset($_POST['numOfTickets'])) {
        $_SESSION['numberOfTickets'] = $_POST['numOfTickets'];
    }

    Checking::canBeHere('isLog', "../index.php");
    Checking::canBeHere('numberOfTickets', "../konto.php");
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
            <form action="kasaBiletów.php" method="post">
                <?php
                    $buyingTicket = new BuyingTickets();
                    $buyingTicket->executeAllTestForFirst($_SESSION['numberOfTickets']);
                ?>
                <input type="submit" class="submitButtons" value="Przejdź dalej">
            </form>
        </div>
    </main>

    <footer id="footerBuy" <?php if ($_SESSION['numberOfTickets'] < 3) {
        echo "style='
        position: absolute;
        bottom: 0;'";}?> class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>