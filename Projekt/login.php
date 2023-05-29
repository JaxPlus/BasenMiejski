<?php

	session_start();

    require_once("./Classes/Registration.php");
    require_once("./Classes/ConnectionToDB.php");
    require_once("./Classes/Login.php");
    require_once("./Classes/IssetEchoClass.php");

    $data = new IssetEchoClass();
	
    if (isset($_COOKIE['rejestracja'])) { setcookie("rejestracja", false); }

	if (isset($_POST['email']) && isset($_POST['fname']) && $_COOKIE['action'] == 'rejestracja')
	{
        $registration = new Registration($_POST['fname'], $_POST['lname'], $_POST['passw'], $_POST['email'], $_POST['tel']);
        $registration->allTest();
	}
    
    if (isset($_POST['email']) && isset($_POST['passw']) && $_COOKIE['action'] == 'logowanie')
    {
        $login = new Login($_POST['email'], $_POST['passw']);
        $login->allTest();
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
    <link rel="stylesheet" href="./CSS/stylelogin.css">
    <title>Basen miejski w Niepiekle zaprasza!</title>
</head>
<body>
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

    <div id="loginform" class="blur">
        <div id="buttons">
            <button id="registrationB">Rejestracja</button>
            <button id="loginB">Logowanie</button>
        </div>

        <div id="registration">
            <form action="login.php" method="post">
                <label for="fname">Imię:</label>
                <input class="inputStyle" required
                value="<?php $data->issetEcho('fr_fname', "value"); ?>"
                type="text" name="fname" class="fname">

                <?php $data->issetEcho('e_fname', "error"); ?>

                <label for="lname">Nazwisko:</label>
                <input class="inputStyle" required
                value="<?php $data->issetEcho('fr_lname', "value"); ?>"
                type="text" name="lname" class="lname">

                <?php $data->issetEcho('e_lname', "error"); ?>

                <label for="passw">Hasło:</label>
                <input class="inputStyle" required
                value="<?php $data->issetEcho('fr_passw', "value"); ?>"
                type="password" name="passw" class="passw">

                <?php $data->issetEcho('e_password', "error"); ?>

                <label for="email">Email:</label>
                <input class="inputStyle" required
                value="<?php $data->issetEcho('fr_email', "value"); ?>"
                type="email" name="email">

                <?php $data->issetEcho('e_email', "error"); ?>

                <label for="tel">Telefon:</label>
                <input class="inputStyle"
                value="<?php $data->issetEcho('fr_tel', "value"); ?>"
                type="tel" name="tel" id="tel">

                <?php $data->issetEcho('e_tel', "error"); ?>
                
                <input class="submitButtons" onclick="setCookie('rejestracja')" type="submit" value="Zarejestruj się">
            </form>
        </div>

        <div id="login">
            <form action="login.php" method="post">
                <label for="email">Email:</label>
                <input class="inputStyle" type="text" required name="email">

                <label for="passw">Hasło:</label>
                <input class="inputStyle" type="password" required name="passw" class="passw">

                <?php $data->issetEcho('e_log', "error"); ?>

                <input class="submitButtons" onclick="setCookie('logowanie')" type="submit" value="Zaloguj się">
            </form>
        </div>
    </div>

    <footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
    <script src="./JS/loginanimation.js"></script>
    <script src="./JS/menuanimation.js"></script>
</body>
</html>