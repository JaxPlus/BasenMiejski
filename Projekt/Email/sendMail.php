<?php

    require_once("../Classes/Checking.php");

    if (isset($_POST['title'])) {
        $_SESSION['title'] = $_POST['title'];
    }

    Checking::canBeHere("title", "../info.html");
    unset($_SESSION['title']);

    if (isset($_POST['from'])) {
        $from = $_POST['from'];
        $title = $_POST['title'];
        $message = $_POST['message'];

        // powinno działać ale to jest ból żeby to ustawić więc nie :P
        // mail("mojemail@gmail.com", $title, $message);
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon"  href="./Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/styleIndex.css">
    <link rel="stylesheet" href="../CSS/styleInfo.css">
    <title>Basen miejski w Niepiekle</title>
</head>
<body>
    <header class="blur">
        <h2>Basen miejski w <span>Niepiekle</span> zaprasza!</h2>
    </header>

    <nav>
        <button id="menu"><i class="fa-solid fa-bars fa-stack-2x"></i></button>
        <div id="navigation">
            <div>
                <button id="exit"><i class="fa-solid fa-xmark fa-stack-2x"></i></button>
                <ul>
                    <li><a href="../index.php">Strona Główna</a></li>
                    <li><a href="../login.php">Zarejestruj się/Zaloguj się</a></li>
                    <li><a href="../aktualizacje.php">Aktualności</a></li>
                    <li><a href="../info.html">Kontakt i informacje</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="../JS/menuanimation.js"></script>

    <main class="blur">
        <div class="mainThanks" id="messageSended">

            <h3>Wiadomość została wysłana! (Tak naprawdę nie została wysłana ale powiedzmy że tak)</h3>
            <a href="../index.php">Powróć na stronę główną.</a>

        </div>
    </main>

    <footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>