<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon"  href="./Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/styleIndex.css">
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
                    <li><a href="login.php">Zarejestruj się/Zaloguj się</a></li>
                    <li><a href="aktualizacje.php">Aktualności</a></li>
                    <li><a href="cennik.php">Cennik</a></li>
                    <li><a href="info.html">Kontakt i informacje</a></li>
                    <?php if (isset($_SESSION['isLog'])) { if ($_SESSION['isLog']) { echo "<li><a href='konto.php'>Twoje konto</a></li>"; }} ?>
                    <?php if (!empty($_SESSION['admin'])) echo '<li id="adminPanel"><a href="./Admin/adminPanel.php">Panel administratora</a></li>'; ?>
                </ul>
            </div>
        </div>
    </nav>
    <script src="./JS/menuanimation.js"></script>

    <main class="blur">

        <div id="maincol">
            <h3 id="newsHeader">Najnowsze aktualizacje!</h3>
            
            <div id="news">
                <?php
                    require_once("./Classes/ConnectionToDB.php");

                    $connection = new ConnectToDB();
                    $connection = $connection->getConnection();

                    if(is_object($connection)) {
                        $connection->query("SET NAMES UTF8");

                        $querySQLNews1 = "SELECT newsTitle, img FROM news ORDER BY idNews DESC LIMIT 5";

                        $queryNews1 = $connection->query($querySQLNews1);

                        while($rowNews = mysqli_fetch_row($queryNews1))
                        {
                            echo "<div class='newestNews'>
                                <div class='imgForNews' style='background-image: url(./Classes/Admin/Images/$rowNews[1])'></div>
                                <h3>$rowNews[0]</h3>
                            </div>";
                        }
    
                        $connection->close();
                    }
                    else
                    {
                        echo $connection;
                    }
                ?>

                <footer id="newsFooter"><a href="aktualizacje.php">Zobacz wszystkie</a></footer>
            </div>

            <div class="description">

                <div id="indexMenu">
                    <a href="login.php"><button>Rejestracja<i class="fa-solid fa-pen"></i></button></a>
                    <a href="cennik.php"><button>Cennik<i class="fa-solid fa-list"></i></button></a>
                    <a href="info.html"><button>Informacje<i class="fa-solid fa-circle-info"></i></button></a>
                </div>

                <p>
                    Zapraszamy serdecznie do naszego zakrytego basenu w Niepiekle! Oferujemy karnety do całego roku czasu i bilety na dowolne dni.
                </p>

                <p>
                    W zakładce cennik możecie zobaczyć, także kiedy możecie do nas wpaść!
                </p>

                <p>
                    Po zalogowaniu się możecie kupić bilety na dany dzień!
                </p>

                <p>
                    Jeśli masz jakieś pytania bądź chcesz spróbować swoich sił w naszej pracy możesz wejść na kartę z informacjami gdzie znajdziesz kontakt!
                </p>

                <img class="poolImg" src="./Assets/design-pool-swimming-water-wallpaper-preview.jpg" alt="Zdjęcie basenu">
            </div>
        </div>
    </main>

    <aside class="blur" id="">
        <!-- Najnowsze terminy jakieś - też można z bazy -->
    </aside>

    <footer class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>