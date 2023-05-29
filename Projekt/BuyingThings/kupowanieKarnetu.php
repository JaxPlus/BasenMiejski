<?php
    session_start();

    require_once("../Classes/Checking.php");
    require_once("../Classes/ConnectionToDB.php");
    require_once("../Classes/BuyingPasses.php");
    Checking::canBeHere('isLog', "index.php");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon" href="../Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/styleAccount.css">
    <link rel="stylesheet" href="../CSS/styleBuy.css">
    <title>Basen miejski w Niepiekle </title>
</head>
<body>
    <header class="blur">
        <h2>Tu możesz kupić karnet.</h2>
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

    <main class="blur passMain">

        <div class="passTable">
            <table>
                <tr>
                    <th>Nazwa karnetu</th><th>Opis</th><th>Długość</th><th>Typ karnetu</th><th>Cena</th><th>Kup</th> <?php if ($_SESSION['admin'] == 1) { echo "<th>Usuń karnet</th>"; }?>
                </tr>
                    <?php
                        $connection = new ConnectToDB();
                        $connection = $connection->getConnection();
                        $buyingPasses = new BuyingPasses();

                        if (is_object($connection)) {
                            $connection->query("SET NAMES UTF8");

                            if (isset($_POST['delPass'])) {
                                $passId = $_POST['delPass'];
                                $buyingPasses->delPass($passId);
                            }

                            $queryPasses = $connection->query($buyingPasses->getQuerySQL());
    
                            $buyingPasses->echoPasses($queryPasses);

                            $connection->close();
                        }
                        else
                        {
                            echo $connection;
                        }
                    ?>
            </table>
        </div>
        
        <div>
            <a href="../konto.php">Wróć do konta</a>
        </div>
    </main>

    <footer id="footerPass" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html> 