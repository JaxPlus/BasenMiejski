<?php

	session_start();
	
    require_once("./Classes/Checking.php");
	Checking::canBeHere('successfulRegistration', "index.php");

	unset($_SESSION['successfulRegistration']);
	
	// Usuwanie zmiennych pamiętających wartości wpisane do formularza
	if (isset($_SESSION['fr_fname'])) unset($_SESSION['fr_fname']);
	if (isset($_SESSION['fr_lname'])) unset($_SESSION['fr_lname']);
	if (isset($_SESSION['fr_passw'])) unset($_SESSION['fr_passw']);
	if (isset($_SESSION['fr_email'])) unset($_SESSION['fr_email']);
	if (isset($_SESSION['fr_tel'])) unset($_SESSION['fr_tel']);
	
	// Usuwanie błędów rejestracji
	if (isset($_SESSION['e_fname'])) unset($_SESSION['e_fname']);
	if (isset($_SESSION['e_lname'])) unset($_SESSION['e_lname']);
	if (isset($_SESSION['e_password'])) unset($_SESSION['e_password']);
	if (isset($_SESSION['e_email'])) unset($_SESSION['e_email']);
	if (isset($_SESSION['e_tel'])) unset($_SESSION['e_tel']);

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
    <title>Basen miejski w Niepiekle</title>
</head>
<body>
    <header class="blur">
        <h2>Basen miejski w <span>Niepiekle</span> zaprasza!</h2>
    </header>

	<main class="mainThanks">
		<div class="thanksMessage">
			<h3>Dziękujemy za rejestrację na naszej stronie! Teraz możesz się zalogować i kupić bilet lub karnet na nasz basen.</h3>
			<a href="login.php">Przenieś mnie do logowania.</a>
		</div>
	</main>

	<footer id="foot" class="blur">
        <p>Autor: Jan Greń Copyright © 2023</p>
    </footer>
</body>
</html>