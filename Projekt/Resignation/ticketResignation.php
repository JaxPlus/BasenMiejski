<?php

    session_start();

    require_once("../Classes/Checking.php");
    require_once("../Classes/ConnectionToDB.php");
    require_once("../Classes/Resignation.php");
    Checking::canBeHere('isLog', "../index.php");
    
    if (!isset($_POST['deleteTickets']) && !isset($_POST['deletePass']))
    {
        header("Location: ../konto.php");
        exit();
    }
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
    <link rel="stylesheet" href="../CSS/styleAccount.css">
    <title>Rezygnacja</title>
</head>
<body>
    <header class="blur">
        <h2>Zapraszamy ponownie do kupna naszych biletów!</h2>
    </header>

    <nav>
        <button id="menu"><i class="fa-solid fa-bars fa-stack-2x"></i></button>
        <div id="navigation">
            <div>
                <button id="exit"><i class="fa-solid fa-xmark fa-stack-2x"></i></button>
                <ul>
                    <li><a href="index.php">Strona główna</a></li>
                    <li><a href="aktualizacje.php">Aktualności</a></li>
                    <li><a href="cennik.php">Cennik</a></li>
                    <li><a href="info.html">Kontakt i informacje</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="../JS/menuanimation.js"></script>

    <main class="mainThanks">
		<div class="thanksMessage">
            <?php
                $connection = new ConnectToDB();
                $connection = $connection->getConnection();

                if (is_object($connection))
                {
                    $resignation = new Resigntaion($_POST['orderId']);

                    $queryResignation = $connection->query($resignation->getQuerySQLResignation());
                    $dateOfOrder = $queryResignation->fetch_assoc();

                    if (isset($_POST['deleteTickets'])) $expresion = "<p>Zrezygnowałeś z biletów z dnia $dateOfOrder[orderDate]</p>"; else $expresion = "<p>Zrezygnowałeś z karnetu z dnia $dateOfOrder[orderDate]</p>";

                    echo "$expresion
                    <p>Jednak zapraszamy ponownie!</p>
                    <a href='../konto.php'>Wróć do Twojego konta</a>";

                    $resignation->executeQueries($connection);
                }
                else
                {
                    echo $connection;
                }
            ?>
        </div>
    </main>

	<footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>