<?php

session_start();

require_once("../Classes/Checking.php");
require_once("../Classes/ConnectionToDB.php");
require_once("../Classes/BuyingPasses.php");

Checking::canBeHere('isLog', "index.php");

$connection = new ConnectToDB();
$connection = $connection->getConnection();

if (is_object($connection)) {
    if (isset($_POST['passBought'])) {
        $passId = $_POST['passBought'];
    
        $buyingPass = new BuyingPasses();
    
        $buyingPass->setQueryPassPrice($passId);
        $queryPassPrice = $connection->query($buyingPass->getQueryPassPrice());
    
        while ($rowPasses2 = mysqli_fetch_row($queryPassPrice))
        {
            $querySQLBought = "INSERT INTO `order`(FK_idUser, FK_idPass, orderDate, price, numberOfTickets, numberOfReducedTickets) VALUES ('$_SESSION[idUser]', '$passId', CURRENT_DATE(), '$rowPasses2[0]', 0, 0)";
        }
    
        $connection->query($querySQLBought);
    
        $connection->close();
    }
    else
    {
        echo "coś23132";
    }
    
    $_SESSION['passThanks'] = $passId;
    header('Location: ../konto.php');
}
else
{
    echo $connection;
}