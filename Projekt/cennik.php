<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon"  href="./Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/stylePriceList.css">
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
                    <li><a href="index.php">Strona Główna</a></li>
                    <li><a href="login.php">Zarejestruj się/Zaloguj się</a></li>
                    <li><a href="aktualizacje.php">Aktualności</a></li>
                    <li><a href="info.html">Kontakt i informacje</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="./JS/menuanimation.js"></script>

    <main class="blur">
        <h2>Cennik</h2>

        <div id="priceList">
            <div>
                <table class="tablecenter">
                    <tr><th>Pn - Pt</th><th>So - Nd</th></tr>
                    <tr><td>8:00 - 21:00</td><td>Basen nieczynny</td></tr>
                </table>
            </div>

            <div>
                <table class="tablecenter">
                    <tr><th>Bilet normalny</th><th>Bilet ulgowy</th></tr>
                    <tr><td>10 zł</td><td>8 zł</td></tr>
                </table>
            </div>

            <div>
                <table class="tablecenter">
                    <?php

                        require_once("./Classes/ConnectionToDB.php");
                        $connection = new ConnectToDB();
                        $connection = $connection->getConnection();

                        if (is_object($connection)) {
                            
                            $connection->query("SET NAMES UTF8");
                            $querySQLPass = "SELECT name, priceOfPass FROM pass";
                            
                            $queryPass1 = $connection->query($querySQLPass);

                            echo "<tr>";
                                while($rowPass = mysqli_fetch_row($queryPass1))
                                {
                                    echo "<th>$rowPass[0]</th>";
                                }
                            echo "</tr>";

                            $queryPass2 = $connection->query($querySQLPass);

                            echo "<tr>";
                                while($rowPass = mysqli_fetch_row($queryPass2))
                                {
                                    echo "<td>$rowPass[1]</td>";
                                }
                            echo "</tr>";

                        }
                        else
                        {
                            echo $connection;
                        }

                    ?>
                </table>
            </div>
        </div>
    </main>

    <footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>