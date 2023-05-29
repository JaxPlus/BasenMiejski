<?php
    session_start();

    if (isset($_POST['logout'])) {
        unset($_SESSION['isLog']);
        unset($_SESSION['admin']);
        header('Location: index.php');
    }

    if (isset($_COOKIE['news'])) { unset($_COOKIE['news']); }
    if (isset($_COOKIE['user'])) { unset($_COOKIE['user']); }
    if (isset($_COOKIE['pass'])) { unset($_COOKIE['pass']); }
    if (isset($_COOKIE['action'])) { unset($_COOKIE['action']); }

    require_once("./Classes/Checking.php");
    require_once("./Classes/ConnectionToDB.php");
    Checking::canBeHere('isLog', "index.php");
    Checking::ticketErrorClear();

    $connection = new ConnectToDB();
    $connection = $connection->getConnection();
    
    if (is_object($connection)) {
        $connection->query("SET NAMES UTF8");
    }
    else
    {
        echo $connection;
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon"  href="./Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/styleAccount.css">
    <title>Twoje konto</title>
</head>
<body>
    <header class="blur">
        <h2>Witaj na swoim koncie!</h2>
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
    <script src="./JS/menuanimation.js"></script>

    <main class="blur">
        <div id="menuSide">
            <ul id="menuList">
                <li id="mainAccountPage">Strona główna</li>
                <a href="./BuyingThings/kupowanieBiletu.php"><li>Kup bilet</li></a>
                <a href="./BuyingThings/kupowanieKarnetu.php"><li>Kup karnet</li></a>
                <li id="orderHistoryPage">Historia zamówień</li>
                <?php if (!empty($_SESSION['admin'])) echo '<a href="./Admin/adminPanel.php"><li id="adminPanel">Panel administratora</li></a>'; ?>
            </ul>
        </div>

        <div id="mainContent">
            <div id="helloMessage">
                <?php
                    // idk dlaczego to dałem w funkcję ale tak
                    function name()
                    {
                        echo "<h3>Hej ", $_SESSION['fname'], "!</h3>";
                    }
                    // tu się będzie generowało chyba?

                    name();
                ?>

                <p>Jesteś na stronie głównej swojego konta. Po lewej możesz zobaczyć historię swoich zamówień jak i wrócić na ten panel.</p>
                <p>Możesz się też udać do strony gdzie możesz kupić bilety, karnety dla ciebie jak i dla całej rodziny!</p>

                <?php
                
                // Wyświetlanie podziękowań
                if (isset($_SESSION['ticketsThanks'])) {
                    echo "<h3>Dziękujemy za kupno biletów do naszego basenu! Możesz je sprawdzić w zakładce Historia zamówień</h3>";
                    unset($_SESSION['ticketsThanks']);
                    unset($_SESSION['numberOfTickets']);
                }

                if (isset($_SESSION['passThanks'])) {
                    echo "<h3>Dziękujemy za kupno karnetu! Możesz go sprawdzić w zakładce Historia zamówień</h3>";
                    unset($_SESSION['passThanks']);
                }

                ?>
            </div>

            <div id="history">
                <?php
                    $querySQLHistory = "SELECT o.idOrder, o.orderDate, o.price, o.numberOfTickets, o.numberOfReducedTickets, p.lenghtOfPass, p.type FROM `order` o LEFT JOIN pass p ON p.idPass = o.FK_idPass WHERE o.FK_idUser = '$_SESSION[idUser]' ORDER BY orderDate DESC;";

                    if (is_object($connection)) {
                        $queryHistory = $connection->query($querySQLHistory);
                    
                        if ($queryHistory->num_rows > 0) {
                            $i = $queryHistory->num_rows;

                            while($rowHistory = mysqli_fetch_row($queryHistory))
                            {
                                if($rowHistory[3] != 0)
                                {
                                    $type = 'deleteTickets';
                                    $expresion = "<p>Bilety w ilości: $rowHistory[3] z łączną ilością $rowHistory[4] biletów ulgowych</p>";
                                }
                                else
                                {
                                    $type = 'deletePass';
                                    $expresion = "<p>Karnet na czas $rowHistory[5] $rowHistory[6]</p>";
                                }
        
                                echo "<div>
                                    <hr>
                                        <p>$i. W dniu $rowHistory[1], cena: $rowHistory[2] zł</p>
                                        $expresion
                                        <form method='post' action='./Resignation/ticketResignation.php'>
                                            <input name='$type' type='submit' value='Zrezygnuj z tego zakupu'>
                                            <input id='displayNone' type='number' value='$rowHistory[0]' name='orderId'>
                                        </form>
                                    <hr>
                                </div>";
                                $i--;
                            }
                        }
                        else
                        {
                            echo "<div id='infoBuy'>Jeszcze nie kupiłeś żadnego biletu ani karnetu. Jak je kupisz to tutaj je znajdziesz!</div>";
                        }
                    }
                ?>
            </div>
            <script src="./JS/accountanimation.js"></script>
        </div>

        <div id="logOutButtonDiv">
            <form action="konto.php" method="post">
                <input id="logout" name="logout" type="submit" value="Wyloguj się">
            </form>
        </div>
    </main>

    <footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>