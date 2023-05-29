<?php
    class BuyingPasses {
        private $querySQLPasses = "SELECT `name`, lenghtOfPass, `description`, `type`, priceOfPass FROM pass;";
        private $querySQLPassPrice;

        // Wyświetla wszystkie dostępne karnety
        public function echoPasses($queryPasses)
        {
            $connection = new ConnectToDB();
            $connection = $connection->getConnection();

            if (is_object($connection)) {

                $passIdSQL = "SELECT idPass FROM pass";
                $passId = $connection->query($passIdSQL);
                $passArr = [];

                $i = 1;
                while ($rowPassId = mysqli_fetch_row($passId))
                {
                    $passArr[$i] = $rowPassId[0];
                    $i++;
                }
                $i = 1;

                while ($rowPasses = mysqli_fetch_row($queryPasses))
                {
                    $passDel = ($_SESSION['admin'] == 1) ? "<td><form method='post'><input hidden type='number' name='delPass' value='$passArr[$i]'><input class='buyPassButton' type='submit' value='Usuń'></form></td>" : "";
                    echo "<tr><td>$rowPasses[0]</td><td>$rowPasses[2]</td><td>$rowPasses[1]</td><td>$rowPasses[3]</td><td>$rowPasses[4]</td><td><form action='kasaKarnetow.php' method='post'><input hidden type='number' name='passBought' value='$passArr[$i]'><input class='buyPassButton' type='submit' value='Kup'></form></td>$passDel</tr>";
                    $i++;
                }   
            }
            else {
                echo $connection;
            }
        }

        public function getQuerySQL()
        {
            return $this->querySQLPasses;
        }

        // Metody do insertu do bazy
        public function setQueryPassPrice($passId)
        {
            $this->querySQLPassPrice = "SELECT priceOfPass FROM pass WHERE idPass = $passId";
        }

        public function getQueryPassPrice()
        {            
            return $this->querySQLPassPrice;
        }

        // Metody do usunięcia karnetu
        public function delPass($passId)
        {
            $querySQLDeletePass = "DELETE FROM pass WHERE idPass = $passId";
            $querySQLDeletePassFromOrder = "DELETE FROM `order` WHERE FK_idPass = $passId";

            $connection = new ConnectToDB();
            $connection = $connection->getConnection();

            if (is_object($connection)) {
                $connection->query($querySQLDeletePassFromOrder);
                $connection->query($querySQLDeletePass);
                $connection->close();
            }
            else
            {
                echo $connection;
            }
        }
    }