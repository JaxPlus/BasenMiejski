<?php
    class BuyingTickets {
        
        // Dane do dalszej obróbki - kasaBiletów
        private $f_ok = true;
        private $reducedTickets = 0;
        private $arrivalDate = [];
        private $priceOfTickets;
        private $idOfOrder;

        // Wywołanie zapamiętywania czy to zredukowany bilet
        private function echoChecked($i)
        {
            if (@$_SESSION['fr_kid'. $i])
            {
                echo "checked";
                unset($_SESSION['fr_kid'. $i]);
            }
        }

        // Wywołanie zapamiętywania daty przyjścia
        private function echoDate($i)
        {
            if (isset($_SESSION['fr_arrivalDate'. $i]))
            {
                echo $_SESSION['fr_arrivalDate'. $i];
                unset($_SESSION['fr_arrivalDate'. $i]);
            }   
        }

        // Wyświetlanie błędu
        private function echoErrorDate($i)
        {
            if (isset($_SESSION['e_date'. $i]))
            {
                echo '<div class="error">'. $_SESSION['e_date'. $i]. '</div>';
                unset($_SESSION['e_date'. $i]);
            }
        }

        // Cały blok tego czy jest to bilet ulgowy
        private function echoIfKid($i)
        {
            echo "<div>
            <h4>Bilet nr.$i</h4>
            <div class='blocksForm'>
                <label for='inputStyle'>Bilet ulgowy?</label>
                <input type='checkbox' name='kid$i' "; $this->echoChecked($i);
            echo " class='inputStyle checkboxs'></div>";
        }

        // Cały blok tego kiedy przychodzisz
        private function echoArrivalDate($i)
        {
            echo "<label for='arrivalDate'>Data przyjścia:</label>
            <input class='blocksForm' type='date' required name='arrivalDate$i' value='"; $this->echoDate($i);
            echo "' id='arrivalDate'>
                </div>";
        }

        // Wykonanie powyższych metod - do kupionyBilet
        public function executeAllTestForFirst($numOfTickets)
        {
            for ($i = 1; $i <= $numOfTickets; $i++)
            {
                $this->echoIfKid($i);
                $this->echoArrivalDate($i);
                $this->echoErrorDate($i);
            }
        }

        // Samo kupno biletów

        public function setTickets($i, $value)
        {
            $this->arrivalDate[$i] = $value;
            $_SESSION['fr_arrivalDate'. $i] = $value;
        }

        public function setReducedTickets($i, $value)
        {
            if ($value == 'on') {
                $_SESSION['fr_kid'. $i] = $value;
                $this->reducedTickets++;
            }
        }

        // Sprawdzanko daty
        private function checkIfDateIsFuthere($i)
        {
            if ($this->arrivalDate[$i] < date("o-m-d"))
            {
                $this->f_ok = false;
                $_SESSION['e_date'. $i] = "Ten dzień już był! Wybierz przyszły.";
            }
        }

        private function checkIfDateIsNotTooFuthure($i)
        {
            // klasa do sprawdzania czy data jest w poprawnym zakresie (do 30 dni)
            $date = new DateTime(date("o-m-d"));
            $date->add(new DateInterval('P30D'));

            if ($this->arrivalDate[$i] > $date->format('Y-m-d'))
            {
                $this->f_ok = false;
                $_SESSION['e_date'. $i] = "Ten dzień wybiega za daleko w przyszłość! Prosimy o wybranie wcześniejszego terminu.";
            }
        }

        // To trzeba wykonać
        public function toCheckDate($i)
        {
            $this->checkIfDateIsFuthere($i);
            $this->checkIfDateIsNotTooFuthure($i);
        }

        // Ustawianie ile pieniędzy
        private function setPriceOfTickets()
        {
            $this->priceOfTickets = 10 * $_SESSION['numberOfTickets'];
            $this->priceOfTickets = $this->priceOfTickets - ($this->reducedTickets * 2);
        }

        private function echoPriceOfTickets()
        {
            // Odmiana polska to bój jak nie wiem ... ehhh
            $ticket = ($_SESSION['numberOfTickets'] == 5) ? "biletów" : "bilety";
            $ticket = ($_SESSION['numberOfTickets'] == 1) ? "bilet" : $ticket;
            $expresion = ($_SESSION['numberOfTickets'] == 1) ? "Twój $ticket kosztuje" : "Twoje $ticket kosztują";

            echo "<div><p>Zamówiłeś $_SESSION[numberOfTickets] $ticket</p>";
            echo "<p>$expresion: ". $this->priceOfTickets ." zł</p></div>";
        }

        // Tutaj wywołanie wszystkiego
        public function flagChecking()
        {
            $connection = new ConnectToDB();
            $connection = $connection->getConnection();

            if (is_object($connection)) {
                if ($this->f_ok) {
                    $this->setPriceOfTickets();
                    $this->echoPriceOfTickets();

                    $querySQLAddingOrder = "INSERT INTO `order` (FK_idUser, orderDate, numberOfTickets, price, numberOfReducedTickets) VALUES ($_SESSION[idUser], CURRENT_DATE(), '$_SESSION[numberOfTickets]', $this->priceOfTickets,'$this->reducedTickets');";

                    $connection->query($querySQLAddingOrder);

                    $idOrder = $connection->query("SELECT idOrder FROM `order` WHERE orderDate LIKE '".date("o-m-d")."' AND FK_idUser = $_SESSION[idUser] ORDER BY idOrder DESC LIMIT 1;");

                    $this->ifAnyAndReturnQuery($idOrder, $connection);
                    $_SESSION['ticketsThanks'] = true;

                    $message = "Dziękujemy za zakup biletów do naszego basenu!" ."\r\n".
                        "Okaż tą wiadomość przy kasie, żeby potwierdzić zakup." ."\r\n".
                        "Unikalny numer twojego zamówienia: $this->idOfOrder" ."\r\n". 
                        "---------------------------------------------" ."\r\n". 
                        "Ta wiadomość została wygenerowana automatycznie. Prosimy na nią nie odpowiadać.";

                    $header = "From: basenWNiepiekle@gmail.com";
                    $message = wordwrap($message, 70);

                    // To samo co z wysyłaniem wiadomości
                    // mail($_SESSION['email'], "Bilet", $message, $header);

                    $connection->close();
                }
                else
                {
                    header("Location: kupionyBilet.php");
                }
            }
            else
            {
                echo $connection;
            }
        }

        private function ifAnyAndReturnQuery($idOrder, $connection)
        {
            if ($idOrder->num_rows == 1) {
                $row = $idOrder->fetch_assoc();
                
                for ($i = 1; $i <= $_SESSION['numberOfTickets']; $i++)
                {
                    $this->idOfOrder = $row['idOrder'];
                    $date = $this->arrivalDate[$i];
                    $querySQLAddingTicket[$i] = "INSERT INTO ticket (FK_idOrder, arrivalDate) VALUES ($row[idOrder], '$date');";
                    $connection->query($querySQLAddingTicket[$i]);
                }
            }
        }
    }