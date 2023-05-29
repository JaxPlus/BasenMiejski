<?php

    session_start();

    require_once("../Classes/Checking.php");
    require_once("../Classes/ConnectionToDB.php");
    require_once("../Classes/Admin/CreatePass.php");
    require_once("../Classes/Admin/CreateNews.php");
    require_once("../Classes/Admin/UserManagement.php");
    Checking::canBeHere('admin', "../konto.php");
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
    <link rel="stylesheet" href="../CSS/styleAdmin.css">
    <title>Panel władzy</title>
</head>
<body>
    <header class="blur">
        <h2>Panel administratora.</h2>
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
        <div class="adminPanel">
            <div class="adminPanelButtons">
                <button id="passB">
                    Dodaj nowy karnet
                </button>
            </div>

            <div class="adminPanelButtons">
                <button id="newsB">
                    Dodaj nową aktualność
                </button>
            </div>

            <div class="adminPanelButtons">
                <button id="usersB">
                    Zarządzanie użytkownikami
                </button>
            </div>
        </div>

        <div class="content">
            <div class="startMessage">
                <h3>Witaj w panelu admina.</h3>
            </div>

            <div class="contentPass">
                <?php
                    CreatePass::echoForm();

                    if (isset($_POST['name'])) {
                        $createPass = new CreatePass($_POST['name'], $_POST['lenghtOfPass'], $_POST['description'], $_POST['type'], $_POST['priceOfPass']);

                        $createPass->executeAll();
                    }
                ?>
            </div>

            <div class="contentNews">
                <?php
                    CreateNews::echoForm();

                    if (isset($_POST['sportEvent']) && isset($_FILES["image"])) {
                        $createNews = new CreateNews($_POST['title'], $_POST['content'], $_FILES["image"], $_POST['sportEvent']);
                        $createNews->createNews();
                    }
                    elseif (isset($_FILES["image"])) {
                        $createNews = new CreateNews($_POST['title'], $_POST['content'], $_FILES["image"]);
                        $createNews->createNews();
                    }
                ?>
            </div>

            <div class="contentUsers">
                <h3>Pamiętaj, że usunięcie użytkownika jest permamentne.</h3>
                    <?php
                    
                    if (isset($_POST['userId'])) {
                        $deleteUser = new UserManagement();
                        $deleteUser->deleteUser($_POST['userId']);
                    }

                    UserManagement::echoUsers();
                    ?>
            </div>
        </div>

        <div class="goBack">
            <a href="../konto.php">Wróć do konta</a>
        </div>

        <script src="../JS/adminanimation.js"></script>
    </main>

    <footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>