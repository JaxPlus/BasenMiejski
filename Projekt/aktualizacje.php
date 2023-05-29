<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.css">
    <link rel="icon"  href="./Assets/Icon/icon.ico" type="image/icon">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/styleNews.css">
    <title>Aktualizacje</title>
</head>
<body id="newsBody">
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
                    <li><a href="cennik.php">Cennik</a></li>
                    <li><a href="info.html">Kontakt i informacje</a></li>
                    <?php if (isset($_SESSION['isLog'])) { if ($_SESSION['isLog']) { echo "<li><a href='konto.php'>Twoje konto</a></li>"; }} ?>
                </ul>
            </div>
        </div>
    </nav>
    <script src="./JS/menuanimation.js"></script>

    <main class="blur">
        <div id="allTheNews">
            <?php
                require_once("./Classes/ConnectionToDB.php");

                $connection = new ConnectToDB();
                $connection = $connection->getConnection();

                if (is_object($connection)) {
                    $connection->query("SET NAMES UTF8");

                    $querySQLNews2 = "SELECT newsTitle, content, img, creationDate, FK_idUser FROM news ORDER BY idNews DESC";
                    $queryNews2 = $connection->query($querySQLNews2);

                    $arrNews = [];
                    $arrAuthorQuery = [];
                    $arrAuthor = [];
                    $arrResult = [];

                    while($rowNews = mysqli_fetch_row($queryNews2))
                    {
                        $arrAuthorQuery[] = "SELECT firstName FROM user WHERE idUser = $rowNews[4]";

                        $arrNews[] = "<div class='allNews'>
                            <h3>$rowNews[0]</h3>
                            <p class='creationDate'>$rowNews[3]</p>
                            <div class='images' style='background-image: url(./Classes/Admin/Images/$rowNews[2]);'></div>
                            <p>$rowNews[1]</p>";
                    }

                    $i = 0;
                    foreach($arrAuthorQuery as $query) {
                        $arrAuthor[] = $connection->query($query);

                        while ($rowAuthor = mysqli_fetch_row($arrAuthor[$i])) { $arrResult[] = $rowAuthor[0]; }
                        $i++;
                    }

                    $i = 0;

                    foreach($arrNews as $item) {
                        echo $item;

                        echo "<div class='author'><p class='authorP'>Autor: $arrResult[$i]</p></div>
                        </div>";
                        $i++;
                    }
                }
                else
                {
                    echo $connection;
                }
            ?>
        </div>
    </main>

    <footer class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>

</body>
</html>